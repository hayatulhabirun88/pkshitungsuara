<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginMobileController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('mobile.dashboard');
        } else {
            return view('mobile.login');
        }
    }

    public function daftar()
    {
        return view('mobile.daftar');
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('mobile.login');
    }


}
