<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //p
    public function index(){
        return view('dashboards.index');
    }
}
