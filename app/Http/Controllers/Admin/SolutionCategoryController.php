<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Utilities;
use App\Models\Solution;
use App\Models\SolutionCategory;
use App\Transformer\SolutionCategoryTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;

class SolutionCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getIndex(Request $request){
        $categories = SolutionCategory::where('status_id', 1)->orderby('id', 'asc')->get();
        return DataTables::of($categories)
            ->setTransformer(new SolutionCategoryTransformer)
//            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.solutioncategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.solutioncategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'            => 'required|regex:/^[a-zA-Z]/u|max:150',
                'description'     => 'regex:/^[a-zA-Z]/u',
            ]);

            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            if(!$request->hasFile('featured-image')){
                return redirect()->back()->withErrors('Harus Memilih Gambar!', 'default')->withInput($request->all());
            }

            //Create Admin
            $category = SolutionCategory::create([
                'name'          => Utilities::removeSpecialCharactes($request->input('name')),
                'description'   => Utilities::removeSpecialCharactes($request->input('description')),
                'image_path'    => "",
                'status_id'    => 1,
            ]);

            // Save featured image
            $folderPath = 'storage/solutions_category';
            $fileName = 'SolutionCategory_'. $category->id. '.webp';

            $img = Image::make($request->file('featured-image'));
            $img->save(public_path($folderPath ."/". $fileName), 25);

            $category->image_path = $folderPath. '/'. $fileName;
            $category->save();

            $dateTimeNow = Carbon::now('Asia/Jakarta');
//            dd($request);
                $category->save();
            Session::flash('success', 'Success Creating new Solution Category!');
            return redirect()->route('admin.solutioncategory.index');
        }

        catch(\Exception $ex){
            Session::flash('error', 'Error Creating new Solution Category!');
            return redirect()->route('admin.solutioncategory.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return string
     */
    public function edit($id)
    {
        //
        $category = SolutionCategory::find($id);


        if(empty($category)){
            return "BAD REQUEST";
        }

        $data = [
            'category' => $category,
            ];
        return view('admin.solutioncategory.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
//            dd($request);
//            dd($request->input('name'));

            $validator = Validator::make($request->all(), [
                'name'            => 'required|regex:/^[a-zA-Z]/u|max:150',
//                'picture'         => 'required',
//                'description'     => 'required',
            ],[
                'name.required'     => 'Please Fill Solution Category Name!',
            ]);

            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            if(!$request->hasFile('featured-image')){
                return redirect()->back()->withErrors('Harus Memilih Gambar!', 'default')->withInput($request->all());
            }

            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $category = SolutionCategory::find($id);
            $category->name = Utilities::removeSpecialCharactes($request->input('name'));
            $category->description = Utilities::removeSpecialCharactes($request->input('description'));
            $category->save();

            if($request->file('featured-image') != null){
                // Delete old featured image
                if (!empty($data->image_path)){
                    $deletedPath = public_path($data->image_path);
                    if(file_exists($deletedPath)) unlink($deletedPath);
                }

                // Save featured image
                $folderPath = 'storage/solutions_category';
                $fileName = 'SolutionCategory_'. $category->id. '.webp';

//                $path = $request->file('featured-image')->storeAs(
//                    $folderPath, $fileName, 'public_uploads'
//                );

                $img = Image::make($request->file('featured-image'));
                $img->save(public_path($folderPath ."/". $fileName), 25);

                $category->image_path = $folderPath. '/'. $fileName;
                $category->save();
//                ImageOptimizer::optimize($data->image_path);
            }

            Session::flash('success', 'Success Updating Solution Category!');
            return redirect()->route('admin.solutioncategory.index');
        }
        catch(\Exception $ex){
            dd($ex);
            Log::error('Admin/SolutionCategoryController - SolutionCategory.php ERROR EX: '. $ex);
            Session::flash('error', 'Error Updating Solution Category!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        //
        try {
            //Belum melakukan pengecekan hubungan antar Table
            $categoryId = $request->input('id');
            $category = SolutionCategory::find($categoryId);
            $category->status_id = 2;
            $category->save();
//            $category->delete();

            //check solution
            $solutions = Solution::where('solution_category_id', $categoryId)->get();
            foreach ($solutions as $solution){
                $solution->status_id = 2;
                $solution->save();
            }

            Session::flash('success', 'Success Deleting Category');
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID'));
        }
    }
    /**
     * Function to fetch solution list for select2
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectCategorySolutions(Request $request){
        $keyword = trim($request->q);
        $solutions = DB::table('solution_categories')
            ->where('name', 'LIKE', '%'. $keyword. '%')
            ->get();

        $formatted_tags = [];
        foreach ($solutions as $solution) {
            $formatted_tags[] = ['id' => $solution->id, 'text' => $solution->name];
        }

        return \Illuminate\Support\Facades\Response::json($formatted_tags);
    }
}
