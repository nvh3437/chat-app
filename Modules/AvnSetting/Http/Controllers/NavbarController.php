<?php

namespace Modules\AvnSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnSetting\Entities\Navbar;

class NavbarController extends Controller
{
    //------ Thanh menu -------------//
    public static function getMenu()
    {
        $navbars = Navbar::orderBy('order')->get();
        return $navbars;
    }

    public function navbar()
    {
        $navbars = Navbar::get();
        return view('avnsetting::navbar.navbar', compact('navbars'));
    }

    public function storeNavbar(Request $request)
    {
        try {
            $nav = new Navbar();
            $nav->name = $request->name;
            $nav->link = $request->link;
            $nav->order = $request->order;
            $nav->parent_id = $request->parent_id;
            $nav->save();
            return back()->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Thêm thất bại');
        }
    }

    public function editNavbar($id)
    {
        $navbars = Navbar::get();
        $navbar = Navbar::findOrFail($id);
        return view('avnsetting::navbar.edit-navbar', compact('navbar', 'navbars'));
    }

    public function updateNavbar(Request $request, $id)
    {
        try {
            $nav = Navbar::findOrFail($id);
            $nav->name = $request->name;
            $nav->link = $request->link;
            $nav->order = $request->order;
            $nav->parent_id = $request->parent_id;
            $nav->save();
            return redirect()->route('list-navbar')->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deleteNavbar($id)
    {
        try{
            $nav = Navbar::findOrFail($id)->delete();
            return back()->with('Success', 'Xóa thành công');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }
}
