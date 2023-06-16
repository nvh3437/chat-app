<?php

namespace Modules\AvnCMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnCMS\Entities\CMS;
use App\Http\Controllers\Helper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\GeneralSettings;
use Modules\AvnCMS\Http\Requests\CMSRequest;
use Modules\AvnCMS\Http\Requests\CMSUpdateRequest;
use Lang;

class CMSController extends Controller
{
    //---------------------------- Trang CMS ---------------//
    public function cmsPage($link)
    {
        $cms = CMS::where('link', $link)->first();
        if (!$cms) {
            $cms = CMS::findOrFail($cms);
        }
        return view('avncms::cms-page', compact('cms'));
    }
    //---------------------------- Quản lý -----------------//
    public function listCMS()
    {
        $cms = CMS::get();
        return view('avncms::list-cms', compact('cms'));
    }

    public function addCMS()
    {
        return view('avncms::add-cms');
    }

    public function storeCMS(CMSRequest $request)
    {
        try {
            $cms = new CMS();
            $cms->name = $request->name;
            if ($request->multi_lang) {
                $cms->name_ja = $request->name_ja;
                $cms->name_vi = $request->name_vi;
                $cms->name_en = $request->name_en;
            }
            $cms->keywords = $request->keywords;
            $cms->sort_description = $request->sort_description;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnCMS')) {
                    File::makeDirectory('storage/app/AvnCMS', 0777, true, true);
                }
                $image->storeAs('AvnCMS', $filename);
                $path = 'storage/app/AvnCMS/' . $filename;
                $cms->img = $path;
            }
            $cms->description = $request->description;
            if ($request->multi_lang) {
                $cms->description_ja = $request->description_ja;
                $cms->description_vi = $request->description_vi;
                $cms->description_en = $request->description_en;
            }
            $cms->link = $request->link;
            $cms->save();
            return redirect()->route('list-cms')->with('Success', Lang::get('settings.Add.Add_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Add.Add_failed'));
        }
    }

    public function editCMS($id)
    {
        $cms = CMS::findOrFail($id);
        return view('avncms::edit-cms', compact('cms'));
    }

    public function updateCMS(CMSUpdateRequest $request, $id)
    {
        try {
            $cms = CMS::findOrFail($id);
            $cms->name = $request->name;
            if ($request->multi_lang) {
                $cms->name_ja = $request->name_ja;
                $cms->name_vi = $request->name_vi;
                $cms->name_en = $request->name_en;
            } else {
                $cms->name_ja = null;
                $cms->name_vi = null;
                $cms->name_en = null;
            }
            $cms->keywords = $request->keywords;
            $cms->sort_description = $request->sort_description;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                if ($cms->img != null) {
                    File::delete($cms->img);
                }
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnCMS')) {
                    File::makeDirectory('storage/app/AvnCMS', 0777, true, true);
                }
                $image->storeAs('AvnCMS', $filename);
                $path = 'storage/app/AvnCMS/' . $filename;
                $cms->img = $path;
            }
            $cms->description = $request->description;
            if ($request->multi_lang) {
                $cms->description_ja = $request->description_ja;
                $cms->description_vi = $request->description_vi;
                $cms->description_en = $request->description_en;
            } else {
                $cms->description_ja = null;
                $cms->description_vi = null;
                $cms->description_en = null;
            }
            if ($cms->link != $request->link && $request->link) {
                $cms_change_link = CMS::where('link', $request->link)->first();
                if ($cms_change_link) {
                    return back()->with('Failed', Lang::get('settings.Validate.Unique', ['name' => Lang::get('settings.Route')]));
                }
                $cms->link = $request->link;
            }
            $cms->save();
            return redirect()->route('list-cms')->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    public function deleteCMS($id)
    {
        try {
            $cms = CMS::findOrFail($id);
            if ($cms->img != null) {
                File::delete($cms->img);
            }
            $cms->delete();
            return back()->with('Success', Lang::get('settings.Delete.Delete_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Delete.Delete_failed'));
        }
    }
}