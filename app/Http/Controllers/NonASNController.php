<?php

namespace App\Http\Controllers;

use App\Models\NonASN;
use Illuminate\Http\Request;

class NonASNController extends Controller
{
    public function index()
    {
        $data = NonASN::paginate(10);
        return view('superadmin.nonasn.index', compact('data'));
    }
    public function create()
    {
        return view('superadmin.nonasn.create');
    }
}
