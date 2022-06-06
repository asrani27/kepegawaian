<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KHukumanDisiplinController extends Controller
{
    public function index()
    {
        toastr()->error('ON PROGRESS, MENUNGGU FITUR PEGAWAI SELESAI');
        return back();
    }
}
