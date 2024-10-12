<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeMobileController extends Controller
{
    public function index()
    {
        return view('mobile.dashboard');
    }

    public function input_suara()
    {
        return view('mobile.input_suara');
    }
}
