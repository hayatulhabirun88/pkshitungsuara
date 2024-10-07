<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TpsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('tps.tps');
    }

    public function list_tps()
    {
        return view('tps.list');
    }
}
