<?php


namespace App\Transformer;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user){
        try {
            $date = Carbon::parse($user->created_at)->format('d M Y');
            $updateDate = Carbon::parse($user->updated_at)->toIso8601String();

            $urlShowUser = route('admin.user.show', ['id' => $user->id]);
            $name = "<a name='". $user->name. "' href='".$urlShowUser."' data-toggle='tooltip' data-placement='top'>". $user->name. "</a>";
            $action = "<a class='btn btn-xs btn-info' href='". $urlShowUser."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-info'></i></a>";

            return[
                'created_at'        => $date,
                'updated_at'        => $updateDate,

                'name'              => $name,
                'phone'              => $user->phone,
                'email'              => $user->email,
                'user_name'         => $user->name,
//                'unit_code'         => $user->user_unit->unit_code,
                'status'            => $user->status->description,
                'action'            => $action
            ];
        }
        catch(\Exception $ex){
            Log::error('Admin/User - transform error EX: '. $ex);
            return null;
        }
    }
}
