<?php


namespace App\Transformer;


use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class PortfolioTransformer extends TransformerAbstract
{
    public function transform(Portfolio $data){
        try {
            $date = Carbon::parse($data->created_at)->toIso8601String();
            $updateDate = Carbon::parse($data->updated_at)->toIso8601String();

            $urlShow = route('admin.portfolio.show', ['id' => $data->id]);
            $action = "<a class='btn btn-xs btn-info' href='". $urlShow."'><i class='fas fa-info'></i></a>&nbsp;";


            $urlEdit = route('admin.portfolio.edit', ['id' => $data->id]);
            $action .= "<a class='btn btn-xs btn-primary' href='". $urlEdit."'><i class='fas fa-edit'></i></a>&nbsp;";

            $action .= "<button type='button' class='btn-delete btn btn-xs btn-danger' data-id='". $data->id ."' data-client-name='". $data->client_name. "'><i class='fas fa-trash'></i></button>";

            return[
                'created_at'        => $date,
                'updated_at'        => $updateDate,
                'client_name'       => $data->client_name,
                'description'       => $data->description ?? "-",
                'year'              => $data->year,
                'action'            => $action
            ];
        }
        catch(\Exception $ex){
            Log::error('Admin/Portfolio - transform error EX: '. $ex);
            return null;
        }
    }
}
