<?php

namespace Modules\AvnSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\File;
use Lang;

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

            'home_banner_title_en',
            'home_banner_description_en',
            'home_banner_link',
            'home_banner_image_en',
            'home_banner_title_vi',
            'home_banner_description_vi',
            'home_banner_link',
            'home_banner_image_vi',
            'home_banner_title_ja',
            'home_banner_description_ja',
            'home_banner_link',
            'home_banner_image_ja',

            'home_partner_title_ja',
            'home_partner_description_ja',
            'home_partner_image_ja',
            'home_partner_title_vi',
            'home_partner_description_vi',
            'home_partner_image_vi',
            'home_partner_title_en',
            'home_partner_description_en',
            'home_partner_image_en',

            'home_feature_icon_ja',
            'home_feature_img_ja',
            'home_feature_title_ja',
            'home_feature_des_ja',
            'home_feature_sub_title_ja',
            'home_feature_sub_des_ja',
            'home_feature_icon_vi',
            'home_feature_img_vi',
            'home_feature_title_vi',
            'home_feature_des_vi',
            'home_feature_sub_title_vi',
            'home_feature_sub_des_vi',
            'home_feature_icon_en',
            'home_feature_img_en',
            'home_feature_title_en',
            'home_feature_des_en',
            'home_feature_sub_title_en',
            'home_feature_sub_des_en',
            'home_feature_link',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $home_feature_list_items_en = GeneralSettings::where('key', 'like', 'home_feature_list_item_en_%')->get();
        $home_feature_list_items_vi = GeneralSettings::where('key', 'like', 'home_feature_list_item_vi_%')->get();
        $home_feature_list_items_ja = GeneralSettings::where('key', 'like', 'home_feature_list_item_ja_%')->get();
        return view('avnsetting::page.home-seo', compact('home_seo', 'home_feature_list_items_en', 'home_feature_list_items_vi', 'home_feature_list_items_ja'));
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
            $setting = GeneralSettings::where('key', 'home_partner_title_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_partner_title_ja';
            $setting->value = trim($request->home_partner_title_ja);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_partner_description_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_partner_description_ja';
            $setting->value = trim($request->home_partner_description_ja);
            $setting->save();
            if ($request->hasFile('home_partner_image_ja') && $request->file('home_partner_image_ja')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_partner_image_ja')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_partner_image_ja');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_partner_image_ja';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'home_partner_title_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_partner_title_vi';
            $setting->value = trim($request->home_partner_title_vi);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_partner_description_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_partner_description_vi';
            $setting->value = trim($request->home_partner_description_vi);
            $setting->save();
            if ($request->hasFile('home_partner_image_vi') && $request->file('home_partner_image_vi')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_partner_image_vi')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_partner_image_vi');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_partner_image_vi';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'home_partner_title_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_partner_title_en';
            $setting->value = trim($request->home_partner_title_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_partner_description_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_partner_description_en';
            $setting->value = trim($request->home_partner_description_en);
            $setting->save();
            if ($request->hasFile('home_partner_image_en') && $request->file('home_partner_image_en')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_partner_image_en')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_partner_image_en');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_partner_image_en';
                $setting->value = $path;
                $setting->save();
            }
            // banner
            $setting = GeneralSettings::where('key', 'home_banner_title_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_banner_title_ja';
            $setting->value = trim($request->home_banner_title_ja);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_banner_description_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_banner_description_ja';
            $setting->value = trim($request->home_banner_description_ja);
            $setting->save();
            if ($request->hasFile('home_banner_image_ja') && $request->file('home_banner_image_ja')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_banner_image_ja')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_banner_image_ja');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_banner_image_ja';
                $setting->value = $path;
                $setting->save();
            }

            $setting = GeneralSettings::where('key', 'home_banner_title_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_banner_title_vi';
            $setting->value = trim($request->home_banner_title_vi);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_banner_description_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_banner_description_vi';
            $setting->value = trim($request->home_banner_description_vi);
            $setting->save();
            if ($request->hasFile('home_banner_image_vi') && $request->file('home_banner_image_vi')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_banner_image_vi')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_banner_image_vi');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_banner_image_vi';
                $setting->value = $path;
                $setting->save();
            }

            $setting = GeneralSettings::where('key', 'home_banner_title_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_banner_title_en';
            $setting->value = trim($request->home_banner_title_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_banner_description_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_banner_description_en';
            $setting->value = trim($request->home_banner_description_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_banner_link')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_banner_link';
            $setting->value = trim($request->home_banner_link);
            $setting->save();
            if ($request->hasFile('home_banner_image_en') && $request->file('home_banner_image_en')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_banner_image_en')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_banner_image_en');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_banner_image_en';
                $setting->value = $path;
                $setting->save();
            }
            // feature
            if ($request->hasFile('home_feature_icon_ja') && $request->file('home_feature_icon_ja')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_feature_icon_ja')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_feature_icon_ja');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_feature_icon_ja';
                $setting->value = $path;
                $setting->save();
            }
            if ($request->hasFile('home_feature_img_ja') && $request->file('home_feature_img_ja')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_feature_img_ja')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_feature_img_ja');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_feature_img_ja';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'home_feature_title_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_title_ja';
            $setting->value = trim($request->home_feature_title_ja);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_des_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_des_ja';
            $setting->value = trim($request->home_feature_des_ja);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_sub_title_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_sub_title_ja';
            $setting->value = trim($request->home_feature_sub_title_ja);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_sub_des_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_sub_des_ja';
            $setting->value = trim($request->home_feature_sub_des_ja);
            $setting->save();
            if ($request->hasFile('home_feature_icon_vi') && $request->file('home_feature_icon_vi')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_feature_icon_vi')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_feature_icon_vi');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_feature_icon_vi';
                $setting->value = $path;
                $setting->save();
            }
            if ($request->hasFile('home_feature_img_vi') && $request->file('home_feature_img_vi')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_feature_img_vi')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_feature_img_vi');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_feature_img_vi';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'home_feature_title_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_title_vi';
            $setting->value = trim($request->home_feature_title_vi);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_des_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_des_vi';
            $setting->value = trim($request->home_feature_des_vi);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_sub_title_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_sub_title_vi';
            $setting->value = trim($request->home_feature_sub_title_vi);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_sub_des_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_sub_des_vi';
            $setting->value = trim($request->home_feature_sub_des_vi);
            $setting->save();
            if ($request->hasFile('home_feature_icon_en') && $request->file('home_feature_icon_en')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_feature_icon_en')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_feature_icon_en');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_feature_icon_en';
                $setting->value = $path;
                $setting->save();
            }
            if ($request->hasFile('home_feature_img_en') && $request->file('home_feature_img_en')->isValid()) {
                $setting = GeneralSettings::where('key', 'home_feature_img_en')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('home_feature_img_en');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'home_feature_img_en';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'home_feature_title_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_title_en';
            $setting->value = trim($request->home_feature_title_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_des_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_des_en';
            $setting->value = trim($request->home_feature_des_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_sub_title_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_sub_title_en';
            $setting->value = trim($request->home_feature_sub_title_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_sub_des_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_sub_des_en';
            $setting->value = trim($request->home_feature_sub_des_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'home_feature_link')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'home_feature_link';
            $setting->value = trim($request->home_feature_link);
            $setting->save();
            GeneralSettings::where('key', 'like', 'home_feature_list_item_en_%')->delete();
            GeneralSettings::where('key', 'like', 'home_feature_list_item_vi_%')->delete();
            GeneralSettings::where('key', 'like', 'home_feature_list_item_ja_%')->delete();
            if ($request->home_feature_list_items_en && count($request->home_feature_list_items_en) > 0) {
                foreach ($request->home_feature_list_items_en as $key => $value) {
                    if ($value) {
                        $setting = new GeneralSettings();
                        $setting->key = 'home_feature_list_item_en_' . $key;
                        $setting->value = trim($value);
                        $setting->save();
                    }
                }
            }
            if ($request->home_feature_list_items_vi && count($request->home_feature_list_items_vi) > 0) {
                foreach ($request->home_feature_list_items_vi as $key => $value) {
                    if ($value) {
                        $setting = new GeneralSettings();
                        $setting->key = 'home_feature_list_item_vi_' . $key;
                        $setting->value = trim($value);
                        $setting->save();
                    }
                }
            }
            if ($request->home_feature_list_items_ja && count($request->home_feature_list_items_ja) > 0) {
                foreach ($request->home_feature_list_items_ja as $key => $value) {
                    if ($value) {
                        $setting = new GeneralSettings();
                        $setting->key = 'home_feature_list_item_ja_' . $key;
                        $setting->value = trim($value);
                        $setting->save();
                    }
                }
            }
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
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
            'contact_page_title_en',
            'contact_page_description_en',
            'contact_page_icon_en',
            'contact_page_title_vi',
            'contact_page_description_vi',
            'contact_page_icon_vi',
            'contact_page_title_ja',
            'contact_page_description_ja',
            'contact_page_icon_ja',
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
            $setting = GeneralSettings::where('key', 'contact_page_title_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'contact_page_title_en';
            $setting->value = trim($request->contact_page_title_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'contact_page_description_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'contact_page_description_en';
            $setting->value = trim($request->contact_page_description_en);
            $setting->save();
            if ($request->hasFile('contact_page_icon_en') && $request->file('contact_page_icon_en')->isValid()) {
                $setting = GeneralSettings::where('key', 'contact_page_icon_en')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('contact_page_icon_en');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'contact_page_icon_en';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'contact_page_title_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'contact_page_title_vi';
            $setting->value = trim($request->contact_page_title_vi);
            $setting->save();
            $setting = GeneralSettings::where('key', 'contact_page_description_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'contact_page_description_vi';
            $setting->value = trim($request->contact_page_description_vi);
            $setting->save();
            if ($request->hasFile('contact_page_icon_vi') && $request->file('contact_page_icon_vi')->isValid()) {
                $setting = GeneralSettings::where('key', 'contact_page_icon_vi')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('contact_page_icon_vi');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'contact_page_icon_vi';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'contact_page_title_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'contact_page_title_ja';
            $setting->value = trim($request->contact_page_title_ja);
            $setting->save();
            $setting = GeneralSettings::where('key', 'contact_page_description_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'contact_page_description_ja';
            $setting->value = trim($request->contact_page_description_ja);
            $setting->save();
            if ($request->hasFile('contact_page_icon_ja') && $request->file('contact_page_icon_ja')->isValid()) {
                $setting = GeneralSettings::where('key', 'contact_page_icon_ja')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('contact_page_icon_ja');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'contact_page_icon_ja';
                $setting->value = $path;
                $setting->save();
            }
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
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
            'post_page_title_en',
            'post_page_description_en',
            'post_page_icon_en',
            'post_page_title_vi',
            'post_page_description_vi',
            'post_page_icon_vi',
            'post_page_title_ja',
            'post_page_description_ja',
            'post_page_icon_ja',
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
            $setting = GeneralSettings::where('key', 'post_page_title_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'post_page_title_en';
            $setting->value = trim($request->post_page_title_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'post_page_description_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'post_page_description_en';
            $setting->value = trim($request->post_page_description_en);
            $setting->save();
            if ($request->hasFile('post_page_icon_en') && $request->file('post_page_icon_en')->isValid()) {
                $setting = GeneralSettings::where('key', 'post_page_icon_en')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('post_page_icon_en');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'post_page_icon_en';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'post_page_title_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'post_page_title_vi';
            $setting->value = trim($request->post_page_title_vi);
            $setting->save();
            $setting = GeneralSettings::where('key', 'post_page_description_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'post_page_description_vi';
            $setting->value = trim($request->post_page_description_vi);
            $setting->save();
            if ($request->hasFile('post_page_icon_vi') && $request->file('post_page_icon_vi')->isValid()) {
                $setting = GeneralSettings::where('key', 'post_page_icon_vi')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('post_page_icon_vi');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'post_page_icon_vi';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'post_page_title_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'post_page_title_ja';
            $setting->value = trim($request->post_page_title_ja);
            $setting->save();
            $setting = GeneralSettings::where('key', 'post_page_description_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'post_page_description_ja';
            $setting->value = trim($request->post_page_description_ja);
            $setting->save();
            if ($request->hasFile('post_page_icon_ja') && $request->file('post_page_icon_ja')->isValid()) {
                $setting = GeneralSettings::where('key', 'post_page_icon_ja')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('post_page_icon_ja');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'post_page_icon_ja';
                $setting->value = $path;
                $setting->save();
            }
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    public function orderChatSeo()
    {
        $order_chat_seo = GeneralSettings::whereIn('key', [
            'order_chat_seo_title',
            'order_chat_seo_description',
            'order_chat_seo_keywords',
            'order_chat_seo_image',
            'order_chat_page_title_en',
            'order_chat_page_description_en',
            'order_chat_page_icon_en',
            'order_chat_page_title_vi',
            'order_chat_page_description_vi',
            'order_chat_page_icon_vi',
            'order_chat_page_title_ja',
            'order_chat_page_description_ja',
            'order_chat_page_icon_ja',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avnsetting::page.order-chat-seo', compact('order_chat_seo'));
    }

    public function updateOrderChatSeo(Request $request)
    {
        try {
            $setting = GeneralSettings::where('key', 'order_chat_seo_title')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'order_chat_seo_title';
            $setting->value = trim($request->order_chat_seo_title);
            $setting->save();
            $setting = GeneralSettings::where('key', 'order_chat_seo_description')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'order_chat_seo_description';
            $setting->value = trim($request->order_chat_seo_description);
            $setting->save();
            $setting = GeneralSettings::where('key', 'order_chat_seo_keywords')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'order_chat_seo_keywords';
            $setting->value = trim($request->order_chat_seo_keywords);
            $setting->save();
            if ($request->hasFile('order_chat_seo_image') && $request->file('order_chat_seo_image')->isValid()) {
                $setting = GeneralSettings::where('key', 'order_chat_seo_image')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('order_chat_seo_image');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'order_chat_seo_image';
                $setting->value = $path;
                $setting->save();
            }
            // header
            $setting = GeneralSettings::where('key', 'order_chat_page_title_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'order_chat_page_title_en';
            $setting->value = trim($request->order_chat_page_title_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'order_chat_page_description_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'order_chat_page_description_en';
            $setting->value = trim($request->order_chat_page_description_en);
            $setting->save();
            if ($request->hasFile('order_chat_page_icon_en') && $request->file('order_chat_page_icon_en')->isValid()) {
                $setting = GeneralSettings::where('key', 'order_chat_page_icon_en')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('order_chat_page_icon_en');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'order_chat_page_icon_en';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'order_chat_page_title_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'order_chat_page_title_vi';
            $setting->value = trim($request->order_chat_page_title_vi);
            $setting->save();
            $setting = GeneralSettings::where('key', 'order_chat_page_description_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'order_chat_page_description_vi';
            $setting->value = trim($request->order_chat_page_description_vi);
            $setting->save();
            if ($request->hasFile('order_chat_page_icon_vi') && $request->file('order_chat_page_icon_vi')->isValid()) {
                $setting = GeneralSettings::where('key', 'order_chat_page_icon_vi')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('order_chat_page_icon_vi');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'order_chat_page_icon_vi';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'order_chat_page_title_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'order_chat_page_title_ja';
            $setting->value = trim($request->order_chat_page_title_ja);
            $setting->save();
            $setting = GeneralSettings::where('key', 'order_chat_page_description_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'order_chat_page_description_ja';
            $setting->value = trim($request->order_chat_page_description_ja);
            $setting->save();
            if ($request->hasFile('order_chat_page_icon_ja') && $request->file('order_chat_page_icon_ja')->isValid()) {
                $setting = GeneralSettings::where('key', 'order_chat_page_icon_ja')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('order_chat_page_icon_ja');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'order_chat_page_icon_ja';
                $setting->value = $path;
                $setting->save();
            }
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }
}