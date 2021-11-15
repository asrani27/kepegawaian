<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KepangkatanController extends Controller
{
    public function index()
    {
        return view('skpd.kepangkatan.index');
    }
    
    public function k_index()
    {
        return view('kepangkatan.pangkat.index');
    }
}
