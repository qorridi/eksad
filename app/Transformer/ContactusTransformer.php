<?php


namespace App\Transformer;


use App\Models\Complaint;
use App\Models\ContactUsMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class ContactusTransformer extends TransformerAbstract
{
    public function transform(ContactUsMessage $contactUs){
        try {
            $date = Carbon::parse($contactUs->created_at)->toIso8601String();
            $updateDate = Carbon::parse($contactUs->updated_at)->toIso8601String();

            $urlShowComplaint = route('admin.contactus.show', ['id' => $contactUs->id]);
            $action = "<a class='btn btn-xs btn-info' href='". $urlShowComplaint."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-info'></i></a>&nbsp;";
            $action .= "<a class='delete-modal btn btn-xs btn-danger' data-id='". $contactUs->id ."' ><i class='fas fa-xs fa-times  '></i></a>";

            return[
                'created_at'        => $date,
                'updated_at'        => $updateDate,
                'name'           => $contactUs->name,
                'email'         => $contactUs->email,
                'phone'         => $contactUs->phone,
                'message'            => $contactUs->message,
                'action'            => $action
            ];
        }
        catch(\Exception $ex){
            Log::error('Admin/ContactUs - transform error EX: '. $ex);
            return null;
        }
    }
}
