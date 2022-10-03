<?php


namespace App\Transformer;


use App\Models\AboutTeam;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class TeamTransformer extends TransformerAbstract
{
    public function transform(AboutTeam $team){
        try {
            $date = Carbon::parse($team->created_at)->toIso8601String();

            $urlShowBlog = route('admin.team.edit', ['id' => $team->id]);
            $action = "<a class='btn btn-xs btn-info' href='". $urlShowBlog."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-edit'></i></a>";
            $action .= "<a class='delete-modal btn btn-xs btn-danger' data-id='". $team->id ."' ><i class='fas fa-xs fa-times'></i></a>";

            return[
                'created_at'    => $date,
                'name'          => $team->name,
                'position'      => $team->position,
                'description'   => $team->description ?? "-",
                'sosmed_1'      => $team->sosmed_1,
                'sosmed_2'      => $team->sosmed_2,
                'sosmed_3'      => $team->sosmed_3,
                'status'        => $team->status->description,
                'action'        => $action
            ];
        }
        catch(\Exception $ex){
            Log::error('Admin/Team - transform error EX: '. $ex);
            return null;
        }
    }
}
