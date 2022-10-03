<?php


namespace App\Http\Controllers\Admin;

use App\Libs\Utilities;
use App\Models\AdminUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Ramsey\Collection\Collection;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $admin = DB::table('admin_users')->first();

        $data = [
            'admin' => $admin,
         ];
        return view('admin.dashboard')->with($data);
    }

    public function search(Request $request){
        try{
            $resultdata = collect();
            $take = 12;
            $skip = 0;
            $searchString = Utilities::removeSpecialCharactes($request->input('search'));
            if($request->filled('skip')){
                $skip = $request->input('skip');
            }

            //get data from portfolio
            $portfolios = DB::table('portfolios')
                ->where('status_id', '!=', 2)
                ->where(function($q) use($searchString) {
                    $q->where('client_name', 'like', '%'.$searchString.'%')
                        ->orWhere('description', 'like', '%'.$searchString.'%')
                        ->orWhere('description_2', 'like', '%'.$searchString.'%')
                        ->orWhere('description_3', 'like', '%'.$searchString.'%')
                        ->orWhere('description_4', 'like', '%'.$searchString.'%')
                        ->orWhere('description_5', 'like', '%'.$searchString.'%');
                })
                ->get();
            foreach ($portfolios as $portfolio){
                $resultdata->push((object)[
                    'id' => $portfolio->id,
                    'name' => 'Portfolio - '. $portfolio->client_name,
                    'route' => route('admin.portfolio.show', ['id' => $portfolio->id]),
                    'description' => $portfolio->description,
                ]);
//                $newData = [
//                    'id' => $portfolio->id,
//                    'name' => $portfolio->client_name,
//                    'route' => route('admin.portfolio.show', ['id' => $portfolio->id]),
//                    'description' => $portfolio->description,
//                ];
//                array_push($resultdata, $newData);
            }
            //get data from solution
            $services = DB::table('solutions')
                ->where('status_id', '!=', 2)
                ->where(function($q) use($searchString) {
                    $q->where('name', 'like', '%'.$searchString.'%')
                        ->orWhere('description', 'like', '%'.$searchString.'%');
                })
                ->get();
            foreach ($services as $service){
                $resultdata->push((object)[
                    'id' => $service->id,
                    'name' => 'Solution - '. $service->name,
                    'route' => route('admin.solution.show', ['id' => $service->id]),
                    'description' => $service->description,
                ]);
//                $newData = [
//                    'id' => $solution->id,
//                    'name' => $solution->name,
//                    'route' => route('admin.solution.show', ['id' => $solution->id]),
//                    'description' => $solution->description,
//                ];
//                array_push($resultdata, $newData);
            }
            //get data from job Vacancy
            $jobVacancies = DB::table('solutions')
                ->where('status_id', '!=', 2)
                ->where(function($q) use($searchString) {
                    $q->where('name', 'like', '%'.$searchString.'%')
                        ->orWhere('description', 'like', '%'.$searchString.'%');
                })
                ->get();
            foreach ($jobVacancies as $jobVacancy){
                $resultdata->push((object)[
                    'id' => $jobVacancy->id,
                    'name' => 'Job Vacancy - '. $jobVacancy->name,
                    'route' => route('admin.job_vacancy.show', ['id' => $jobVacancy->id]),
                    'description' => $jobVacancy->description,
                ]);
//                $newData = [
//                    'id' => $jobVacancy->id,
//                    'name' => $jobVacancy->name,
//                    'route' => route('admin.job_vacancy.show', ['id' => $jobVacancy->id]),
//                    'description' => $jobVacancy->description,
//                ];
//                array_push($resultdata, $newData);
            }

            //sort all data by name
//            $keys = array_column($resultdata, 'name');
//            array_multisort($keys, SORT_ASC, $resultdata);
            $resultdata->sortBy('name');

            $count = count($resultdata);
            //counting page
            $totalPage = ceil($count/$take);

            $activePage =1;
            if($skip != 0){
                //track active page
                $activePage = intval($skip/$take) + 1;
            }

            $data = [
                'searchString' => $searchString,
                'searchCount' => $count,
                'resultdata' => $resultdata->skip($skip)->take($take),
                'skip'  => $skip,
                'take'  => $take,
                'activePage'  => $activePage,
                'totalPage'  => $totalPage,
            ];
            return view('admin.search')->with($data);
        }
        catch(\Exception $ex){
            dd($ex);
            return redirect()->route('admin.job_vacancy.index');
        }
    }

    public function examplePage(){
        return view('admin.create-form (template)');
    }
}
