<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('kabupaten.kabupaten');
    }
}
