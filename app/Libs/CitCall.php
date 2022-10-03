<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 15/09/2017
 * Time: 9:59
 */

namespace App\Libs;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CitCall
{
    /**
     * Function to do the Misscall.
     *
     * @param $phone
     * @param $gateway
     * @return mixed|string
     */
    public static function missCall($phone, $gateway){
        try{
            $client = new Client([
                'headers' => [
                    'Accept'            => 'application/json',
                    'Authorization'     => 'Apikey ' . env('CITCALL_API_KEY')
                ]
            ]);

            // Check first character
            $first = substr($phone, 0, 1);
            if($first === '0'){
                $parsedPhone = substr($phone, 1);
                $parsedPhone = '62'. $parsedPhone;
            }
            else{
                $parsedPhone = $phone;
            }

            $request = $client->post('http://104.199.196.122/gateway/v3/asynccall', [
                'json' => [
                    'msisdn'    => $parsedPhone,
                    'gateway'   => $gateway
                ]
            ]);

            if($request->getStatusCode() == 200){
                //Can do whatever with the $collect Data
                return json_decode($request->getBody());
            }
            else{
                Log::info('libs/CitCall - missCall response code: '. $request->getStatusCode());
                return "ERROR CODE";
            }
        }
        catch (\Exception $ex){
            Log::error('libs/CitCall - missCall error EX: '. $ex);
            return "INTERNAL SERVER ERROR";
        }
    }
}
