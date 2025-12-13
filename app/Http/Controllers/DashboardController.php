<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index');
    }

    public function user(Request $request)
    {
        return view('petani.index');
    }
}
