<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 15/09/2017
 * Time: 9:59
 */

namespace App\Libs;

use App\Models\Transaction;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class Doku
{
    /**
     * Doku function to get Payment URL.
     *
     * @param Transaction $transaction
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function jokulCheckout(Transaction $transaction, $paymentType)
    {
        try{
            $urlSb = 'https://api-sandbox.doku.com/checkout/v1/payment';
            $urlProd = 'https://api.doku.com/checkout/v1/payment';

            $jsonObject = [
                'order'     => [
                    'amount'            => $transaction->total,
                    'invoice_number'    => $transaction->transaction_no,
                    'line_items'        => []
                ],
                'payment'   => [
                    'payment_due_date'      => 180,
                    'payment_method_types'  => [
                        $paymentType
                    ]
                ]
            ];

            $tmpItem = [
                'name'  => $transaction->transaction_no,
                'price' => floatval($transaction->amount),
                'quantity'  => 1
            ];

            array_push($jsonObject['order']['line_items'], $tmpItem);

            $tmpItem = [
                'name'  => 'Biaya Transaksi',
                'price' => floatval($transaction->doku_fee + $transaction->osl_fee),
                'quantity'  => 1
            ];

            array_push($jsonObject['order']['line_items'], $tmpItem);

            $jsonBody = json_encode($jsonObject);
            //return $jsonObject;
            $clientId = env('DOKU_CLIENT_ID');
            $currTimeStamp = Carbon::now('UTC');
            //$currTimeStamp = '2021-08-17T05:19:59Z';
            $requestTarget = '/checkout/v1/payment';

            $signature = Doku::generateSignature($jsonBody, $clientId, $transaction->rand_str, $currTimeStamp->toIso8601ZuluString(), $requestTarget);

            $asdf = [
                'Client-Id'         => $clientId,
                'Request-Id'        => $transaction->rand_str,
                'Request-Timestamp' => $currTimeStamp->toIso8601ZuluString(),
                'Signature'         => $signature,
                'Rquest-Target'     => $requestTarget
            ];

            //return $asdf;
            $client = new Client([
                'headers' => [
                    'Client-Id'         => $clientId,
                    'Request-Id'        => $transaction->rand_str,
                    'Request-Timestamp' => $currTimeStamp->toIso8601ZuluString(),
                    'Signature'         => $signature,
                    'Request-Target'    => $requestTarget
                ]
            ]);

            $request = $client->request('POST', $urlSb, [
                'json'  => $jsonObject
            ]);

            if($request->getStatusCode() == 200){
                $result = json_decode($request->getBody());

                return $result;
            }
            else{
                Log::info('libs/Doku - jokulCheckout response code: '. $request->getStatusCode());
                return "ERROR CODE";
            }
        }
        catch (\Exception $ex){
            Log::error('libs/Doku - jokulCheckout error EX: '. $ex);
            return 'Error'.$ex;
        }
    }

    /**
     * Function to generate Signature.
     *
     * @param $jsonBody
     * @param $clientId
     * @param $requestId
     * @param $requestTimeStamp
     * @param $requestTarget
     * @return string
     */
    public static function generateSignature($jsonBody, $clientId, $requestId, $requestTimeStamp, $requestTarget): string
    {
        try{
            //Generate Digest
            //Digest = SHA256 base64 hash from JsonBody
            $digest = base64_encode(hash('sha256', $jsonBody, true));

            //return $digest;

            //Generate Signature
            $tmpStr = "Client-Id:" . $clientId . "\n" .
                        "Request-Id:" . $requestId . "\n" .
                        "Request-Timestamp:" . $requestTimeStamp . "\n" .
                        "Request-Target:" . $requestTarget . "\n" .
                        "Digest:" . $digest;

            //return $tmpStr;

            return 'HMACSHA256=' . base64_encode(hash_hmac('sha256', $tmpStr, env('DOKU_CLIENT_SECERT'), true));
        }
        catch (\Exception $ex){
            Log::error('libs/Doku - generateSignature error EX: '. $ex);
            return $ex;
        }
    }
}
