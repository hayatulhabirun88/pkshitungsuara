<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaksiController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('saksi.saksi');
    }
}
