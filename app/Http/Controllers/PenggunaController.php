<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengguna.pengguna');
    }
}
