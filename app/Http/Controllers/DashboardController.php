<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }

    public function user(Request $request)
    {
        return view('user.welcome');
    }
}
