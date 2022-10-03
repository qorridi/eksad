<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Utilities;
use App\Models\SolutionCategory;
use App\Models\Portfolio;
use App\Models\Solution;
use App\Transformer\SolutionTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Yajra\DataTables\Facades\DataTables;

class SolutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.solution.index');
    }

    public function getIndex(Request $request){

//        $datas = Solution::query();

        $solutions = Solution::join('solution_categories', 'solution_categories.id', '=', "solutions.solution_category_id")
            ->select('solutions.*', 'solution_categories.name as category_name')
            ->where('solutions.status_id', 1)->orderby('solutions.created_at', 'asc')->get();

        error_log($solutions->count());

        return DataTables::of($solutions)
            ->setTransformer(new SolutionTransformer)
            ->make(true);
    }

    public function show($id){
        $data = Solution::where('id', $id)->first();

        //dd($data);
        return view('admin.solution.show', compact('data'));
    }

    public function create(){
        $solutions = Solution::find(1);
        $categories = SolutionCategory::where('status_id', 1)->get();
        $data = [
            'categories'    => $categories,
            'solutions'    => $solutions,
        ];
        return view('admin.solution.create')->with($data);
    }

    public function store(Request $request){

        try{
            $validator = Validator::make($request->all(),[
                'name'                  => 'required|regex:/^[a-zA-Z]/u|max:100',
                'category'           => 'required',
                'description'           => 'required|regex:/^[a-zA-Z]/u',

            ],[
//                'name.required'                 => 'Nama solution wajib diisi!',
//                'category.required'             => 'Kategori solution wajib diisi!',
//                'description.required'          => 'Deskripsi wajib diisi!',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput($request->all());
            }

            if($request->file('featured-image') == null){
                Session::flash('error', 'Image required!');
                return back();
            }

            // Checking title exist
            $title = addslashes($request->input('name'));

            $dateTimeNow = Carbon::now('Asia/Jakarta');

            $user = Auth::guard('admin')->user();
            $slug = Str::slug(strtolower($request->input('name')));

            $name = addslashes($request->input('name'));
            $nameLower = strtolower($name);
            $existSolution = Solution::whereRaw("LOWER(name) = '". $nameLower ."'")
                ->first();
            if(!empty($existSolution)){
//                return redirect()->back()->withErrors('Solution sudah ada!', 'default')->withInput($request->all());
            }
//        dd($request);
            $newData = Solution::create([
                'name'              => Utilities::removeSpecialCharactes($request->input('name')),
                'solution_category_id'=> $request->input('category'),
                'description'       => Utilities::removeSpecialCharactes($request->input('description')),
                'image_path'        => "",
                'status_id'         => 1,
                'created_at'        => $dateTimeNow->toDateTimeString(),
                'created_by'        => $user->id,
            ]);

            // Save featured image
            $folderPath = 'uploads/solution';
            $fileName = 'Solution_'. $slug. '.webp';

            $img = Image::make($request->file('featured-image'));
            $img->save(public_path($folderPath ."/". $fileName), 25);

            $newData->image_path = $folderPath. '/'. $fileName;
            $newData->save();

            //ImageOptimizer::optimize($newData->image_path);

            //update sitemap for SEO
//        Utilities::CreateSitemap();
            Session::flash('message', 'Berhasil buat Solution baru!');
//dd($newData);
            return redirect()->route('admin.solution.show', ['id' => $newData->id]);
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Gagal buat Solution baru!');
            return redirect()->route('admin.solution.index');
        }
    }

    public function edit($id){
        $categories = SolutionCategory::where('status_id', 1)->get();
        $data = Solution::find($id);
        if(empty($data)){
            return redirect()->back();
        }

        $data = [
            'solution'  => $data,
            'categories'  => $categories,
        ];

        return view('admin.solution.edit')->with($data);
    }

    public function update(Request $request, $id ){

        try{
            $validator = Validator::make($request->all(),[
                'name'                  => 'required|regex:/^[a-zA-Z]/u|max:100',
                'category'              => 'required',
                'description'           => 'required|regex:/^[a-zA-Z]/u|',
            ],[
//                'name.required'                 => 'Nama Solution wajib diisi!',
//                'name.regex'                 => 'Hanya menerima input alphanumeric!',
//                'description.required'          => 'Deskripsi wajib diisii!',
//                'category.required'             => 'Kategori wajib diisii!',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput($request->all());
            }

//            if ($validator->fails()) {
//                return back()->withErrors($validator)->withInput();
//            }

            if($request->input('category') == -1){
                return redirect()->back()->withErrors('Kategori wajib diisii!', 'default')->withInput($request->all());
            }
            // Checking title exist
            $name = Utilities::removeSpecialCharactes($request->input('name'));
            $nameLower = strtolower($name);
            $existSolution = Solution::whereRaw("LOWER(name) = '". $nameLower ."'")
                ->where('id', '!=', $id)
                ->first();

            //dd($existBlog);

            if(!empty($existSolution)){
                return redirect()->back()->withErrors('Solution sudah ada!', 'default')->withInput($request->all());
            }
            $id = $request->input('id');

            $dateTimeNow = Carbon::now('Asia/Jakarta');

            $user = Auth::guard('admin')->user();
            //dd($user);

            $data = Solution::find($id);
            //dd($id, $data);
            if(empty($data)){
                return redirect()->back();
            }

            $startDateRequest = $request->input('start_date');
            $data->name = Utilities::removeSpecialCharactes($request->input('name'));
            $data->description = Utilities::removeSpecialCharactes($request->input('description'));
            $data->solution_category_id = Utilities::removeSpecialCharactes($request->input('category'));
            $data->updated_by = $user->id;
            $data->updated_at = $dateTimeNow->toDateTimeString();
            $data->save();


            $slug = Str::slug(strtolower($request->input('name')));
            if($request->file('featured-image') != null){
                // Delete old featured image
                if (!empty($data->image_path)){
                    $deletedPath = public_path($data->image_path);
                    if(file_exists($deletedPath)) unlink($deletedPath);
                }

                // Save featured image
                $folderPath = 'uploads/solution';
                $fileName = 'Solution_'. $slug. '.png';

//                $path = $request->file('featured-image')->storeAs(
//                    $folderPath, $fileName, 'public_uploads'
//                );

                $img = Image::make($request->file('featured-image'));
                $img->save(public_path($folderPath ."/". $fileName), 25);

                $data->image_path = $folderPath. '/'. $fileName;
                $data->save();
//                ImageOptimizer::optimize($data->image_path);
            }

            //update sitemap for SEO
            Session::flash('message', 'Berhasil ubah Solution!');

            return redirect()->route('admin.solution.show', ['id' => $id]);
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Gagal Ubah Solution!');
            return redirect()->route('admin.solution.index');
        }
    }

    public function destroy(Request $request){
//        dd($request);
        try{
            $dataId = $request->input('id');
            $data = Solution::find($dataId);
            if(empty($data)){
                return redirect()->back();
            }

            if(!empty($data->img_path)){
                $deletedPath = public_path($data->img_path);
                if(file_exists($deletedPath)) unlink($deletedPath);
            }

            $data->delete();

            //update sitemap for SEO
//        Utilities::CreateSitemap();
            Session::flash('message', 'Berhasil Hapus Solution!');
            return redirect()->route('admin.solution.index');
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Gagal Hapus Solution!');
            return redirect()->route('admin.solution.index');
        }
    }

    /**
     * Function to fetch solution list for select2
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectSolutions(Request $request){
        $keyword = trim($request->q);
        $solutions = DB::table('solutions')
            ->where('status_id', 1)
            ->where('name', 'LIKE', '%'. $keyword. '%')
            ->get();

        $formatted_tags = [];
        foreach ($solutions as $solution) {
            $formatted_tags[] = ['id' => $solution->id, 'text' => $solution->name];
        }

        return \Illuminate\Support\Facades\Response::json($formatted_tags);
    }
}
