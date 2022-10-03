<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm(){
        return view('admin.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email'  => 'required|email',
            'password' => 'required'
        ]);
//        dd($request, $request->email, $request->password);

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return Redirect::route('admin.dashboard');
        }
        else{
            return redirect()->back()->withErrors('Wrong Email or Password!!', 'default')->withInput($request->only('email'));
        }
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();

        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }
}
