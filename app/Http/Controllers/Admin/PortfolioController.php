<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Utilities;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\PortfolioProduct;
use App\Models\PortfolioSolution;
use App\Transformer\PortfolioTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Mews\Purifier\Facades\Purifier;
use Webpatser\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.portfolio.index');
    }

    public function getIndex(Request $request){

        $datas = Portfolio::where('id', '>', 0)->orderby('created_at', 'asc')->get();;
        return DataTables::of($datas)
            ->setTransformer(new PortfolioTransformer)
            ->make(true);
    }

    public function show($id){
        try {
            $portfolio = Portfolio::find($id);
            if(empty($portfolio)){
                return redirect()->back();
            }

            $otherImages = DB::table('portfolio_images')
                ->where('portfolio_id', '=', $id)
                ->where('is_primary', '=', 0)
                ->get();

            if($portfolio->status_id === 1){
                $status = 'Published';
            }
            else{
                $status = 'Unpublished';
            }

            $data = [
                'portfolio' => $portfolio,
                'otherImages' => $otherImages,
                'status' => $status
            ];

            return view('admin.portfolio.show')->with($data);
        }
        catch (\Exception $ex){
            Log::error('Admin/PortfolioController - update ERROR EX: '. $ex);
            return "Internal server error";
        }
    }

    public function create(){

        return view('admin.portfolio.create');
    }

    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'client_name' => 'required|regex:/^[a-zA-Z]/u|max:100|unique:portfolios',
                'description' => 'max:2000'
            ],[
                'client_name.required' => 'Client Name must be filled!',
                'client_name.max' => 'Client Name must be less than 100 characters!',
                'client_name.unique' => 'Client Name is already registered!',
                'description.max' => 'Description must be less than 2000 characters!!',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput($request->all());
            }

            if(!$request->hasFile('primary_image')){
                return redirect()->back()->withErrors('Please upload primary picture!', 'default')->withInput($request->all());
            }

            if(!$request->hasFile('logo_image')){
                return redirect()->back()->withErrors('Please upload client logo!', 'default')->withInput($request->all());
            }

            $admin = Auth::guard('admin')->user();

            $newPorfolio = new Portfolio();
            $newPorfolio->client_name = Utilities::removeSpecialCharactes($request->input('client_name'));
            $newPorfolio->year = $request->filled('year') ? $request->input('year') : Carbon::now()->year;
            $newPorfolio->description = $request->filled('description') ? Utilities::removeSpecialCharactes($request->input('description')) : null;
            $newPorfolio->description_2 = $request->filled('description_2') ? Utilities::removeSpecialCharactes($request->input('description_2')) : null;
            $newPorfolio->description_3 = $request->filled('description_3') ? Purifier::clean($request->input('description_3')) : null;
            $newPorfolio->description_4 = $request->filled('description_4') ? Purifier::clean($request->input('description_4')) : null;
            $newPorfolio->description_5 = $request->filled('description_5') ? Purifier::clean($request->input('description_5')) : null;
            $newPorfolio->status_id = intval($request->input('status'));
            $newPorfolio->created_by = $admin->id;
            $newPorfolio->updated_by = $admin->id;
            $newPorfolio->save();

            // Check for included solutions
            if($request->filled('solutions')){
                $solutions = $request->input('solutions');
                foreach ($solutions as $solutionId){
                    // Add portfolio - solution link
                    $newSolutionLink = new PortfolioSolution();
                    $newSolutionLink->portfolio_id = $newPorfolio->id;
                    $newSolutionLink->solution_id = $solutionId;
                    $newSolutionLink->save();
                }
            }

            // Save client logo
            $now = Carbon::now('Asia/Jakarta');
//            $logoImage = $request->file('logo_image');
//            $ext = $logoImage->getClientOriginalExtension();
//            $logoFileName = $now->year. $now->month. $now->day. '_'. $newPorfolio->id. '_logo.'. $ext;
//            $logoImage->storeAs('', $logoFileName, 'portfolio_uploads');

            $folderPath = 'storage/portfolio_images';
            $logoFileName = $now->year. $now->month. $now->day. '_'. $newPorfolio->id. '_logo.webp';

            $img = Image::make($request->file('logo_image'));
            $img->save(public_path($folderPath ."/". $logoFileName), 25);

            // Save to database
            DB::table('portfolios')
                ->where('id', '=', $newPorfolio->id)
                ->update([
                    'img_logo' => $logoFileName
                ]);

            // Save primary image
//            $now = Carbon::now('Asia/Jakarta');
//            $primaryImage = $request->file('primary_image');
//            $ext = $primaryImage->getClientOriginalExtension();
//            $primaryFileName = $now->year. $now->month. $now->day. '_'. $newPorfolio->id. '_primary.'. $ext;
//            $primaryImage->storeAs('', $primaryFileName, 'portfolio_uploads');

            $folderPath = 'storage/portfolio_images';
            $primaryFileName = $now->year. $now->month. $now->day. '_'. $newPorfolio->id. '_primary.webp';

            $img = Image::make($request->file('primary_image'));
            $img->save(public_path($folderPath ."/". $primaryFileName), 25);

            // Save to database
            DB::table('portfolios')
                ->where('id', '=', $newPorfolio->id)
                ->update([
                    'img_primary' => $primaryFileName
                ]);

            // Add to portfolio image data
            $newImage = new PortfolioImage();
            $newImage->portfolio_id = $newPorfolio->id;
            $newImage->img_path = $primaryFileName;
            $newImage->is_primary = true;
            $newImage->save();

            if($request->hasFile('other_images')){
                $ct=1;
                foreach ($request->file('other_images') as $imgData){
//                    $now = Carbon::now('Asia/Jakarta');
//                    $ext = $img->getClientOriginalExtension();
//                    $otherFileName = $now->year. $now->month. $now->day. '_'. $newPorfolio->id. '_'. $ct. '.'. $ext;
//                    $img->storeAs('', $otherFileName, 'portfolio_uploads');

                    $folderPath = 'storage/portfolio_images';
                    $otherFileName = $now->year. $now->month. $now->day. '_'. $newPorfolio->id. '_'. $ct. '.webp';

                    $img = Image::make($imgData);
                    $img->save(public_path($folderPath ."/". $otherFileName), 25);

                    // Add to portfolio image data
                    $newImage = new PortfolioImage();
                    $newImage->portfolio_id = $newPorfolio->id;
                    $newImage->img_path = $otherFileName;
                    $newImage->is_primary = false;
                    $newImage->save();

                    $ct++;
                }
            }

            Session::flash('message', 'Successfully created new Portfolio!');
            return redirect()->route('admin.portfolio.show', ['id' => $newPorfolio->id]);
        }
        catch (\Exception $ex){
            Log::error('PortfolioController - update ERROR EX: '. $ex);
            Session::flash('error', 'Internal server error! '.$ex->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function edit($id){
        try {
            $portfolio = Portfolio::find($id);
            if(empty($portfolio)){
                return redirect()->back();
            }

            $otherImages = DB::table('portfolio_images')
                ->where('portfolio_id', '=', $id)
                ->where('is_primary', '=', 0)
                ->get();

            $data = [
                'portfolio' => $portfolio,
                'otherImages' => $otherImages
            ];

            return view('admin.portfolio.edit')->with($data);
        }
        catch (\Exception $ex){
            Log::error('PortfolioController - edit ERROR EX: '. $ex);
            return "Internal server error";
        }
    }

    public function update(Request $request, $id){
        try {
            $validator = Validator::make($request->all(),[
                'client_name' => 'required|regex:/^[a-zA-Z]/u|max:100|unique:portfolios,client_name,'. $id,
                'description' => 'max:2000'
            ],[
                'client_name.required' => 'Client Name must be filled!',
                'client_name.max' => 'Client Name must be less than 100 characters!',
                'client_name.unique' => 'Client Name is already registered!',
                'description.max' => 'Description must be less than 2000 characters!!',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput($request->all());
            }

            $portfolioModel = Portfolio::with(['solutions'])->find($id);
            if(empty($portfolioModel)){
                Session::flash('error', 'BAD REQUEST!');
                return redirect()->back();
            }

            $admin = Auth::guard('admin')->user();

            $portfolioModel->client_name = Utilities::removeSpecialCharactes($request->input('client_name'));
            $portfolioModel->year = $request->filled('project_year') ? $request->input('project_year') : Carbon::now()->year;
            $portfolioModel->description = $request->filled('description') ? Utilities::removeSpecialCharactes($request->input('description')) : null;
            $portfolioModel->description_2 = $request->filled('description_2') ? Utilities::removeSpecialCharactes($request->input('description_2')) : null;
            $portfolioModel->description_3 = $request->filled('description_3') ? Purifier::clean($request->input('description_3')) : null;
            $portfolioModel->description_4 = $request->filled('description_4') ? Purifier::clean($request->input('description_4')) : null;
            $portfolioModel->description_5 = $request->filled('description_5') ? Purifier::clean($request->input('description_5')) : null;
            $portfolioModel->updated_by = $admin->id;
            $portfolioModel->save();

            // Check for included solutions
            if($request->filled('solutions')){
                $solutions = $request->input('solutions');

                // Check for deleted solutions
                foreach ($portfolioModel->solutions as $solution){
                    if(!in_array($solution->id, $solutions)){
                        DB::table('portfolio_solutions')
                            ->where('portfolio_id', '=', $id)
                            ->where('solution_id', '=', $solution->id)
                            ->delete();
                    }
                }

                // Check for added solutions
                foreach ($solutions as $solutionId){
                    if(!DB::table('portfolio_solutions')
                        ->where('portfolio_id', '=', $id)
                        ->where('solution_id', '=', $solutionId)
                        ->exists()){
                        // Add portfolio - solution link
                        $newSolutionLink = new PortfolioSolution();
                        $newSolutionLink->portfolio_id = $id;
                        $newSolutionLink->solution_id = $solutionId;
                        $newSolutionLink->save();
                    }
                }
            }
            else{
                // Delete all portfolio solution links
                DB::table('portfolio_solutions')
                    ->where('portfolio_id', '=', $id)
                    ->delete();
            }

            if($request->hasFile('primary_image')){
                // Delete old primary image
                if(Storage::disk('portfolio_uploads')->exists($portfolioModel->img_primary)){
                    Storage::disk('portfolio_uploads')->delete($portfolioModel->img_primary);
                }

                // Change primary image
                $now = Carbon::now('Asia/Jakarta');
//                $primaryImage = $request->file('primary_image');
//                $ext = $primaryImage->getClientOriginalExtension();
//                $primaryFileName = $now->year. $now->month. $now->day. '_'. $id. '_primary.'. $ext;
//                $primaryImage->storeAs('', $primaryFileName, 'portfolio_uploads');
                $folderPath = 'storage/portfolio_images';
                $primaryFileName = $now->year. $now->month. $now->day. '_'. $id. '_primary.webp';

                $img = Image::make($request->file('primary_image'));
                $img->save(public_path($folderPath ."/". $primaryFileName), 25);

                // Save to database
                DB::table('portfolios')
                    ->where('id', '=', $id)
                    ->update([
                        'img_primary' => $primaryFileName
                    ]);

                // Update portfolio image data
                DB::table('portfolio_images')
                    ->where('portfolio_id', '=', $id)
                    ->where('is_primary', '=', 1)
                    ->update([
                        'img_path' => $primaryFileName,
                    ]);
            }

            // Check for deleted other images
            if($request->filled('deleted_other_pictures')){
                $deletedOtherImageIds = $request->input('deleted_other_pictures');
                if(str_contains($deletedOtherImageIds, ',')){
                    $deletedOtherImageIdsArr = explode(',', $deletedOtherImageIds);
                    foreach ($deletedOtherImageIdsArr as $deletedId){
                        $otherImageModel = PortfolioImage::find($deletedId);
                        if(!empty($otherImageModel)){
                            // Delete old other image file
                            if(Storage::disk('portfolio_uploads')->exists($otherImageModel->img_path)){
                                Storage::disk('portfolio_uploads')->delete($otherImageModel->img_path);
                            }

                            // Finally delete the model
                            $otherImageModel->delete();
                        }
                    }
                }
                else{
                    $otherImageModel = PortfolioImage::find($deletedOtherImageIds);
                    if(!empty($otherImageModel)){
                        // Delete old other image file
                        if(Storage::disk('portfolio_uploads')->exists($otherImageModel->img_path)){
                            Storage::disk('portfolio_uploads')->delete($otherImageModel->img_path);
                        }

                        // Finally delete the model
                        $otherImageModel->delete();
                    }
                }
            }

            if($request->hasFile('logo_image')){
                // Delete old client logo file
                if(Storage::disk('portfolio_uploads')->exists($portfolioModel->img_logo)){
                    Storage::disk('portfolio_uploads')->delete($portfolioModel->img_logo);
                }

                // Change client logo
                $now = Carbon::now('Asia/Jakarta');
//                $logoImage = $request->file('logo_image');
//                $ext = $logoImage->getClientOriginalExtension();
//                $logoFileName = $now->year. $now->month. $now->day. '_'. $id. '_logo.webp';
//                $logoImage->storeAs('', $logoFileName, 'portfolio_uploads');

                $folderPath = 'storage/portfolio_images';
                $logoFileName = $now->year. $now->month. $now->day. '_'. $id. '_logo.webp';

                $img = Image::make($request->file('logo_image'));
                $img->save(public_path($folderPath ."/". $logoFileName), 25);

                // Save to database
                DB::table('portfolios')
                    ->where('id', '=', $id)
                    ->update([
                        'img_logo' => $logoFileName
                    ]);
            }

            // Add other images
            if($request->hasFile('other_images')){
                $ct=1;
                foreach ($request->file('other_images') as $imgData){
                    $now = Carbon::now('Asia/Jakarta');
//                    $ext = $img->getClientOriginalExtension();
//                    $otherFileName = $now->year. $now->month. $now->day. '_'. $id. '_'. $ct. '.'. $ext;
//                    $img->storeAs('', $otherFileName, 'portfolio_uploads');

                    $folderPath = 'storage/portfolio_images';
                    $otherFileName = $now->year. $now->month. $now->day. '_'. $id. '_'. $ct. '.webp';

                    $img = Image::make($imgData);
                    $img->save(public_path($folderPath ."/". $otherFileName), 25);

                    // Add to portfolio image data
                    $newImage = new PortfolioImage();
                    $newImage->portfolio_id = $id;
                    $newImage->img_path = $otherFileName;
                    $newImage->is_primary = false;
                    $newImage->save();

                    $ct++;
                }
            }

            Session::flash('success', 'Successfully updated Portfolio!');
            return redirect()->route('admin.portfolio.edit', ['id' => $id]);
        }
        catch (\Exception $ex){
            dd($ex);
            Log::error('PortfolioController - update ERROR EX: '. $ex);
            Session::flash('error', 'Internal server error!');
            return redirect()->back();
        }
    }

    /**
     * Function to delete portfolio
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        try {
            if(!$request->filled('id')){
                return response()->json(collect([
                    'code' => 400,
                    'error' => 'invalid_input'
                ]), 200);
            }

            // Validate expense object
            $id = $request->input('id');
            $portfolioModel = Portfolio::find($id);
            if(empty($portfolioModel)){
                return response()->json(collect([
                    'code' => 400,
                    'error' => 'invalid_input'
                ]), 200);
            }

            // Check for existing portfolio solution links
            if(DB::table('portfolio_solutions')
                ->where('portfolio_id', '=', $id)
                ->exists()){
                DB::table('portfolio_solutions')
                    ->where('portfolio_id', '=', $id)
                    ->delete();
            }

            // Check for existing portfolio product links
            if(DB::table('portfolio_products')
                ->where('portfolio_id', '=', $id)
                ->exists()){
                DB::table('portfolio_products')
                    ->where('portfolio_id', '=', $id)
                    ->delete();
            }

            // Check for existing other images
            $otherImages = PortfolioImage::where('portfolio_id', '=', $id)
                ->get();

            if($otherImages->count() > 0){
                foreach ($otherImages as $otherImage){
                    // Delete image file
                    if(Storage::disk('portfolio_uploads')->exists($otherImage->img_path)){
                        Storage::disk('portfolio_uploads')->delete($otherImage->img_path);
                    }

                    // Finally delete the model
                    $otherImage->delete();
                }
            }

            try {
                $portfolioModel->delete();
            }
            catch (\Exception $ex){
                Log::error('PortfolioController - delete ERROR EX: '. $ex);
                return response()->json(collect([
                    'code' => 400,
                    'error' => 'data_in_usage'
                ]), 200);
            }

            return response()->json(collect([
                'code' => 200,
                'error' => 'none'
            ]), 200);
        }
        catch (\Exception $ex){
            Log::error('PortfolioController - delete ERROR EX: '. $ex);
            return response()->json(collect([
                'code' => 500,
                'error' => $ex->getMessage()
            ]), 500);
        }
    }

    public function changePublishStatus(Request $request){
        try {
            $id = null;
            $status = null;
            if(!$request->filled('id') || !$request->filled('status')){
                return response()->json(collect([
                    'code' => 400,
                    'error' => 'invalid_input'
                ]), 200);
            }

            $id = $request->input('id');

            // Validate model
            $portfolioModel = Portfolio::find($id);
            if(empty($portfolioModel)){
                return response()->json(collect([
                    'code' => 400,
                    'error' => 'invalid_input'
                ]), 200);
            }

            $status = $request->input('status');

            // Validate status
            if($status !== 'publish' && $status !== 'unpublish'){
                return response()->json(collect([
                    'code' => 400,
                    'error' => 'invalid_input'
                ]), 200);
            }

            if($status === 'publish'){
                $portfolioModel->status_id = 1;
            }
            else{
                $portfolioModel->status_id = 2;
            }

            $portfolioModel->save();

            return response()->json(collect([
                'code' => 200,
                'error' => 'none',
                'result' => $status
            ]), 200);
        }
        catch (\Exception $ex){
            Log::error('PortfolioController - changePublishStatus ERROR EX: '. $ex);
            return response()->json(collect([
                'code' => 500,
                'error' => $ex->getMessage()
            ]), 500);
        }
    }


}
