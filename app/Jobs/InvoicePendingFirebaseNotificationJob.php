<?php

namespace App\Jobs;

use App\Models\NotificationLog;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserUnit;
use App\Notifications\FCMNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class InvoicePendingFirebaseNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;
    protected Transaction $transaction;
    protected UserUnit $userUnit;
    protected String $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Transaction $transaction, UserUnit $userUnit, String $type)
    {
        $this->user = $user;
        $this->transaction = $transaction;
        $this->userUnit = $userUnit;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::channel('invoice_pending_notification_job')->info($this->transaction->transaction_no.
                ' JOB STARTED');

            Log::channel('invoice_pending_notification_job')->info($this->transaction->transaction_no.
                ' START SENDING NOTIFICATION');

            // Send firebase notification here
            //Push Notification to App.
            $title = "Invoice OSL";
            $body = "Invoice Anda sudah Dapat Dibayarkan";
            $notification = array(
                "title" => $title,
                "body"  => $body,
                //for IOS notification
                "sound"  => "default",
                "mutable_content"  => true,
                "content_available" => true
            );
            $notifData = array(
                "type_id"   => 101,
                "id"        => $this->transaction->transaction_no,
                "message"   => $body,
            );
            $messageId = "invoice-".$this->transaction->transaction_no;
            $notifReturnData = FCMNotification::SendNotification('User', $this->user->id, $messageId, $notification, $notifData);


            if($notifReturnData == "success"){
                // Update Status based on Notification Success or Error
                $nNotificationLog = new NotificationLog();
                $nNotificationLog->unit_code = $this->userUnit->unit_code;
                $nNotificationLog->transaction_id = $this->transaction->id;
                $nNotificationLog->transaction_number = $this->transaction->transaction_no;
                $nNotificationLog->user_id = $this->user->id;
                $nNotificationLog->user_name = $this->user->name;
                $nNotificationLog->user_phone = $this->user->phone;
                $nNotificationLog->user_unit_id = $this->userUnit->id;
                $nNotificationLog->type = $this->type;
                $nNotificationLog->save();
            }
            else{
                Log::channel('invoice_pending_notification_job')->info($this->transaction->transaction_no.
                    ' JOB FAILED, WITH RETURN : '.$notifReturnData);
            }

            Log::channel('invoice_pending_notification_job')->info($this->transaction->transaction_no.
                ' JOB END');

        }
        catch (\Exception $ex){
            Log::channel('invoice_pending_notification')->error($this->transaction->transaction_no.
                ' EXCEPTION '. $ex);
        }
    }
}
