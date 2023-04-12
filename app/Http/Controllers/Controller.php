<?php

namespace App\Http\Controllers;

use App\Models\AvnMenu;
use App\Models\User;
use App\Models\Notification;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest as URequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //------------------ Side bar ---------------------------//
    public static function getMenu()
    {
        $menus = AvnMenu::where('parent','=',0)->orderBy('order', 'asc')->get();
        return $menus;
    }
    public static function getChildrenMenu($parent_id)
    {
        $modules = AvnMenu::where('parent',$parent_id)->get();
        return $modules;
    }
    public static function getSetting($key = '')
    {
        $setting = GeneralSettings::where('key',$key)->select('value')->first();
        return $setting;
    }
    //------------------ User ---------------------------//
    public static function getUser()
    {
        return Auth::user();
    }
    public static function addUser()
    {
        return view('add-user');
    }
    public static function listUser()
    {
        $users = User::orderByDesc('updated_at')->get();
        return view('list-user', compact('users'));
    }
    public static function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('edit-user',compact('user'));
    }
    public static function storeUser(Request $request)
    {
        try {
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->type = 'system';
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('list-user')->with('Success','Thêm thành công');
        } catch (\Exception $e) {
            return back()->with('Failed','Thêm thất bại');
        }   
    }
    public static function updateUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->username = $request->username;
            $user->email = $request->email;
            $user->type = 'system';
            $user->name = $request->name;
            if ($request->password != null && strlen($request->password) > 0) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return redirect()->route('list-user')->with('Success','Cập nhập thành công');
        } catch (\Exception $e) {
            return back()->with('Failed','Cập nhập thất bại');
        }   
    }
    public static function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id)->delete();
            return back()->with('Success','Xóa thành công');
        } catch  (\Exception $e) {
            return back()->with('Failed','Xóa thất bại');
        }
    }

    
    
}
