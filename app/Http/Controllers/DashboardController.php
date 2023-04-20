<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use App\Models\GeneralSettings;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $home_seo = GeneralSettings::whereIn('key', [
            'home_seo_title',
            'home_seo_description',
            'home_seo_keywords',
            'home_seo_image',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $banner = GeneralSettings::whereIn('key', [
            'home_banner_title',
            'home_banner_description',
            'home_banner_link',
            'home_banner_image',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $feature = GeneralSettings::whereIn('key', [
            'home_feature_icon',
            'home_feature_img',
            'home_feature_title',
            'home_feature_des',
            'home_feature_sub_title',
            'home_feature_sub_des',
            'home_feature_link',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $feature_list_items = GeneralSettings::where('key', 'like', 'home_feature_list_item_%')->get();
        $post_header = GeneralSettings::whereIn('key', [
            'post_page_title',
            'post_page_description',
            'post_page_icon'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $service_header = GeneralSettings::whereIn('key', [
            'service_page_title',
            'service_page_description',
            'service_page_icon'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $contact_header = GeneralSettings::whereIn('key', [
            'contact_page_title',
            'contact_page_description',
            'contact_page_icon'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $company_info = GeneralSettings::whereIn('key', [
            'address',
            'phone_number',
            'email',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('dashboard.dashboard', compact('home_seo', 'banner', 'feature', 'feature_list_items', 'post_header', 'service_header', 'contact_header', 'company_info'));
    }

    public function dbManager()
    {
        return view('dashboard.dashboard-manager');
    }
}