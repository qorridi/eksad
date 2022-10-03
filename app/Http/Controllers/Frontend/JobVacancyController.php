<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Libs\Utilities;
use App\Models\JobApplication;
use App\Models\JobApplicationCertificate;
use App\Models\JobApplicationEducation;
use App\Models\JobApplicationExperience;
use App\Models\JobApplicationPortfolio;
use App\Models\JobVacancy;
use App\Models\JobVacancyDepartment;
use App\Models\JobVacancyLevel;
use App\Models\Solution;
use App\Models\SolutionCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;

class JobVacancyController extends Controller
{
    public function index(Request $request){
        $jobVacancies = JobVacancy::with('job_vacancy_department')->with('job_vacancy_level')->where('status_id',1);

        $selectedDepartment = 'All';
        $selectedLevel = 'All';
        $filterKeyword = '';
        if($request->query('keyword') !== null){
            $filterKeyword = $request->query('keyword');
            $jobVacancies = $jobVacancies->where('name', 'LIKE', '%'. $filterKeyword. '%');
        }

        if($request->query('job_level') != null && $request->query('job_level') != 0){
            $jobVacancies = $jobVacancies->where('job_vacancy_level_id', $request->query('job_level'));
            $jobLevel = JobVacancyLevel::where('id', $request->query('job_level'))->first();
            $selectedLevel = $jobLevel->description;
        }

        if($request->query('job_department') != null && $request->query('job_department') != 0){
            $jobVacancies = $jobVacancies->where('job_vacancy_department_id', $request->query('job_department'));
            $jobDepartment = JobVacancyDepartment::where('id', $request->query('job_department'))->first();
            $selectedDepartment = $jobDepartment->description;
        }

        $jobVacancies = $jobVacancies->paginate(6);

        $jobLevels = JobVacancyLevel::where('status_id', 1)->get();
        $jobVacancyDepartment = JobVacancyDepartment::where('status_id', 1)->get();

        if(str_contains($request->query('keyword'), '%')){
            $jobVacancies = [];
        }

        return view('frontend.career', [
            'jobVacancies'          => $jobVacancies,
            'filterKeyword'         => $filterKeyword,
            'jobLevels'             => $jobLevels,
            'jobVacancyDepartments' => $jobVacancyDepartment,
            'selectedDepartment'    => $selectedDepartment,
            'selectedLevel'         => $selectedLevel
        ]);
    }

    public function show($slug){
        $job = JobVacancy::where('slug', $slug)->first();
        if(empty($job)){
            return redirect()->back();
        }

        if(empty($job)){
            return 'BAD REQUEST';
        }

        $shareButtons = (new \Jorenvh\Share\Share)->page(route('frontend.career_detail', ['slug' => $job->slug]), $job->name)
            ->linkedin('Something New from Eksad For your Interest')
            ->facebook()
            ->whatsapp()
            ->getRawLinks();


        return view('frontend.career_detail', [
            'job' => $job,
            'shareButtons' => $shareButtons,
        ]);
    }
    public function career_form($id){
        $job = JobVacancy::find($id);
        if(empty($job)){
            return redirect()->back();
        }
        return view('frontend.career_form', [
            'job' => $job,
        ]);
    }
    public function career_submit(Request $request){
        $id = $request->input('job_vacancy_id');
        $slug = $request->input('job_vacancy_slug');
        try{
            $certificates = $request->file('featured-image');
            $portfolios = $request->file('cv-portfolio');

            $validator = Validator::make($request->all(), [
                'name'      => 'required|regex:/^[a-zA-Z]/u|max:200',
                'email'     => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:50',
//                'phone'     => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,13|starts_with:62,0',
                'phone'     => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|starts_with:+628,08,02',
            ]);
            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            $number = $request->input('phone');
            $length = strlen((string) $number);
            if($length < 10 || $length > 15){
                return redirect()->back()->withErrors('The phone must be between 10 and 15 digits!', 'default')->withInput($request->all());
            }

            //other validation
            if(empty($portfolios)){
                return back()->withErrors("Required Portfolio")->withInput($request->all());
            }

            $header = JobApplication::create([
                'job_vacancy_id'    => $request->input('job_vacancy_id'),
                'name'              => $request->filled('name') ? Utilities::removeSpecialCharactes($request->input('name')) : "",
                'gender'            => $request->filled('gender') ? Utilities::removeSpecialCharactes($request->input('gender')) : "",
                'phone'             => $request->filled('phone') ? Utilities::removeSpecialCharactes($request->input('phone')) : "",
                'email'             => $request->filled('email') ? $request->input('email') : "",
                'address'           => $request->filled('address') ? Utilities::removeSpecialCharactes($request->input('address')) : "",
                'district'          => $request->filled('district') ? Utilities::removeSpecialCharactes($request->input('district')) : "",
                'city'              => $request->filled('city') ? Utilities::removeSpecialCharactes($request->input('city')) : "",
                'province'          => $request->filled('province') ? Utilities::removeSpecialCharactes($request->input('province')) : "",
                'country'           => $request->filled('country') ? Utilities::removeSpecialCharactes($request->input('country')) : "",
                'sosmed1'           => $request->input('sosmed1'),
                'sosmed2'           => $request->input('sosmed2'),
                'sosmed3'           => $request->input('sosmed3'),
                'sosmed4'           => $request->input('sosmed4'),
                'online_porto_1'    => $request->input('online-1'),
                'online_porto_2'    => $request->input('online-2'),
                'short_desc'        => $request->filled('short_desc') ? Utilities::removeSpecialCharactes($request->input('short_desc')) : "",
                'created_at'        => Carbon::now('Asia/Jakarta')
            ]);

            //insert to education table
            $ct=0;
            $eduInstitutionals = $request->input('eduInstitutional');
            $eduDegrees = $request->input('eduDegree');
            $eduFieldStudys = $request->input('eduFieldStudy');
            $eduGrades = $request->input('eduGrade');
            $eduLocations = $request->input('eduLocation');
            $eduStartYears = $request->input('eduStartYear');
            $eduEndYears = $request->input('eduEndYear');
            $eduDescs = $request->input('eduDesc');
            foreach ($eduInstitutionals as $eduInstitutional){
                $detail = JobApplicationEducation::create([
                    'career_application_id' => $header->id,
                    'instution'             => $eduInstitutionals[$ct] != null ? Utilities::removeSpecialCharactes($eduInstitutionals[$ct]) : "",
                    'degree'                => $eduDegrees[$ct] != null ? Utilities::removeSpecialCharactes($eduDegrees[$ct]) : "",
                    'field_of_study'        => $eduFieldStudys[$ct] != null ? Utilities::removeSpecialCharactes($eduFieldStudys[$ct]) : "",
                    'grade'                 => $eduGrades[$ct] != null ? Utilities::removeSpecialCharactes($eduGrades[$ct]) : "",
                    'location'              => $eduLocations[$ct] != null ? Utilities::removeSpecialCharactes($eduLocations[$ct]) : "",
                    'start_year'            => $eduStartYears[$ct],
                    'end_year'              => $eduEndYears[$ct],
                    'description'           => $eduDescs[$ct] != null ? Utilities::removeSpecialCharactes($eduDescs[$ct]) : "",
                    'created_at'            => Carbon::now('Asia/Jakarta')
                ]);
                $ct++;
            }

            //insert to experience table
            $ct2=0;
            $expTitles = $request->input('expTitle');
            $expEmploymentTypes = $request->input('expEmploymentType');
            $expCompanys = $request->input('expCompany');
            $expStartMonths = $request->input('expStartMonth');
            $expStartYears = $request->input('expStartYear');
            $expEndMonths = $request->input('expEndMonth');
            $expEndYears = $request->input('expEndYear');
            $expDescs = $request->input('expDesc');
            foreach ($expTitles as $expTitle){
                $detail = JobApplicationExperience::create([
                    'career_application_id' => $header->id,
                    'title'                 => $expTitles[$ct2] != null ? Utilities::removeSpecialCharactes($expTitles[$ct2]) : "",
                    'company'               => $expCompanys[$ct2] != null ? Utilities::removeSpecialCharactes($expCompanys[$ct2]) : "",
                    'start_month'           => $expStartMonths[$ct2],
                    'start_year'            => $expStartYears[$ct2],
                    'end_month'             => $expEndMonths[$ct2],
                    'end_year'              => $expEndYears[$ct2],
                    'is_still_working'      => 0,
                    'description'           => $expDescs[$ct2] != null ? Utilities::removeSpecialCharactes($expDescs[$ct2]) : "",
                    'created_at'            => Carbon::now('Asia/Jakarta')
                ]);
                $ct2++;
            }

            $ct3 = 0;
            if($portfolios != null){
                try{
                    foreach ($portfolios as $portfolio){
                        $folderPath = 'storage/job_applications';
                        $ext = $portfolio->extension();
                        $fileName = 'JOB_APPLICATION_CV_'. $header->id . '_' . $ct3 .'.'.$ext;
                        $path = $portfolio->storeAs(
                            "", $fileName, 'job_applications'
                        );

                        $detail = JobApplicationPortfolio::create([
                            'career_application_id' => $header->id,
                            'filename'              => $fileName,
                        ]);
                        $ct3++;
                    }
                }
                catch(\Exception $ex){
                    Log::error('Job Vacancy Error'. $ex);
                }
            }

            $ct4 = 0;
            if($certificates != null){
                try{
                    foreach ($certificates as $certificate){
                        $folderPath = 'storage/job_applications';
                        $ext = $certificate->extension();
                        $fileName = 'JOB_APPLICATION_CERTIFICATE_'. $header->id . '_' . $ct4 .'.'.$ext;
                        $path = $certificate->storeAs(
                            "", $fileName, 'job_applications'
                        );

                        $detail = JobApplicationCertificate::create([
                            'career_application_id' => $header->id,
                            'filename'              => $fileName,
                        ]);
                        $ct4++;
                    }
                }
                catch(\Exception $ex){
                }
            }

            Session::flash('success', 'Your Career Form is Received!');
        }
        catch(\Exception $ex){
            Session::flash('error', 'Something Went Wrong! '.$ex->getMessage());
        }
        return redirect()->route('frontend.career_detail', ['slug' => $slug]);
    }
}
