<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Libs\Utilities;
use App\Models\AboutTeam;
use App\Models\Blog;
use App\Models\Client;
use App\Models\ContactUsMessage;
use App\Models\MainImage;
use App\Models\Portfolio;
use App\Models\PortfolioSolution;
use App\Models\Solution;
use App\Models\SolutionCategory;
use App\Models\Subscriber;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;

class HomeController extends Controller
{

    public function home(Request $request){
        $solutioncategories = SolutionCategory::with('solutions')->where('status_id', 1)->get();
        $testimonies = Testimonial::all();
        $clients = Client::where('status', 1)->where('banner_type', 0)->orderby('sort_order')->get();
        $mainimages = MainImage::where('status', 1)->orderby('sort_order')->get();
        $blogs = Blog::with('blog_category')->where('status_id', 10)->skip(2)->take(1000)->orderByDesc('created_at');
        $relatedBlogs = Blog::with('blog_category')
            ->where('status_id', 10)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $latestBlogs = Blog::with('blog_category')
            ->where('status_id', 10)
            ->latest()
            ->limit(2)
            ->get();

        $filterKeyword = '';
        if($request->keyword !== null){
            $filterKeyword = $request->keyword;
            $blogs = $blogs->where('title', 'LIKE', '%'. $filterKeyword. '%');
        }

        $blogs = $blogs->paginate(6);

        return view('frontend.home', [
            'blogs' => $blogs,
            'filterKeyword' => $filterKeyword,
            'relatedBlogs' => $relatedBlogs,
            'latestBlogs' => $latestBlogs,
            'clients'   => $clients,
            'mainimages'   => $mainimages,
            'testimonies' => $testimonies,
            'solutioncategories' => $solutioncategories,
        ]);
    }

    public function about(){
        $teams = AboutTeam::where('status_id', 1)->get();
        $data= [
            'teams' => $teams,
        ];
        return view('frontend.about')->with($data);
    }
    public function solutions(){
        $solutionCategories = SolutionCategory::with('solutions')->with('solutions.portfolios')->where('status_id', 1)->get();
        //$solutions = Solution::with('portfolios')->where('status_id', 1)->get();

        $data= [
            'solutionCategories' => $solutionCategories,
            //'solutions' => $solutions,
        ];
        //dd($solutionCategories[0]->solutions, $solutionCategories[0]->solutions[0]->portfolios);

        return view('frontend.solutions')->with($data);
    }
    public function solutionsOld(){

        $solution_1 = Solution::where('solution_category_id', 1)->get();
        $solution_2 = Solution::where('solution_category_id', 2)->get();
        $solution_3 = Solution::where('solution_category_id', 3)->get();

        $data= [
            'solution_1' => $solution_1,
            'solution_2' => $solution_2,
            'solution_3' => $solution_3,
        ];

        return view('frontend.solutions')->with($data);
    }

    public function portfolio(Request $request){
        try{
            $query = '';
            if($request->exists('filter')){
                $query = $request->query('filter');
            }

            $result = [];
            $isFilter = false;

            if($query != ''){
                $solution = Solution::where('id', $query)->first();
                if($solution != null){
                    $portfolioSolutions = PortfolioSolution::where('solution_id', $solution->id)->get();
                    if($portfolioSolutions != null){
                        foreach ($portfolioSolutions as $pSolution){
                            $portfolios = Portfolio::where('id', $pSolution->portfolio_id)->get();
                            array_push($result, $portfolios);
                        }

                        $isFilter = true;
                    }
                }
            }

            if(!$isFilter){
                $result = Portfolio::get();
            }
            $portfolios = Portfolio::get();

            $solutions = Solution::get();

            $data = [
                'result'    => $result,
                'solutions' => $solutions,
                'portfolios' => $portfolios,
            ];

            return view('frontend.portfolio')->with($data);
        }
        catch (\Exception $ex){
            Log::error("HomeController - portfolio error: ". $ex);
            Session::flash('Error', 'Something went wrong! '.$ex->getMessage());
            return redirect()->route('frontend.home');
        }
    }

    public function portfolio_detail(){
        return view('frontend.portfolio-detail');
    }
    public function portfolio_detail_1($id){
        $portfolios = DB::table('portfolios')->where('id', '=', $id)->first();

        if(empty($portfolios)){
            return 'BAD REQUEST';
        }

        $relatedPortfolios = DB::table('portfolios')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('frontend.portfolio-detail_1',[
            'portfolios' => $portfolios,
            'relatedPortfolios' => $relatedPortfolios,
        ]);
    }

    public function blogs(){
        return view('frontend.home');
    }
    public function blog_detail(){
        return view('frontend.home');
    }
    public function contact_us(){
        return view('frontend.contact_us');
    }
    public function term(){
        return view('frontend.term');
    }
    public function privacy(){
        return view('frontend.privacy');
    }
//    public function career(){
//
//        return view('frontend.career');
//    }
//    public function career_detail(){
//
//        return view('frontend.career_detail');
//    }
    public function career_form(){
        return view('frontend.career_form');
    }


    public function saveContactUs(Request $request){
        try{
//            dd($request);
            //check if spam
//            if ($request->faxonly) {
//                Session::flash('success', 'Pesan Anda berhasil diterima!');
//                return redirect()->route('frontend.contact_us');
//            }

            $validator = Validator::make($request->all(),[
                'name'          => 'required|regex:/^[a-zA-Z]/u|max:50',
                'email'         => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:50',
                'phone'         => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,13|starts_with:1,2,3,4,5,6,7,8,9',
//                'company_name'       => 'required|max:50',
                'message'       => 'required|regex:/^[a-zA-Z0-9]/u|max:250'
            ],[
                'name.required'         => 'Nama wajib diisi!',
                'phone.required'        => 'Nomor Ponsel wajib diisii!',
                'email.email'           => 'Email Tidak valid!',
                'email.required'        => 'Email wajib diisii!',
                'phone.digits_between'  => 'Nomor Handphone 10-13 digit!',
                'message.required'      => 'Message wajib diisii!',
                'phone.starts_with'     => 'Salah dalam pengisian nomor ponsel.'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $now = Carbon::now('Asia/Jakarta');

            $newMessage = ContactUsMessage::create([
                'name'          => $request->filled('name') ? Utilities::removeSpecialCharactes($request->input('name')) : "",
                'email'         => $request->filled('email') ? strip_tags($request->input('email')) : "",
//                'company_name'       => $request->input('company_name'),
                'phone'         => "62".$request->filled('phone') ? Utilities::removeSpecialCharactes($request->input('phone')) : "",
                'message'       => $request->filled('message') ? Utilities::removeSpecialCharactes($request->input('message')) : "",
                'created_at'    => $now->toDateTimeString(),
                'updated_at'    => $now->toDateTimeString(),
            ]);
//            dd("meongs");

//            Mail::to("info@31sudirmansuites.com")->send(new ContactMessageMail($newMessage));
            Session::flash('success', 'Pesan Anda berhasil diterima!');

            return redirect()->route('frontend.contact_us');
        }
        catch (\Exception $ex){
            Log::error("HomeController - saveContactUs error: ". $ex);
            Session::flash('Error', 'Something went wrong! '.$ex->getMessage());
            return redirect()->route('frontend.contact_us');
        }
    }
    public function saveContactUsAjax(Request $request){
        $validator = Validator::make($request->all(), [
            'contact_name'          => 'required',
            'contact_phone'         => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,13|starts_with:62,0',
            'contact_email'         => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:50',


        ],[
            'contact_name.required'     => 'Name is required!',
            'contact_phone.required'  => 'Phone is required!',
            'contact_email.required'    => 'Email is required!'

        ]);

        Log::error('Frontend/HomeController - saveContactUsAjax Data contact_name: '. $request->input('contact_name'). ' | contact_phone: '. $request->input('contact_phone'));
        if ($validator->fails()){
            Log::error('Frontend/HomeController - saveContactUsAjax error EX: '. $validator->errors());
//            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            $response = collect([
                'error'         => $validator->errors()
            ]);

            return Response::json(array('success' => 'INVALID DATA'));
        }
        try {
            ContactMessage::create([
                'name'          => $request->input('contact_name'),
                'phone'          => $request->input('contact_phone'),
                'email'         => $request->input('contact_email'),
                'manager'         => $request->input('contact_manager'),
                'company'         => $request->input('contact_company'),
                'message'         => $request->input('contact_message'),
            ]);

            $response = collect([
                'error'         => 'none'
            ]);


            return response()->json($response, 200);
        }
        catch (\Exception $ex){
            Log::error('Frontend/HomeController - saveContactUsAjax error EX: '. $ex);

            $response = collect([
                'error'         => 'exception'
            ]);

            return Response::json(array('success' => 'VALID'));
        }
    }

    public function saveSubscribe(Request $request){
        //dd($request);
        $validator = Validator::make($request->all(), [
            'name'          => 'max:150|regex:/^[a-zA-Z]/u',
            'email'         => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:50',
//            'email'         => 'required|regex:/^\S*$/u|email',
        ],[
            'name.required'     => 'Name is required!',
            'email.required'    => 'Email is required!'
        ]);

        if ($validator->fails()){
            Log::error('Frontend/HomeController - saveSubscribe error EX: '. $validator->errors());
//            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            $response = collect([
                'error'         => $validator->errors()
            ]);

            return Response::json(array('success' => 'INVALID DATA', 'data' => $validator->errors()));
        }


        try {
            Subscriber::create([
                'name'       => $request->filled('name') ? Utilities::removeSpecialCharactes($request->input('name')) : "",
                'email'       => $request->filled('email') ? strip_tags($request->input('email')) : "",
            ]);
            $response = collect([
                'error'         => 'none'
            ]);
            return Response::json(array('success' => 'VALID'));
        }
        catch (\Exception $ex){
            Log::error('Frontend/HomeController - saveSubscribe error EX: '. $ex);
            $response = collect([
                'error'         => 'exception'
            ]);
            return Response::json(array('success' => 'INVALID'));
        }
    }

}
