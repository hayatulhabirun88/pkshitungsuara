<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaturanController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengaturan.pengaturan');
    }
}
