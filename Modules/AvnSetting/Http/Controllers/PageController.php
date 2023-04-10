<?php

namespace Modules\AvnSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    //------------------------------- Trang chủ -----------------------------//
    public function homeSeo()
    {
        $home_seo = GeneralSettings::whereIn('key', [
            'home_seo_title',
            'home_seo_description',
            'home_seo_keywords',
            'home_seo_link',
            'home_seo_image'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avnsetting::page.home-seo', compact('home_seo'));
    }

    public function updateHomeSeo(Request $request)
    {
        try {
            if ($request->home_seo_title) {
                $setting = GeneralSettings::where('key', 'home_seo_title')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'home_seo_title';
                $setting->value = trim($request->home_seo_title);
                $setting->save();
            }
            if ($request->home_seo_description) {
                $setting = GeneralSettings::where('key', 'home_seo_description')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'home_seo_description';
                $setting->value = trim($request->home_seo_description);
                $setting->save();
            }
            if ($request->home_seo_keywords) {
                $setting = GeneralSettings::where('key', 'home_seo_keywords')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'home_seo_keywords';
                $setting->value = trim($request->home_seo_keywords);
                $setting->save();
            }
            if ($request->home_seo_link) {
                $setting = GeneralSettings::where('key', 'home_seo_link')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'home_seo_link';
                $setting->value = trim($request->home_seo_link);
                $setting->save();
            }
            if ($request->hasFile('home_seo_image') && $request->file('home_seo_image')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_seo_image')->first() ?? new GeneralSettings();
                $image = $request->file('home_seo_image');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999). '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_seo_image';
                $setting->value = $path;
                $setting->save();
            }
            return back()->with('Success', 'Cập nhập thành công');
        } catch (\Exception $e) {
            return back()->with('Failed', 'Cập nhập thất bại');
        }
    }
    //------------------------------- Trang liên hệ -----------------------------//
    public function contactSeo()
    {
        $contact_seo = GeneralSettings::whereIn('key', [
            'contact_seo_title',
            'contact_seo_description',
            'contact_seo_keywords',
            'contact_seo_image'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avnsetting::page.contact-seo', compact('contact_seo'));
    }

    public function updateContactSeo(Request $request)
    {
        try {
            if ($request->contact_seo_title) {
                $setting = GeneralSettings::where('key', 'contact_seo_title')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'contact_seo_title';
                $setting->value = trim($request->contact_seo_title);
                $setting->save();
            }
            if ($request->contact_seo_description) {
                $setting = GeneralSettings::where('key', 'contact_seo_description')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'contact_seo_description';
                $setting->value = trim($request->contact_seo_description);
                $setting->save();
            }
            if ($request->contact_seo_keywords) {
                $setting = GeneralSettings::where('key', 'contact_seo_keywords')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'contact_seo_keywords';
                $setting->value = trim($request->contact_seo_keywords);
                $setting->save();
            }
            if ($request->hasFile('contact_seo_image') && $request->file('contact_seo_image')->isValid()) {
                $setting = GeneralSettings::where('key', 'contact_seo_image')->first() ?? new GeneralSettings();
                $image = $request->file('contact_seo_image');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999). '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'contact_seo_image';
                $setting->value = $path;
                $setting->save();
            }
            return back()->with('Success', 'Cập nhập thành công');
        } catch (\Exception $e) {
            return back()->with('Failed', 'Cập nhập thất bại');
        }
    }

    //------------------------------- Trang dịch vụ -----------------------------//
    public function serviceSeo()
    {
        $service_seo = GeneralSettings::whereIn('key', [
            'service_seo_title',
            'service_seo_description',
            'service_seo_keywords',
            'service_seo_image'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avnsetting::page.service-seo', compact('service_seo'));
    }

    public function updateServiceSeo(Request $request)
    {
        try {
            if ($request->service_seo_title) {
                $setting = GeneralSettings::where('key', 'service_seo_title')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'service_seo_title';
                $setting->value = trim($request->service_seo_title);
                $setting->save();
            }
            if ($request->service_seo_description) {
                $setting = GeneralSettings::where('key', 'service_seo_description')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'service_seo_description';
                $setting->value = trim($request->service_seo_description);
                $setting->save();
            }
            if ($request->service_seo_keywords) {
                $setting = GeneralSettings::where('key', 'service_seo_keywords')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'service_seo_keywords';
                $setting->value = trim($request->service_seo_keywords);
                $setting->save();
            }
            if ($request->hasFile('service_seo_image') && $request->file('service_seo_image')->isValid()) {
                $setting = GeneralSettings::where('key', 'service_seo_image')->first() ?? new GeneralSettings();
                $image = $request->file('service_seo_image');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999). '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'service_seo_image';
                $setting->value = $path;
                $setting->save();
            }
            return back()->with('Success', 'Cập nhập thành công');
        } catch (\Exception $e) {
            return back()->with('Failed', 'Cập nhập thất bại');
        }
    }

    //------------------------------- Trang bài viết -----------------------------//
    public function postSeo()
    {
        $post_seo = GeneralSettings::whereIn('key', [
            'post_seo_title',
            'post_seo_description',
            'post_seo_keywords',
            'post_seo_image'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avnsetting::page.post-seo', compact('post_seo'));
    }

    public function updatePostSeo(Request $request)
    {
        try {
            if ($request->post_seo_title) {
                $setting = GeneralSettings::where('key', 'post_seo_title')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'post_seo_title';
                $setting->value = trim($request->post_seo_title);
                $setting->save();
            }
            if ($request->post_seo_description) {
                $setting = GeneralSettings::where('key', 'post_seo_description')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'post_seo_description';
                $setting->value = trim($request->post_seo_description);
                $setting->save();
            }
            if ($request->post_seo_keywords) {
                $setting = GeneralSettings::where('key', 'post_seo_keywords')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'post_seo_keywords';
                $setting->value = trim($request->post_seo_keywords);
                $setting->save();
            }
            if ($request->hasFile('post_seo_image') && $request->file('post_seo_image')->isValid()) {
                $setting = GeneralSettings::where('key', 'post_seo_image')->first() ?? new GeneralSettings();
                $image = $request->file('post_seo_image');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999). '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'post_seo_image';
                $setting->value = $path;
                $setting->save();
            }
            return back()->with('Success', 'Cập nhập thành công');
        } catch (\Exception $e) {
            return back()->with('Failed', 'Cập nhập thất bại');
        }
    }
}
