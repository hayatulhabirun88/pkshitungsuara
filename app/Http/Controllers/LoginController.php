<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }



}
