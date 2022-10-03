<?php


namespace App\Transformer;

use App\Models\JobVacancy;
use App\Models\JobVacancyLevel;
use App\Models\JobVacancyDepartment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class JobVacancyTransformer extends TransformerAbstract
{
    public function transform(JobVacancy $data){
        try {
            $date = Carbon::parse($data->created_at)->toIso8601String();
            $updateDate = Carbon::parse($data->updated_at)->toIso8601String();

            $urlShowService = route('admin.job_vacancy.show', ['id' => $data->id]);
            $urlEditService = route('admin.job_vacancy.edit', ['id' => $data->id]);
            $action = "<a class='btn btn-xs btn-info' href='". $urlShowService."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-info'></i></a>&nbsp";
            $action .= "<a class='btn btn-xs btn-success' href='". $urlEditService."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-edit'></i></a>&nbsp";

//            $action .= "<a class='delete-modal btn btn-xs btn-danger' data-id='". $data->id ."' ><i class='fas fa-xs fa-times  '></i></a>";

            return[
                'created_at'        => $date,
                'updated_at'        => $updateDate,
                'name'              => $data->name ?? "-",
                'description'       => $data->description ?? "-",
                'level'             => $data->job_vacancy_level->description,
                'department'        => $data->job_vacancy_department->description,
                'location'          => $data->location,
                'action'            => $action
            ];
        }
        catch(\Exception $ex){
            Log::error('Admin/JobVacancy - transform error EX: '. $ex);
            return null;
        }
    }
}
