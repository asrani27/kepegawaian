<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\M_skpd;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    public function index()
    {
        $data = M_skpd::get();
        return response()->json($data);
    }
}
