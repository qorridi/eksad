<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Utilities;
use App\Models\JobVacancy;
use App\Models\JobVacancyDepartment;
use App\Models\JobVacancyLevel;
use App\Models\SolutionCategory;
use App\Models\Portfolio;
use App\Models\Solution;
use App\Transformer\JobVacancyTransformer;
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

class JobVacancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.job_vacancy.index');
    }

    public function getIndex(Request $request){

//        $datas = Solution::query();

        $datas = JobVacancy::where('status_id', '!=', 2)->get();
//        $datas = JobVacancy::join('job_vacancy_departments', 'job_vacancy_departments.id', '=', 'job_vacancies.job_vacancy_department_id')
//            ->join('job_vacancy_levels', 'job_vacancy_levels.id', '=', 'job_vacancies.job_vacancy_level_id')
//            ->select('blogs.*', 'job_vacancy_levels.description as level', 'job_vacancy_departments.description as department')
//            ->where('status_id', '!=', 2)->get();


        return DataTables::of($datas)
            ->setTransformer(new JobVacancyTransformer)
            ->make(true);
    }

    public function show($id){
        $data = JobVacancy::where('id', $id)->first();

//        dd($data);
        return view('admin.job_vacancy.show', compact('data'));
    }

    public function create(){
        $solutions = Solution::find(1);
        $categories = SolutionCategory::where('status_id', 1)->get();
        $departments = JobVacancyDepartment::where('status_id', 1)->get();
        $levels = JobVacancyLevel::where('status_id', 1)->get();
        $data = [
            'categories'    => $categories,
            'solutions'    => $solutions,
            'departments'    => $departments,
            'levels'    => $levels,
        ];
        return view('admin.job_vacancy.create')->with($data);
    }

    public function store(Request $request){
//dd($request);
        try{
            $validator = Validator::make($request->all(),[
                'name'                  => 'required|regex:/^[a-zA-Z]/u|max:100',
                'category'           => 'required',
                'description'           => 'required',

            ],[
                'name.required'                 => 'Nama Solusi wajib diisi!',
                'category.required'             => 'Kategori Solusi wajib diisi!',
                'description.required'          => 'Deskripsi wajib diisi!',


            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput($request->all());
            }

            // Checking title exist
            $title = addslashes($request->input('name'));

            $dateTimeNow = Carbon::now('Asia/Jakarta');

            $user = Auth::guard('admin')->user();
            $slug = Str::slug(strtolower($request->input('name')));

            $name = addslashes($request->input('name'));
            $nameLower = strtolower($name);
            $existSolution = JobVacancy::whereRaw("LOWER(name) = '". $nameLower ."'")
                ->first();
            if(!empty($existSolution)){
                return redirect()->back()->withErrors('Job Vacancy sudah ada!', 'default')->withInput($request->all());
            }
//        dd($request);
            $newData = JobVacancy::create([
                'solution_category_id'      => $request->input('category'),
                'name'                      => Utilities::removeSpecialCharactes($request->input('name')),
                'slug'                      => $slug,
                'job_vacancy_level_id'      => $request->input('level'),
                'job_vacancy_department_id' => $request->input('department'),
                'description'               => $request->input('description'),
                'status_id'                 => 1,
                'created_at'                => $dateTimeNow->toDateTimeString(),
                'created_by'                => $user->id,
            ]);

            //update sitemap for SEO
//        Utilities::CreateSitemap();
            Session::flash('message', 'Berhasil buat Job Vacancy baru!');

            return redirect()->route('admin.job_vacancy.show', ['id' => $newData->id]);
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Gagal buat Job Vacancy baru!');
            return redirect()->route('admin.job_vacancy.index');
        }
    }

    public function edit($id){
        $categories = SolutionCategory::where('status_id', 1)->get();
        $data = JobVacancy::find($id);
        $departments = JobVacancyDepartment::where('status_id', 1)->get();
        $levels = JobVacancyLevel::where('status_id', 1)->get();
        if(empty($data)){
            return redirect()->back();
        }

        $data = [
            'solution'  => $data,
            'categories'  => $categories,
            'departments' => $departments,
            'levels' => $levels,
        ];

        return view('admin.job_vacancy.edit')->with($data);
    }

    public function update(Request $request, $id ){

        try{
            $validator = Validator::make($request->all(),[
                'name'                  => 'required|regex:/^[a-zA-Z]/u|max:100',
                'category'              => 'required',
                'description'           => 'required',
            ],[
                'name.required'                 => 'Nama Solusi wajib diisi!',
                'description.required'          => 'Deskripsi wajib diisii!',
                'category.required'             => 'Kategori wajib diisii!',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput($request->all());
            }

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            if($request->input('category') == -1){
                return redirect()->back()->withErrors('Kategori wajib diisii!', 'default')->withInput($request->all());
            }
            // Checking title exist
            $name = addslashes($request->input('name'));
            $nameLower = strtolower($name);
            $existSolution = JobVacancy::whereRaw("LOWER(name) = '". $nameLower ."'")
                ->where('id', '!=', $id)
                ->first();

            //dd($existBlog);

            if(!empty($existSolution)){
                return redirect()->back()->withErrors('Job Vacancy sudah ada!', 'default')->withInput($request->all());
            }
            $id = $request->input('id');
            $slug = Str::slug(strtolower($request->input('name')));

            $dateTimeNow = Carbon::now('Asia/Jakarta');

            $user = Auth::guard('admin')->user();
            //dd($user);

            $data = JobVacancy::find($id);
            //dd($id, $data);
            if(empty($data)){
                return redirect()->back();
            }

            $data->solution_category_id = $request->input('category');
            $data->name = Utilities::removeSpecialCharactes($request->input('name'));
            $data->slug = $slug;
            $data->job_vacancy_level_id = $request->input('level');
            $data->job_vacancy_department_id = $request->input('department');
            $data->description = $request->input('description');
            $data->updated_by = $user->id;
            $data->updated_at = $dateTimeNow->toDateTimeString();
            $data->save();

            //update sitemap for SEO
            Session::flash('message', 'Berhasil ubah Job Vacancy!');

            return redirect()->route('admin.job_vacancy.show', ['id' => $id]);
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Gagal Ubah Job Vacancy! '.$ex->getMessage());
            return redirect()->route('admin.job_vacancy.index');
        }
    }

    public function destroy(Request $request){
//        dd($request);
        try{
            $dataId = $request->input('id');
            $data = JobVacancy::find($dataId);
            if(empty($data)){
                return redirect()->back();
            }
            $data->status_id = 2;
            $data->save();

            //update sitemap for SEO
//        Utilities::CreateSitemap();
            Session::flash('message', 'Berhasil Hapus Job Vacancy!');
            return redirect()->route('admin.job_vacancy.index');
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Gagal Hapus Job Vacancy!');
            return redirect()->route('admin.job_vacancy.index');
        }
    }
}
