<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\FCMNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestingController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function testSaveUserToken(){
        return view('admin.notif-saveUserToken');
    }
    public function testNotifSaveUserToken(Request $request){

        try{
            $userDb = User::where('phone', $request->input('phone'))->first();

            //Save user deviceID
            $isSuccess = FCMNotification::SaveToken($userDb->id, $request->input('fcm_token'), "user");

            return $isSuccess;
        }
        catch (\Exception $exception){
            dd($exception);
            return $exception;
        }
    }

    public function testNotif(){
        return view('admin.notif-sendNotif');
    }
    public function testSendNotif(Request $request){

        try{
            $userDb = User::where('phone', $request->input('phone'))->first();
            if(empty($userDb)){
                return "User with number ". $request->input('phone') ."Not Found";
            }

            $temp = Carbon::now('Asia/Jakarta');
            $nowDay = $temp->day;

            //Send notification to
            $body = $request->input('message');
            $title = $request->input('title');
            $notification = array(
                "title" => $title,
                "body"  => $body,
                //for IOS notification
                "sound"  => "default",
                "mutable_content"  => true,
                "content_available" => true
            );
            $notifData = array(
                "type_id"   => $request->input('type'),
                "id"        => $nowDay,
                "message"   => $body,
            );
            //Push Notification to App.
            $messageId = "message-testing-".$nowDay.rand(0,999999);

//            Log::info("TestingController - testSendNotif Info : userId = ". $userDb->id. " | MessageId = ".$messageId. " | Title = ".$title." | body = ".$body);

            $isSuccess = FCMNotification::SendNotification('User', $userDb->id, $messageId, $notification, $notifData);

//            Log::error("TestingController - testSendNotif Result : ". $isSuccess->success);
            return "TestingController - testSendNotif Result : ". $isSuccess->success;
        }
        catch (\Exception $exception){
            dd($exception);
            return $exception;
        }
    }

}
