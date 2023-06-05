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
            $cms->alias = Helper::createSlug(trim($cms->name));
            if (count(CMS::where('alias', $cms->alias)->get()) > 0) {
                $cms->alias = Helper::createSlug(trim($cms->alias . ' ' . rand()));
            }
            $cms->link = $request->link;
            $cms->save();
            return redirect()->route('list-cms')->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Thêm thất bại');
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
            $alias = Helper::createSlug($request->name);
            if ($cms->alias != $alias) {
                if (count(CMS::where('alias', '==', $alias)->get()) > 0) {
                    $cms->alias = Helper::createSlug($alias . ' ' . rand());
                } else
                    $cms->alias = $alias;
            }
            if ($cms->link != $request->link && $request->link) {
                $cms_change_link = CMS::where('link', $request->link)->first();
                if ($cms_change_link) {
                    return back()->with('Failed', 'Đường dẫn đã tồn tại');
                }
                $cms->link = $request->link;
            }
            $cms->save();
            return redirect()->route('list-cms')->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deleteCMS($id)
    {
        try{
            $cms = CMS::findOrFail($id);
            if ($cms->img != null) {
                File::delete($cms->img);
            }
            $cms->delete();
            return back()->with('Success', 'Xóa thành công');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }
}
