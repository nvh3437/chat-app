<?php

namespace Modules\AvnSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnSetting\Entities\Footer;
use Modules\AvnSetting\Entities\FooterIcon;
use Modules\AvnSetting\Entities\FooterInfor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\GeneralSettings;

class FooterController extends Controller
{
    //------------------------------------ Trang chủ -------------------//
    public static function getFooter()
    {
        $footer = Footer::get();
        return $footer;
    }

    public static function getFooterInfo()
    {
        $footer_info = FooterInfor::get();
        return $footer_info;
    }

    public static function getFooterIcon()
    {
        $footer_icon = FooterICon::get();
        return $footer_icon;
    }

    //------------------------------------ Quản lý -----------------------//
    public function footer()
    {
        $footer = Footer::get();
        $footer_info = FooterInfor::get();
        $footer_icon = FooterICon::get();
        $footer_description = GeneralSettings::whereIn('key', [
            'footer_description'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avnsetting::footer.footer', compact('footer', 'footer_info', 'footer_icon', 'footer_description'));
    }

    public function updateFooterDes(Request $request)
    {
        try {
            if ($request->footer_description) {
                $setting = GeneralSettings::where('key', 'footer_description')->first() ?? new GeneralSettings();
                $setting->key = $setting->key ?? 'footer_description';
                $setting->value = trim($request->footer_description);
                $setting->save();
            }
            return back()->with('Success', 'Cập nhập thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhập thất bại');
        }
    }

    //------------------------------ Thông tin cơ bản -------------------------------//
    public function storeFooter(Request $request)
    {
        try {
            $footer = new Footer();
            $footer->infor = $request->infor;
            $footer->save();
            return back()->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Thêm thất bại');
        }
    }

    public function updateFooter(Request $request, $id)
    {
        try {
            $footer = Footer::findOrFail($id);
            $footer->infor = $request->infor;
            $footer->save();
            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deleteFooter($id)
    {
        try{
            $footer = Footer::findOrFail($id)->delete();
            return back()->with('Success', 'Xóa thành công');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }

    //------------------------------ Infor -------------------------------//
    public function storeFooterInfor(Request $request)
    {
        try {
            $footer_infor = new FooterInfor();
            $footer_infor->name = $request->name;
            $footer_infor->link = $request->link;
            $footer_infor->infor_id = $request->infor_id;
            $footer_infor->save();
            return back()->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Thêm thất bại');
        }
    }

    public function updateFooterInfor(Request $request, $id)
    {
        try {
            $footer_infor = FooterInfor::findOrFail($id);
            $footer_infor->name = $request->name;
            $footer_infor->link = $request->link;
            $footer_infor->infor_id = $request->infor_id;
            $footer_infor->save();
            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deleteFooterInfor($id)
    {
        try{
            $footer_infor = FooterInfor::findOrFail($id)->delete();
            return back()->with('Success', 'Xóa thành công');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }

    //------------------------------ Icon -------------------------------//
    public function storeFooterIcon(Request $request)
    {
        try {
            $footer_icon = new FooterIcon();
            $footer_icon->link = $request->link;
            if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
                $image = $request->file('icon');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $footer_icon->icon = $path;
            }
            $footer_icon->save();
            return back()->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Thêm thất bại');
        }
    }

    public function updateFooterIcon(Request $request, $id)
    {
        try {
            $footer_icon = FooterIcon::findOrFail($id);
            $footer_icon->link = $request->link;
            if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
                if ($footer_icon->icon != null) {
                    File::delete($footer_icon->icon);
                }
                $image = $request->file('icon');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnSetting')) {
                    File::makeDirectory('storage/app/AvnSetting', 0777, true, true);
                }
                $image->storeAs('AvnSetting', $filename);
                $path = 'storage/app/AvnSetting/' . $filename;
                $footer_icon->icon = $path;
            }
            $footer_icon->save();
            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deleteFooterIcon($id)
    {
        try{
            $footer_icon = FooterIcon::findOrFail($id);
            if ($footer_icon->icon != null) {
                File::delete($footer_icon->icon);
            }
            $footer_icon->delete();
            return back()->with('Success', 'Xóa thành công');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }
}
