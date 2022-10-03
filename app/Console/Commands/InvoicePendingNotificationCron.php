<?php

namespace App\Console\Commands;

use App\Helpers\DatabaseConnection;
use App\Jobs\InvoicePendingFirebaseNotificationJob;
use App\Models\Company;
use App\Models\CronjobLock;
use App\Models\Transaction;
use App\Models\UserUnit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoicePendingNotificationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice_pending_notification:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cronjob to send firebase notification to android and ios devices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $lockConfig = CronjobLock::where('name', 'invoice_pending_notification_cron')->first();
            if($lockConfig->is_locked){
                Log::channel('invoice_pending_notification_cron')->error('CRONJOB LOCKED');
                return 0;
            }
            else{
                $lockConfig->is_locked = true;
                $lockConfig->save();
            }

            $userUnits = UserUnit::all();
            foreach ($userUnits as $userUnit){
                $transactions = Transaction::where('user_unit_id', $userUnit->id)->where('status_id', 6)->get();
                foreach ($transactions as $trx){
                    if(!DB::table('notification_logs')
                        ->where('transaction_number', $trx->transaction_no)
                        ->where('user_unit_id', $userUnit->id)
                        ->where('user_id', $userUnit->user->id)
                        ->exists()){
                        //send notification
                        InvoicePendingFirebaseNotificationJob::dispatch($userUnit->user, $trx, $userUnit, 'Owner')->onQueue('invoice_notification');
                    }

                    foreach ($userUnit->user_members as $member){
                        if(!DB::table('notification_logs')
                            ->where('transaction_number', $trx->transaction_no)
                            ->where('user_unit_id', $userUnit->id)
                            ->where('user_id', $member->user->id)
                            ->exists()){
                            //send notification
                            InvoicePendingFirebaseNotificationJob::dispatch($member->user, $trx, $userUnit, $member->type)->onQueue('invoice_notification');
                        }
                    }
                }
            }

            $lockConfig = CronjobLock::where('name', 'invoice_pending_notification_cron')->first();
            if($lockConfig->is_locked){
                $lockConfig->is_locked = false;
                $lockConfig->save();
                Log::channel('invoice_pending_notification_cron')->info('CRONJOB UNLOCKED');
                return 0;
            }
        }
        catch (\Exception $ex){
            Log::channel('invoice_pending_notification')->error($ex);
            $lockConfig = CronjobLock::where('name', 'invoice_pending_notification_cron')->first();
            if($lockConfig->is_locked){
                $lockConfig->is_locked = false;
                $lockConfig->save();
                Log::channel('invoice_pending_notification_cron')->error('CRONJOB ERROR UNLOCKED');
                return 0;
            }
        }

        return 0;
    }
}
