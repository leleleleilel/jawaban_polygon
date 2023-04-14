<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    function gotologin()
    {
        return view('pages.loginPage');
    }

    function login(Request $request)
    {
        $credentials = [
            "username"=>$request->username,
            "password"=>$request->password
        ];
        if(auth()->attempt($credentials)){
            return redirect('/dashboard');
        }
    }
    function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
