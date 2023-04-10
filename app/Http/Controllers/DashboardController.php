<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use App\Models\GeneralSettings;

class DashboardController extends Controller
{
    public function dashboard(){
        $home_seo = GeneralSettings::whereIn('key', [
            'contact_seo_title',
            'contact_seo_description',
            'contact_seo_keywords',
            'contact_seo_image',
            'service_seo_title',
            'service_seo_description',
            'service_seo_keywords',
            'service_seo_image',
            'post_seo_title',
            'post_seo_description',
            'post_seo_keywords',
            'post_seo_image',
            'address',
            'phone_number',
            'email',
            'time_morning',
            'time_afternoon',
            'home_seo_title',
            'home_seo_description',
            'home_seo_keywords',
            'home_seo_link',
            'home_seo_image'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('dashboard.dashboard', compact('home_seo'));
    }

    public function dbManager(){
        return view('dashboard.dashboard-manager');
    }
}