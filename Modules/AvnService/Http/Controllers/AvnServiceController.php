<?php

namespace Modules\AvnService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnService\Entities\Service;
use App\Models\GeneralSettings;
use Modules\AvnService\Http\Requests\ServiceRequest;
use Illuminate\Support\Facades\File;
use Lang;

class AvnServiceController extends Controller
{
    public function serviceSetting()
    {
        $service_seo = GeneralSettings::whereIn('key', [
            'service_seo_title',
            'service_seo_description',
            'service_seo_keywords',
            'service_seo_image',
            'service_page_title_en',
            'service_page_description_en',
            'service_page_icon_en',
            'service_page_title_vi',
            'service_page_description_vi',
            'service_page_icon_vi',
            'service_page_title_ja',
            'service_page_description_ja',
            'service_page_icon_ja',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $services = Service::orderByDesc('updated_at')->get();
        return view('avnservice::service-setting', compact('service_seo', 'services'));
    }

    public function updateServiceSetting(Request $request)
    {
        try {
            $setting = GeneralSettings::where('key', 'service_seo_title')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'service_seo_title';
            $setting->value = trim($request->service_seo_title);
            $setting->save();
            $setting = GeneralSettings::where('key', 'service_seo_description')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'service_seo_description';
            $setting->value = trim($request->service_seo_description);
            $setting->save();
            $setting = GeneralSettings::where('key', 'service_seo_keywords')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'service_seo_keywords';
            $setting->value = trim($request->service_seo_keywords);
            $setting->save();
            if ($request->hasFile('service_seo_image') && $request->file('service_seo_image')->isValid()) {
                $setting = GeneralSettings::where('key', 'service_seo_image')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('service_seo_image');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'service_seo_image';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'service_page_title_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'service_page_title_en';
            $setting->value = trim($request->service_page_title_en);
            $setting->save();
            $setting = GeneralSettings::where('key', 'service_page_description_en')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'service_page_description_en';
            $setting->value = trim($request->service_page_description_en);
            $setting->save();
            if ($request->hasFile('service_page_icon_en') && $request->file('service_page_icon_en')->isValid()) {
                $setting = GeneralSettings::where('key', 'service_page_icon_en')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('service_page_icon_en');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'service_page_icon_en';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'service_page_title_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'service_page_title_vi';
            $setting->value = trim($request->service_page_title_vi);
            $setting->save();
            $setting = GeneralSettings::where('key', 'service_page_description_vi')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'service_page_description_vi';
            $setting->value = trim($request->service_page_description_vi);
            $setting->save();
            if ($request->hasFile('service_page_icon_vi') && $request->file('service_page_icon_vi')->isValid()) {
                $setting = GeneralSettings::where('key', 'service_page_icon_vi')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('service_page_icon_vi');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'service_page_icon_vi';
                $setting->value = $path;
                $setting->save();
            }
            $setting = GeneralSettings::where('key', 'service_page_title_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'service_page_title_ja';
            $setting->value = trim($request->service_page_title_ja);
            $setting->save();
            $setting = GeneralSettings::where('key', 'service_page_description_ja')->first() ?? new GeneralSettings();
            $setting->key = $setting->key ?? 'service_page_description_ja';
            $setting->value = trim($request->service_page_description_ja);
            $setting->save();
            if ($request->hasFile('service_page_icon_ja') && $request->file('service_page_icon_ja')->isValid()) {
                $setting = GeneralSettings::where('key', 'service_page_icon_ja')->first() ?? new GeneralSettings();
                if ($setting->value != null) {
                    File::delete($setting->value);
                }
                $image = $request->file('service_page_icon_ja');
                $filename = date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $setting->key = $setting->key ?? 'service_page_icon_ja';
                $setting->value = $path;
                $setting->save();
            }
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }
    //-------------------- Trang chủ --------------------//
    public static function getService()
    {
        $services = Service::orderByDesc('created_at')->limit(3)->get();
        return $services;
    }
    //-------------------- Quản lý ----------------------//
    public function addService()
    {
        return view('avnservice::service.add-service');
    }

    public function storeService(ServiceRequest $request)
    {
        try {
            $service = new Service();
            $service->name = $request->name;
            if ($request->multi_lang) {
                $service->name_ja = $request->group_name[0];
                $service->name_vi = $request->group_name[1];
                $service->name_en = $request->group_name[2];
            }
            $service->description = $request->description;
            if ($request->multi_lang) {
                $service->description_ja = $request->description_ja;
                $service->description_vi = $request->description_vi;
                $service->description_en = $request->description_en;
            }
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnService')) {
                    File::makeDirectory('storage/app/AvnService', 0777, true, true);
                }
                $image->storeAs('AvnService', $filename);
                $path = 'storage/app/AvnService/' . $filename;
                $service->img = $path;
            }
            $service->price = $request->price;
            $service->recommended = $request->recommended ?? 0;
            $service->save();
            return redirect()->route('service-setting')->with('Success', Lang::get('settings.Add.Add_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Add.Add_failed'));
        }
    }

    public function editService($id)
    {
        $service = Service::findOrFail($id);
        return view('avnservice::service.edit-service', compact('service'));
    }

    public function updateService(ServiceRequest $request, $id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->name = $request->name;
            if ($request->multi_lang) {
                $service->name_ja = $request->group_name[0];
                $service->name_vi = $request->group_name[1];
                $service->name_en = $request->group_name[2];
            } else {
                $service->name_ja = null;
                $service->name_vi = null;
                $service->name_en = null;
            }
            $service->description = $request->description;
            if ($request->multi_lang) {
                $service->description_ja = $request->description_ja;
                $service->description_vi = $request->description_vi;
                $service->description_en = $request->description_en;
            } else {
                $service->description_ja = null;
                $service->description_vi = null;
                $service->description_en = null;
            }
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                if ($service->img != null) {
                    File::delete($service->img);
                }
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnService')) {
                    File::makeDirectory('storage/app/AvnService', 0777, true, true);
                }
                $image->storeAs('AvnService', $filename);
                $path = 'storage/app/AvnService/' . $filename;
                $service->img = $path;
            }
            $service->price = $request->price;
            $service->recommended = $request->recommended ?? 0;
            $service->save();
            return redirect()->route('service-setting')->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    public function deleteService($id)
    {
        try {
            $service = Service::findOrFail($id);
            if ($service->img != null) {
                File::delete($service->img);
            }
            $service->delete();
            return back()->with('Success', Lang::get('settings.Delete.Delete_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Delete.Delete_failed'));
        }
    }

    //-------------------- Trang dịch vụ ----------------------//
    public function servicePage()
    {
        $services = Service::orderByDesc('created_at')->get();
        $service_seo = GeneralSettings::whereIn('key', [
            'service_seo_title',
            'service_seo_description',
            'service_seo_keywords',
            'service_seo_image',
            'service_page_title_' . Lang::locale(),
            'service_page_description_' . Lang::locale(),
            'service_page_icon_' . Lang::locale()
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avnservice::service.service-page', compact('services', 'service_seo'));
    }
}