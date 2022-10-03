<?php

namespace App\Http\Controllers;

use App\Libs\AesEncryption;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CompanyAdmin;
use Illuminate\Support\Facades\Log;
use phpseclib3\Crypt\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function userLogin(Request $request)
    {
        $data = $request->json()->all();

        $validator = Validator::make($data, [
            'phone'     => 'required',
            'password'  => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        //decrypt data
        $encryptor = new AesEncryption();
        $phone = $encryptor->decrypt($data['phone']);
        $password = $encryptor->decrypt($data['password']);

        if(auth()->guard('user')->attempt(['phone' => $phone, 'password' => $password])){

            config(['auth.guards.api.provider' => 'user']);

            $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
            $success =  $user;
            $success['token'] =  $user->createToken('OSL Personal Access Client',['user'])->accessToken;

            $data = [
                'name'      => $user->name,
                'email'     => $encryptor->encrypt($user->email),
                'phone'     => $encryptor->encrypt($user->phone),
                'status'    => $user->status->description,
                'token'     => $success['token']
            ];

            return response()->json($data, 200);
        }else{
            return response()->json(['error' => ['Nomor Ponsel atau Kata Sandi Anda salah.']], 401);
        }
    }

    public function adminLogin(Request $request)
    {
        $data = $request->json()->all();

        $validator = Validator::make($data, [
            'phone'     => 'required',
            'password'  => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

//        $test = auth()->guard('company_admin')->attempt(['phone' => $data['phone'], 'password' => $data['password']]);
//        Log::error('Api/LoginController - adminLogin phone : '. $data['phone']. ' | pass = '.$data['password']);
//        Log::error('Api/LoginController - adminLogin test : '. json_encode($test));
        if(auth()->guard('company_admin')->attempt(['phone' => $data['phone'], 'password' => $data['password']])){

            config(['auth.guards.api.provider' => 'company_admin']);

            $admin = CompanyAdmin::select('company_admins.*')->find(auth()->guard('company_admin')->user()->id);
            $success =  $admin;
            $success['token'] =  $admin->createToken('OSL Personal Access Client',['company_admin'])->accessToken;

            $data = [
                'id'        => $admin->id,
                'name'      => $admin->name,
                'email'     => $admin->email,
                'phone'     => $admin->phone,
                'status'    => $admin->status->description,
                'token'     => $success['token']
            ];

            return response()->json($data, 200);
        }else{
            return response()->json(['error' => ['Nomor Ponsel atau Kata Sandi Anda salah.']], 401);
        }
    }
}
