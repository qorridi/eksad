<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\libs\Utilities;
use App\Models\JobVacancy;
use App\Models\JobVacancyLevel;
use App\Transformer\JobVacancyLevelTransformer;
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

class JobVacancyLevelController extends Controller
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
        $categories = JobVacancyLevel::where('status_id', 1)->orderby('id', 'asc')->get();
        return DataTables::of($categories)
            ->setTransformer(new JobVacancyLevelTransformer)
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
        return view('admin.vacancylevel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.vacancylevel.create');
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
            ]);

            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            //Create Admin
            $category = JobVacancyLevel::create([
                'description'          => $request->input('name'),
                'status_id'             => 1

            ]);

            $dateTimeNow = Carbon::now('Asia/Jakarta');

                $category->save();
            Session::flash('success', 'Success Creating new Job Vacancy Level!');
            return redirect()->route('admin.vacancylevel.index');
        }

        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Error Creating new Job Vacancy Level!');
            return redirect()->route('admin.vacancylevel.index');
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
        $category = JobVacancyLevel::find($id);


        if(empty($category)){
            return "BAD REQUEST";
        }
        return view('admin.vacancylevel.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
//            dd($request->input('id'));
//            dd($request->input('name'));

            $validator = Validator::make($request->all(), [
                'name'            => 'required|regex:/^[a-zA-Z]/u|max:150',
//                'picture'         => 'required',
//                'description'     => 'required',
            ],[
                'name.required'     => 'Please Fill Job Vacancy Level name!',
            ]);

            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $category = JobVacancyLevel::find($id);
            $category->description = $request->input('name');

            $category->save();
            Session::flash('success', 'Success Job Vacancy Level!');
            return redirect()->route('admin.vacancylevel.index');
        }
        catch(\Exception $ex){

            Log::error('Admin/JobVacancyLevelController - JobVacancyLevel ERROR EX: '. $ex);
            Session::flash('error', 'Error Updating Job Vacancy Level! '.$ex->getMessage());
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

            //pengecekan ke table blog
//            if(Blog::where('blog_category_id', $categoryId)->exists()){
//                Session::flash('error', 'Category Id Sudah Terpakai');
//                return Response::json(array('success' => 'VALID'));
//            }

            $category = JobVacancyLevel::find($categoryId);
            $category->status_id = 2;
            $category->save();
//            $category->delete();

            Session::flash('success', 'Success Deleting Category');
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            Session::flash('error', 'Gagal Menghapus '.$ex->getMessage());
            Log::error('Admin/JobVacancyLevelController - destroy ERROR EX: '. $ex);
            return Response::json(array('errors' => 'INVALID'));
        }
    }
}
