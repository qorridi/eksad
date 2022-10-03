<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;


use App\Models\AdminUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class AdminUserTransformer extends TransformerAbstract
{
    public function transform(AdminUser $user){

        try{
            $createdDate = Carbon::parse($user->created_at)->format('d M Y');

            $action = "<a class='btn btn-xs btn-info' href='adminuser/edit/".$user->id."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-edit'></i></a>&nbsp";
            $action .= "<a class='delete-modal btn btn-xs btn-danger' data-id='". $user->id ."' ><i class='fas fa-xs fa-times  '></i></a>";


            return[
                'email'             => $user->email,
                'name'              => $user->name,
                'phone'             => $user->phone,
                'created_at'        => $createdDate,
                'action'            => $action
            ];
        }
        catch(\Exception $ex){
            Log::error('Admin/AdminUser - transform error EX: '. $ex);
            return null;
        }
    }
}
