<?php

namespace Modules\AvnSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnSetting\Entities\Footer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\GeneralSettings;
use Lang;

class FooterController extends Controller
{
    //------------------------------------ Trang chủ -------------------//
    public static function getFooter()
    {
        $footer = Footer::where('parent_id', 0)->get();
        return $footer;
    }

    public static function getFooterSocial()
    {
        return GeneralSettings::whereIn('key', [
            'social_facebook',
            'social_google',
            'social_instagram',
            'social_youtube',
            'social_twitter',
            'social_linkedin',
            'social_whatsapp',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
    }

    //------------------------------------ Quản lý -----------------------//
    public function footer()
    {
        $footer = Footer::get();
        $footer_description = GeneralSettings::whereIn('key', [
            'footer_description_ja',
            'footer_description_vi',
            'footer_description_en',
            'social_facebook',
            'social_google',
            'social_instagram',
            'social_youtube',
            'social_twitter',
            'social_linkedin',
            'social_whatsapp',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avnsetting::footer.footer', compact('footer', 'footer_description'));
    }

    public function updateFooterDes(Request $request)
    {
        try {
            $setting = GeneralSettings::where('key', 'footer_description_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'footer_description_ja';
            $setting->value = trim($request->footer_description_ja);
            $setting->save();
            $setting = GeneralSettings::where('key', 'footer_description_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'footer_description_vi';
            $setting->value = trim($request->footer_description_vi);
            $setting->save();
            $setting = GeneralSettings::where('key', 'footer_description_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'footer_description_en';
            $setting->value = trim($request->footer_description_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'social_facebook')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'social_facebook';
            $setting->value = trim($request->social_facebook);
            $setting->save();
            $setting = GeneralSettings::where('key', 'social_google')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'social_google';
            $setting->value = trim($request->social_google);
            $setting->save();
            $setting = GeneralSettings::where('key', 'social_instagram')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'social_instagram';
            $setting->value = trim($request->social_instagram);
            $setting->save();
            $setting = GeneralSettings::where('key', 'social_youtube')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'social_youtube';
            $setting->value = trim($request->social_youtube);
            $setting->save();
            $setting = GeneralSettings::where('key', 'social_twitter')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'social_twitter';
            $setting->value = trim($request->social_twitter);
            $setting->save();
            $setting = GeneralSettings::where('key', 'social_linkedin')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'social_linkedin';
            $setting->value = trim($request->social_linkedin);
            $setting->save();
            $setting = GeneralSettings::where('key', 'social_whatsapp')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'social_whatsapp';
            $setting->value = trim($request->social_whatsapp);
            $setting->save();
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    //------------------------------ Thông tin cơ bản -------------------------------//
    public function storeFooter(Request $request)
    {
        try {
            $footer = new Footer();
            $footer->name = $request->name;
            if ($request->multi_lang) {
                $footer->ja = $request->group_name[0];
                $footer->vi = $request->group_name[1];
                $footer->en = $request->group_name[2];
            }
            $footer->link = $request->link;
            $footer->parent_id = $request->parent_id;
            $footer->save();
            return back()->with('Success', Lang::get('settings.Add.Add_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Add.Add_failed'));
        }
    }

    public function updateFooter(Request $request, $id)
    {
        try {
            $footer = Footer::findOrFail($id);
            $footer->name = $request->name;
            if ($request->multi_lang) {
                $footer->ja = $request->group_name[0];
                $footer->vi = $request->group_name[1];
                $footer->en = $request->group_name[2];
            } else {
                $footer->ja = null;
                $footer->vi = null;
                $footer->en = null;
            }
            $footer->link = $request->link;
            $footer->parent_id = $request->parent_id;
            $footer->save();
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    public function deleteFooter($id)
    {
        try {
            $footer = Footer::findOrFail($id);
            foreach ($footer->childrens as $children) {
                $children->parent_id = 0;
            }
            $footer->delete();
            return back()->with('Success', Lang::get('settings.Delete.Delete_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Delete.Delete_failed'));
        }
    }
}