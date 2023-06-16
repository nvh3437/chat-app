<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\GeneralSettings;
use App\Http\Requests\UpdateGeneralSettingsRequest;
use Lang;

class GeneralSettingsController extends Controller
{
    public function index()
    {
        $settings = GeneralSettings::whereIn('key', [
            'company_mission',
            'company_goals',
            'logo',
            'favicon',
            'admin_background',
            'login_background_img',
            'login_background_text',
            'company_name',
            'web_title',
            'time_morning',
            'time_afternoon',
            'address',
            'phone_number',
            'email',
            'work_calendar',
            'time_morning',
            'time_afternoon',
            'basic_salary',
            'startup_date',
            'social_facebook',
            'social_google',
            'social_instagram',
            'social_youtube',
            'social_twitter',
            'social_linkedin',
            'social_whatsapp',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $isNotBlock = RoleController::isNotBlock(route_names: ['general-settings']);
        return view('general-settings', compact('settings', 'isNotBlock'));
    }

    public function updateImage(Request $request)
    {
        try {
            if ($request->logo) {
                $setting = GeneralSettings::where('key', 'logo')->first();
                if ($setting->value) {
                    Storage::delete('AvnGeneralSettings/' . $setting->logo);
                }
                $file_img_logo = $request->file('logo');
                if ($file_img_logo) {
                    Storage::putFileAs('AvnGeneralSettings', $file_img_logo, time() . '-t-' . $file_img_logo->getClientOriginalName());
                    $setting->value = time() . '-t-' . $file_img_logo->getClientOriginalName();
                } else {
                    $setting->value = '';
                }
                $setting->save();
            }
            if ($request->favicon) {
                $setting = GeneralSettings::where('key', 'favicon')->first();
                if ($setting->value) {
                    Storage::delete('AvnGeneralSettings/' . $setting->favicon);
                }
                $file_img_favicon = $request->file('favicon');
                if ($file_img_favicon) {
                    Storage::putFileAs('AvnGeneralSettings', $file_img_favicon, time() . '-t-' . $file_img_favicon->getClientOriginalName());
                    $setting->value = time() . '-t-' . $file_img_favicon->getClientOriginalName();
                } else {
                    $setting->value = '';
                }
                $setting->save();
            }
            if ($request->admin_background) {
                $setting = GeneralSettings::where('key', 'admin_background')->first();
                if ($setting->value) {
                    Storage::delete('AvnGeneralSettings/' . $setting->admin_background);
                }
                $file_img_admin_background = $request->file('admin_background');
                if ($file_img_admin_background) {
                    Storage::putFileAs('AvnGeneralSettings', $file_img_admin_background, time() . '-t-' . $file_img_admin_background->getClientOriginalName());
                    $setting->value = time() . '-t-' . $file_img_admin_background->getClientOriginalName();
                } else {
                    $setting->value = '';
                }
                $setting->save();
            }
            if ($request->login_background_img) {
                $setting = GeneralSettings::where('key', 'login_background_img')->first();
                if ($setting->value) {
                    Storage::delete('AvnGeneralSettings/' . $setting->login_background_img);
                }
                $file_login_background_img = $request->file('login_background_img');
                if ($file_login_background_img) {
                    Storage::putFileAs('AvnGeneralSettings', $file_login_background_img, time() . '-t-' . $file_login_background_img->getClientOriginalName());
                    $setting->value = time() . '-t-' . $file_login_background_img->getClientOriginalName();
                } else {
                    $setting->value = '';
                }
                $setting->save();
            }
            if ($request->login_background_text) {
                $setting = GeneralSettings::where('key', 'login_background_text')->first();
                $setting->value = $request->login_background_text;
                $setting->save();
            }

            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    // public function edit()
    // {
    //     $settings = GeneralSettings::whereIn('key', [
    //         'company_mission',
    //         'company_goals',
    //         'startup_date',
    //         'logo',
    //         'favicon',
    //         'admin_background',
    //         'login_background_img',
    //         'login_background_text',
    //         'company_name',
    //         'web_title',
    //         'work_calendar',
    //         'time_morning',
    //         'time_afternoon',
    //         'basic_salary',
    //         'address',
    //         'phone_number',
    //         'email',
    //         'type_a',
    //         'type_b',
    //         'type_c',
    //         'type_d'
    //     ])->select('key', 'value')->get()->keyBy('key')->toArray();
    //     return view('general-settings-edit', compact('settings'));
    // }

    public function update(Request $request)
    {
        try {
            if ($request->work_calendar_type == 0 && $request->work_calendar_value_date != null) {
                $setting = GeneralSettings::where('key', 'work_calendar')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'work_calendar';
                $work_calendar = $request->work_calendar_type . ', ' . implode(' - ', $request->work_calendar_value_date);
                $setting->value = $work_calendar;
                $setting->save();
            } elseif ($request->work_calendar_type == 1 && $request->work_calendar_value_num != null) {
                $setting = GeneralSettings::where('key', 'work_calendar')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'work_calendar';
                $work_calendar = $request->work_calendar_type . ', ' . $request->work_calendar_value_num;
                $setting->value = $work_calendar;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'company_goals')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'company_goals';
            $setting->value = trim($request->company_goals);
            $setting->save();
            $setting = GeneralSettings::where('key', 'company_mission')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'company_mission';
            $setting->value = trim($request->company_mission);
            $setting->save();
            $setting = GeneralSettings::where('key', 'startup_date')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'startup_date';
            $setting->value = date('Y-m-d', strtotime($request->startup_date));
            $setting->save();
            $setting = GeneralSettings::where('key', 'company_name')->first();
            $setting->value = $request->company_name;
            $setting->save();
            $setting = GeneralSettings::where('key', 'web_title')->first();
            $setting->value = $request->web_title;
            $setting->save();
            if (isset($request->time_morning[0]) && isset($request->time_morning[0])) {
                $setting = GeneralSettings::where('key', 'time_morning')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'time_morning';
                $setting->value = implode(', ', $request->time_morning);
                $setting->save();
            }
            if (isset($request->time_afternoon[0]) && isset($request->time_afternoon[0])) {
                $setting = GeneralSettings::where('key', 'time_afternoon')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'time_afternoon';
                $setting->value = implode(', ', $request->time_afternoon);
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'address')->first();
            $setting->value = $request->address;
            $setting->save();
            $setting = GeneralSettings::where('key', 'phone_number')->first();
            $setting->value = $request->phone_number;
            $setting->save();
            $setting = GeneralSettings::where('key', 'email')->first();
            $setting->value = $request->email;
            $setting->save();
            $setting = GeneralSettings::where('key', 'basic_salary')->first();
            $setting->value = $request->basic_salary;
            $setting->save();
            $setting = GeneralSettings::where('key', 'type_a')->first();
            $setting->value = $request->type_a;
            $setting->save();
            $setting = GeneralSettings::where('key', 'type_b')->first();
            $setting->value = $request->type_b;
            $setting->save();
            $setting = GeneralSettings::where('key', 'type_c')->first();
            $setting->value = $request->type_c;
            $setting->save();
            $setting = GeneralSettings::where('key', 'type_d')->first();
            $setting->value = $request->type_d;
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
            return redirect()->route('general-settings')->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }
}