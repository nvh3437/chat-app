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
            'home_seo_image',

            'home_banner_title',
            'home_banner_description',
            'home_banner_link',
            'home_banner_image',

            'home_partner_title',
            'home_partner_description',
            'home_partner_image',

            'home_feature_icon',
            'home_feature_img',
            'home_feature_title',
            'home_feature_des',
            'home_feature_sub_title',
            'home_feature_sub_des',
            'home_feature_link',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $home_feature_list_items = GeneralSettings::where('key', 'like', 'home_feature_list_item_%')->get();
        return view('avnsetting::page.home-seo', compact('home_seo', 'home_feature_list_items'));
    }

    public function updateHomeSeo(Request $request)
    {
        try {
            $setting = GeneralSettings::where('key', 'home_seo_title')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_seo_title';
            $setting->value = trim($request->home_seo_title);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_seo_description')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_seo_description';
            $setting->value = trim($request->home_seo_description);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_seo_keywords')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_seo_keywords';
            $setting->value = trim($request->home_seo_keywords);
            $setting->save();
            if ($request->hasFile('home_seo_image') && $request->file('home_seo_image')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_seo_image')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_seo_image');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_seo_image';
                $setting->value = $path;
                $setting->save();
            }
            // partner
            $setting = GeneralSettings::where('key', 'home_partner_title')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_partner_title';
            $setting->value = trim($request->home_partner_title);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_partner_description')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_partner_description';
            $setting->value = trim($request->home_partner_description);
            $setting->save();
            if ($request->hasFile('home_partner_image') && $request->file('home_partner_image')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_partner_image')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_partner_image');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_partner_image';
                $setting->value = $path;
                $setting->save();
            }
            // banner
            $setting = GeneralSettings::where('key', 'home_banner_title')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_banner_title';
            $setting->value = trim($request->home_banner_title);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_banner_description')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_banner_description';
            $setting->value = trim($request->home_banner_description);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_banner_link')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_banner_link';
            $setting->value = trim($request->home_banner_link);
            $setting->save();
            if ($request->hasFile('home_banner_image') && $request->file('home_banner_image')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_banner_image')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_banner_image');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_banner_image';
                $setting->value = $path;
                $setting->save();
            }
            // feature
            if ($request->hasFile('home_feature_icon') && $request->file('home_feature_icon')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_feature_icon')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_feature_icon');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_feature_icon';
                $setting->value = $path;
                $setting->save();
            }
            if ($request->hasFile('home_feature_img') && $request->file('home_feature_img')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_feature_img')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_feature_img');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_feature_img';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'home_feature_title')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_title';
            $setting->value = trim($request->home_feature_title);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_des')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_des';
            $setting->value = trim($request->home_feature_des);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_sub_title')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_sub_title';
            $setting->value = trim($request->home_feature_sub_title);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_sub_des')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_sub_des';
            $setting->value = trim($request->home_feature_sub_des);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_link')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_link';
            $setting->value = trim($request->home_feature_link);
            $setting->save();
            GeneralSettings::where('key', 'like', 'home_feature_list_item_%')->delete();
            if ($request->home_feature_list_items && count($request->home_feature_list_items) > 0) {
                foreach ($request->home_feature_list_items as $key => $value) {
                    if ($value) {
                        $setting = new GeneralSettings();
                        $setting->key = 'home_feature_list_item_' . $key;
                        $setting->value = trim($value);
                        $setting->save();
                    }
                }
            }
            return back()->with('Success', 'Cập nhập thành công');
        } catch (Exception $e) {
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
            'contact_seo_image',
            'contact_page_title',
            'contact_page_description',
            'contact_page_icon'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avnsetting::page.contact-seo', compact('contact_seo'));
    }

    public function updateContactSeo(Request $request)
    {
        try {
            $setting = GeneralSettings::where('key', 'contact_seo_title')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'contact_seo_title';
            $setting->value = trim($request->contact_seo_title);
            $setting->save();
            $setting = GeneralSettings::where('key', 'contact_seo_description')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'contact_seo_description';
            $setting->value = trim($request->contact_seo_description);
            $setting->save();
            $setting = GeneralSettings::where('key', 'contact_seo_keywords')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'contact_seo_keywords';
            $setting->value = trim($request->contact_seo_keywords);
            $setting->save();
            if ($request->hasFile('contact_seo_image') && $request->file('contact_seo_image')->isValid()) {
                $setting = GeneralSettings::where('key', 'contact_seo_image')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('contact_seo_image');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'contact_seo_image';
                $setting->value = $path;
                $setting->save();
            }
            // header
            $setting = GeneralSettings::where('key', 'contact_page_title')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'contact_page_title';
            $setting->value = trim($request->contact_page_title);
            $setting->save();
            $setting = GeneralSettings::where('key', 'contact_page_description')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'contact_page_description';
            $setting->value = trim($request->contact_page_description);
            $setting->save();
            if ($request->hasFile('contact_page_icon') && $request->file('contact_page_icon')->isValid()) {
                $setting = GeneralSettings::where('key', 'contact_page_icon')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('contact_page_icon');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'contact_page_icon';
                $setting->value = $path;
                $setting->save();
            }
            return back()->with('Success', 'Cập nhập thành công');
        } catch (Exception $e) {
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
            'post_seo_image',
            'post_page_title',
            'post_page_description',
            'post_page_icon'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avnsetting::page.post-seo', compact('post_seo'));
    }

    public function updatePostSeo(Request $request)
    {
        try {
            $setting = GeneralSettings::where('key', 'post_seo_title')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'post_seo_title';
            $setting->value = trim($request->post_seo_title);
            $setting->save();
            $setting = GeneralSettings::where('key', 'post_seo_description')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'post_seo_description';
            $setting->value = trim($request->post_seo_description);
            $setting->save();
            $setting = GeneralSettings::where('key', 'post_seo_keywords')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'post_seo_keywords';
            $setting->value = trim($request->post_seo_keywords);
            $setting->save();
            if ($request->hasFile('post_seo_image') && $request->file('post_seo_image')->isValid()) {
                $setting = GeneralSettings::where('key', 'post_seo_image')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('post_seo_image');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'post_seo_image';
                $setting->value = $path;
                $setting->save();
            }
            // header
            $setting = GeneralSettings::where('key', 'post_page_title')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'post_page_title';
            $setting->value = trim($request->post_page_title);
            $setting->save();
            $setting = GeneralSettings::where('key', 'post_page_description')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'post_page_description';
            $setting->value = trim($request->post_page_description);
            $setting->save();
            if ($request->hasFile('post_page_icon') && $request->file('post_page_icon')->isValid()) {
                $setting = GeneralSettings::where('key', 'post_page_icon')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('post_page_icon');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'post_page_icon';
                $setting->value = $path;
                $setting->save();
            }
            return back()->with('Success', 'Cập nhập thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhập thất bại');
        }
    }
}