<?php

namespace App\Libs;

use App\Models\AutoNumber;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GenerateAutoNumber
{
    public static function generateInvoiceTrxNo($type)
    {
        try{
            $currDate = Carbon::now('Asia/Jakarta');

            //Get Current No
            $autoNumber = AutoNumber::where('doc_code', 'INV')->first();
            $result = 'INV/' . strtoupper($type) . '/' . $currDate->year . '/' . $currDate->month . '/' . $autoNumber->next_no;

            $autoNumber->next_no++;
            $autoNumber->save();

            return $result;
        }
        catch (\Exception $ex){
            Log::error("GenerateAutoNumber Lib - generateInvoiceTrxNo error: ". $ex);
            return $ex;
        }
    }
    public static function generateComplaintTrxNo($type)
    {
        try{
            $currDate = Carbon::now('Asia/Jakarta');

            //Get Current No
            $autoNumber = AutoNumber::where('doc_code', 'CPT')->first();
            $result = 'CPT/' . strtoupper($type) . '/' . $currDate->year . '/' . $currDate->month . '/' . $autoNumber->next_no;

            $autoNumber->next_no++;
            $autoNumber->save();

            return $result;
        }
        catch (\Exception $ex){
            Log::error("GenerateAutoNumber Lib - generateComplaintTrxNo error: ". $ex);
            return $ex;
        }
    }
}
