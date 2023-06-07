<?php

namespace Modules\AvnSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnSetting\Entities\Navbar;
use Lang;

class NavbarController extends Controller
{
    //------ Thanh menu -------------//
    public static function getMenu()
    {
        $navbars = Navbar::where('parent_id', 0)->orderBy('order')->get();
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
            if ($request->multi_lang) {
                $nav->ja = $request->group_name[0];
                $nav->vi = $request->group_name[1];
                $nav->en = $request->group_name[2];
            }
            $nav->link = $request->link;
            $nav->order = $request->order;
            $nav->parent_id = $request->parent_id;
            $nav->save();
            return back()->with('Success', Lang::get("settings.Add.Add_success"));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get("settings.Add.Add_failed"));
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
            if ($request->multi_lang) {
                $nav->ja = $request->group_name[0];
                $nav->vi = $request->group_name[1];
                $nav->en = $request->group_name[2];
            } else {
                $nav->ja = null;
                $nav->vi = null;
                $nav->en = null;
            }
            $nav->link = $request->link;
            $nav->order = $request->order;
            $nav->parent_id = $request->parent_id;
            $nav->save();
            return redirect()->route('navbar')->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    public function deleteNavbar($id)
    {
        try {
            $nav = Navbar::findOrFail($id);
            foreach ($nav->childrens as $children) {
                $children->parent_id = 0;
            }
            $nav->delete();
            return back()->with('Success', Lang::get('settings.Delete.Delete_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Delete.Delete_failed'));
        }
    }
}