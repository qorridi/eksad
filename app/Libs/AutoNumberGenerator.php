<?php

namespace App\Libs;

use Illuminate\Support\Facades\Log;

class AutoNumberGenerator
{
    public static function generateInvTrx()
    {
        try{
            $number = '';
            return $number;
        }
        catch (\Exception $ex){
            Log::error("AutoNumberGEnerator Lib - generateInvTrx error: ". $ex);
            return -1;
        }
    }
}
