<?php


namespace App\Transformer;

use App\Models\Solution;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class SolutionTransformer extends TransformerAbstract
{
    public function transform(Solution $data){
        try {
            $date = Carbon::parse($data->created_at)->toIso8601String();
            $updateDate = Carbon::parse($data->updated_at)->toIso8601String();

            $urlShowSolution = route('admin.solution.show', ['id' => $data->id]);
            $urlEditSolution = route('admin.solution.edit', ['id' => $data->id]);
            $action = "<a class='btn btn-xs btn-info' href='". $urlShowSolution."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-info'></i></a>&nbsp";
            $action .= "<a class='btn btn-xs btn-success' href='". $urlEditSolution."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-edit'></i></a>&nbsp";

            $action .= "<a class='delete-modal btn btn-xs btn-danger' data-id='". $data->id ."' ><i class='fas fa-xs fa-times  '></i></a>";

            return[
                'created_at'        => $date,
                'updated_at'        => $updateDate,
                'name'              => $data->name,
                'category'          => $data->category_name ?? "-",
                'image_path'        => $data->image_path,
                'action'            => $action
            ];
        }
        catch(\Exception $ex){
            Log::error('Admin/Solution - transform error EX: '. $ex);
            return null;
        }
    }
}
