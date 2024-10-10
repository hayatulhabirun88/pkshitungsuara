<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuaraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function perhitungan_suara()
    {
        return view('suara.perhitungan_suara');
    }

    public function input_suara()
    {
        return view('suara.input_suara');
    }
}
