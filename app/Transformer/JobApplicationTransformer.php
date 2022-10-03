<?php


namespace App\Transformer;

use App\Models\JobApplication;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class JobApplicationTransformer extends TransformerAbstract
{
    public function transform(JobApplication $data){
        try {
            $date = Carbon::parse($data->created_at)->toIso8601String();

            $urlShowService = route('admin.job_application.show', ['id' => $data->id]);
            $action = "<a class='btn btn-xs btn-info' href='". $urlShowService."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-info'></i></a>&nbsp";
            $action .= "<a class='delete-modal btn btn-xs btn-danger ' data-id='". $data->id ."' ><i class='fas fa-xs fa-times  '></i></a>";

            return[
                'created_at'            => $date,
                'name'                  => $data->name,
                'phone'                 => $data->phone,
                'email'                 => $data->email,
                'job_vacancy_name'      => $data->job_vacancy->name ?? "-",
                'job_vacancy_division'  => $data->job_vacancy->job_vacancy_department->description ?? "-",
                'action'                => $action
            ];
        }
        catch(\Exception $ex){
            Log::error('Admin/JobApplication - transform error EX: '. $ex);
            return null;
        }
    }
}
