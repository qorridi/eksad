<?php


namespace App\Transformer;


use App\Models\Complaint;
use App\Models\ContactUsMessage;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class SubscriberTransformer extends TransformerAbstract
{
    public function transform(Subscriber $contactUs){
        try {
            $action = "<a class='delete-modal btn btn-xs btn-danger' data-id='". $contactUs->id ."' ><i class='fas fa-xs fa-times  '></i></a>";

            return[
                'name'           => $contactUs->name,
                'email'         => $contactUs->email,
                'action'         => $action,
            ];
        }
        catch(\Exception $ex){
            Log::error('Admin/Subscriber - transform error EX: '. $ex);
            return null;
        }
    }
}
