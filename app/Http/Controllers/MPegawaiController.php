<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MPegawaiController extends Controller
{
    public function index()
    {
        toastr()->info('Sedang Di Kerjakan');
        return back();
    }
}
