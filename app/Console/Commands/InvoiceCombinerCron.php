<?php

namespace App\Console\Commands;

use App\Helpers\DatabaseConnection;
use App\Jobs\InvoicePendingFirebaseNotificationJob;
use App\Libs\GenerateAutoNumber;
use App\Models\Company;
use App\Models\CronjobLock;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\UserUnit;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceCombinerCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice_combiner:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'function to combine 3 types of invoice to one invoice';

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
            $lockConfig = CronjobLock::where('name', 'invoice_combiner_cron')->first();
            if($lockConfig->is_locked){
                Log::channel('invoice_combiner_cron')->error('CRONJOB LOCKED');
                return 0;
            }
            else{
                $lockConfig->is_locked = true;
                $lockConfig->save();
            }

            $units = UserUnit::with('company')->get();
            $tmpNow = Carbon::now('Asia/Jakarta');
            $tmpMonth = $tmpNow->month;
            $year = 2021;

            $tmpData = [
                'month'     => intval($tmpMonth),
                'details'   => []
            ];

            foreach ($units as $unit){
                $dbConn = DatabaseConnection::setConnection($unit->company);

                if($dbConn->table('m_Customer')->where('Phone1', $unit->user->phone)->exists()) {
                    $cust = $dbConn->table('m_Customer')->where('Phone1', $unit->user->phone)->first();
                    if ($dbConn->table('m_block')->where('funit_code', $unit->unit_code)->where('ftenant', $cust->Code)->exists()) {
                        $tmpUnit = $dbConn->table('m_block')->where('funit_code', $unit->unit_code)->first();
                        if($dbConn->table('trx_Invoice')->where('id_BlockUnit', $tmpUnit->id)->exists()){
                            //if invoice exist for that unit
                            $tmpResult = [];

                            for($i=0; $i<10; $i++){
                                $invs = $dbConn->table('trx_Invoice')
                                    ->where('id_BlockUnit', $tmpUnit->id)
                                    ->whereMonth('TransactionDate', $tmpMonth)
                                    ->whereYear('TransactionDate', $year)
                                    ->where('TransactionNumber', 'not like', '%PLT%')
                                    ->orderByDesc('TransactionDate')
                                    ->get();

                                if(count($invs) > 0){
                                    foreach ($invs as $inv){
                                        //Check in DB If transaction already exist
                                        if(!DB::table('transaction_details')
                                            ->where('invoice_no', $inv->TransactionNumber)
                                            ->where('company_code', $unit->company->code)
                                            ->exists()){
                                            $tmpRes = [
                                                'inv_no'        => $inv->TransactionNumber,
                                                'amount'        => floatval($inv->Grandtotal),
                                                'is_penalty'    => false,
                                                'date'          => $inv->TransactionDate,
                                                'company_code'  => $unit->company->code
                                            ];

                                            if(str_contains($inv->TransactionNumber, 'PLT')){
                                                $tmpRes['is_penalty'] = true;
                                            }

                                            array_push($tmpData['details'], $tmpRes);

                                            //search if there are penalties
                                            $tmpPltTrx = 'PLT/' . $inv->TransactionNumber;
                                            if($dbConn->table('trx_Invoice')->where('TransactionNumber', $tmpPltTrx)->exists()){
                                                //get PLT
                                                $tmpPlt = $dbConn->table('trx_Invoice')->where('TransactionNumber', $tmpPltTrx)->first();
                                                $tmpResPlt = [
                                                    'inv_no'        => $tmpPlt->TransactionNumber,
                                                    'amount'        => floatval($tmpPlt->Grandtotal),
                                                    'is_penalty'    => true,
                                                    'date'          => $tmpPlt->TransactionDate,
                                                    'company_code'  => $unit->company->code
                                                ];

                                                array_push($tmpData['details'], $tmpResPlt);
                                            }
                                        }
                                        else{
                                            //Check if existing Transaction Penalty is changed
                                            $tmpTrxDt = TransactionDetail::
                                            where('invoice_no', $inv->TransactionNumber)
                                                ->where('company_code', $unit->company->code)->first();

                                            $tmpPltTrxNo = 'PLT/' . $inv->TransactionNumber;
                                            if($dbConn->table('trx_Invoice')->where('TransactionNumber', $tmpPltTrxNo)->exists())
                                            {
                                                $tmpPltTrx = $dbConn->table('trx_Invoice')->where('TransactionNumber', $tmpPltTrxNo)->first();
                                                if(floatval($tmpPltTrx->Grandtotal) != floatval($tmpTrxDt->amount)){
                                                    $tmpTrxDt->amount = floatval($tmpPltTrx->Grandtotal);
                                                    $tmpTrxDt->updated_at = Carbon::now('Asia/Jakarta');
                                                    $tmpTrxDt->save();
                                                }
                                            }
                                        }
                                    }
                                }

                                $tmpMonth--;
                                if($tmpData['month'] != $tmpMonth){
                                    array_push( $tmpResult, $tmpData);
                                    $tmpData['month'] = intval($tmpMonth);
                                    $tmpData['details'] = [];
                                }
                            }

                            //Save to DB
                            foreach ($tmpResult as $data){
                                if(count($data['details']) > 0){
                                    //Check current DB
                                    $header = new Transaction();
                                    $header->transaction_no = GenerateAutoNumber::generateInvoiceTrxNo('PG');
                                    $header->status_id = 6;
                                    $header->user_unit_id = $unit->id;
                                    $header->user_id = $unit->user_id;
                                    $header->amount = 0;
                                    $header->total = 0;
                                    $header->osl_fee = $unit->company->fee;
                                    $header->save();

                                    foreach ($data['details'] as $dt){
                                        $detail = new TransactionDetail();
                                        $detail->transaction_id = $header->id;
                                        $detail->invoice_no = $dt['inv_no'];
                                        $detail->amount = $dt['amount'];
                                        $detail->is_penalty = $dt['is_penalty'];
                                        $tmpDateDt = Carbon::parse($dt['date']);
                                        $detail->date = $tmpDateDt->toDateTimeString();
                                        $detail->company_code = $dt['company_code'];

                                        $type = 0;
                                        if(substr($dt['inv_no'], 0, 2) == 'SC'){
                                            $type = 1;
                                        }
                                        if(substr($dt['inv_no'], 0, 2) == 'SF'){
                                            $type = 2;
                                        }
                                        if(substr($dt['inv_no'], 0, 2) == 'UT'){
                                            $type = 3;
                                        }
                                        if(substr($dt['inv_no'], 0, 2) == 'PLT'){
                                            $type = 4;
                                        }
                                        $detail->type = $type;
                                        $detail->save();

                                        $header->amount += $detail->amount;
                                        $header->total += $detail->amount;
                                    }

                                    $header->save();
                                }
                            }
                        }

                        $tmpMonth = $tmpNow->month;
                        $tmpData['month'] = intval($tmpMonth);
                    }
                }
            }

            $lockConfig = CronjobLock::where('name', 'invoice_combiner_cron')->first();
            if($lockConfig->is_locked){
                $lockConfig->is_locked = false;
                $lockConfig->save();
                Log::channel('invoice_combiner_cron')->info('CRONJOB UNLOCKED');
                return 0;
            }
        }
        catch (\Exception $ex){
            Log::channel('invoice_combiner_cron')->error($ex);
            $lockConfig = CronjobLock::where('name', 'invoice_combiner_cron')->first();
            if($lockConfig->is_locked){
                $lockConfig->is_locked = false;
                $lockConfig->save();
                Log::channel('invoice_combiner_cron')->error('CRONJOB ERROR UNLOCKED');
                return 0;
            }
        }

        return 0;
    }
}
