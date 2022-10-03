<?php
/**
 * Created by PhpStorm.
 * User: YANSEN
 * Date: 2/13/2019
 * Time: 21:26
 */

namespace App\Notifications;

use App\Models\CompanyAdmin;
use App\Models\User;
use App\Models\UserNotification;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class FCMNotification
{
    public static function SaveToken($userId, $token, $type){
        try{
//            Log::info("FCMNotification - SaveToken data = ".$userId.", type = ".$type.", token = ".$token);
            if($type == 'User'){
                $isExistToken = User::find($userId);
                if(!empty($isExistToken)){
                    $isExistToken->notif_token = $token;
                    $isExistToken->save();
                }
            }
            else{
                $isExistToken = CompanyAdmin::find($userId);
                if(!empty($isExistToken)){
                    $isExistToken->notif_token = $token;
                    $isExistToken->save();
                }
            }
//            Log::info("FCMNotification - SaveToken success, user = ".$userId.", type = ".$type.", token = ".$token);
            return "success";
        }
        catch (\Exception $exception){
//            dd($exception);
            Log::error("FCMNotification - SaveToken Error: ". $exception);
            return "failed";
        }
    }

    public static function SendNotification($type, $userId, $messageId, $notification, $notifData){
        try{
            if($type == 'User'){
                $user = User::find($userId);
            }
            else{
                $user = CompanyAdmin::find($userId);
            }
//            $user  = User::where('id', $userId)->first();

            $data = array(
                "to" => $user->notif_token,
                "message_id"    => $messageId,
                "notification"  => $notification,
//                "android"     => $androidNotif,
//                "apns"        => $IosNotif,
                "data"          => $notifData
            );
            $data_string = json_encode($data);
//            Log::error("FCMNotification - SendNotification data : ". $data_string);

            $client = new Client([
                'base_uri' => "https://fcm.googleapis.com/fcm/send",
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'key=' .env('FCM_SERVER_KEY'),
                ],
            ]);
//            Log::info("FCMNotification - SendNotification data: ". $data_string);
            $response = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
                'body' => $data_string
            ]);
            $responseJSON = json_decode($response->getBody());

            if($responseJSON->success == 1){
                return "success";
            }
            else{
                Log::error("FCMNotification - SendNotification result : ". $response->getBody());
                $stringReturn = "";
                foreach($responseJSON->results as $result){
                    $stringReturn .= $result->error;
                }
                return $stringReturn;
            }

        }
        catch (\Exception $exception){
//            dd($exception);
            Log::error("FCMNotification - SendNotification Error: ". $exception->getMessage());
            return "error ".$exception->getMessage();
        }
    }

    public static function SaveNotificationToDatabase($type, $userId, $description){
        try{
            //tambah history wallet
            UserNotification::create([
                'user_id'       => $userId,
                'notif_type'    => $type,
                'description'   => $description
            ]);

            return "Success Insert to database";

        }
        catch (\Exception $exception){
//            dd($exception);
            Log::error("FCMNotification - SaveNotificationToDatabase Error: ". $exception);
            return "error ".$exception;
        }
    }
}
