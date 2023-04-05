<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function dbWeek(){
        return view('dashboard.dashboard-week');
    }
}