<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use App\Models\PermissionRole;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\AvnMenu;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    public function list()
    {
        $roles = Role::get();
        return view('role.list', compact('roles'));
    }

    public function store(RoleRequest $request)
    {
        try {
            $role = new Role();
            $role->name = $request->name;
            $role->save();
            return redirect()->route('role-list')->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return redirect()->route('role-list')->with('Failed', 'Thêm thất bại');
        }
    }

    public function edit_permission($id)
    {
        $role = Role::findOrFail($id);
        if ($role->id == 1) {
            return redirect()->route('role-list')->with('Failed', 'Role mặc định không thể sửa');
        }
        $menus = AvnMenu::get();
        $other_permissions = Permission::where('menu_id', null)->get();
        return view('role.edit-permission', compact('role', 'menus', 'other_permissions'));
    }

    public function update_permission(RoleRequest $request, $id)
    {
        try {
            $role = Role::findOrFail($id);
            if ($role->id == 1) {
                return redirect()->route('role-list')->with('Failed', 'Role mặc định không thể xóa');
            }
            $role->name = $request->name;
            $role->save();
            PermissionRole::where('role_id', $role->id)
                ->delete();
            if ($request->permissions != null) {
                foreach ($request->permissions as $permission) {
                    $permission_role = new PermissionRole();
                    $permission_role->permission_id = $permission;
                    $permission_role->role_id = $role->id;
                    $permission_role->save();
                }
            }
            return redirect()->route('role-list')->with('Success', 'Cập nhập thành công');
        } catch (Exception $e) {
            return redirect()->route('role-list')->with('Failed', 'Cập nhập thất bại');
        }
    }


    public function edit_user($id)
    {
        $role = Role::findOrFail($id);
        $users = User::get();
        return view('role.edit-user', compact('role', 'users'));
    }

    public function update_user(RoleRequest $request, $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->save();
            $super = User::where('username', 'adminsystem')->first();
            UserRole::where('role_id', $role->id)->where('user_id', '!=', $super->id)
                ->delete();
            if ($request->users != null) {
                foreach ($request->users as $user) {
                    $user_role = new UserRole();
                    $user_role->user_id = $user;
                    $user_role->role_id = $role->id;
                    $user_role->save();
                }
            }
            return redirect()->route('role-list')->with('Success', 'Cập nhập thành công');
        } catch (Exception $e) {
            return redirect()->route('role-list')->with('Failed', 'Cập nhập thất bại');
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            if ($role->id == 1) {
                return redirect()->route('role-list')->with('Failed', 'Role mặc định không thể xóa');
            }
            $role->delete();
            return redirect()->route('role-list')->with('Success', 'Xóa thành công');
        } catch (Exception $e) {
            return redirect()->route('role-list')->with('Failed', 'Xóa thất bại');
        }
    }
    public static function isNotBlock($menu = null, $route_names = null)
    {
        if($route_names == null)
        {
            $permissions = Permission::where('route_names', 'like', '%' . $menu->route_name . '%')->get();
        }else{
            $permissions = collect();
            foreach ($route_names as $item) {
                $permissionsx = Permission::where('route_names', 'like', '%' . $item . '%')->get();
                if(count($permissionsx) > 0){
                    $permissions = $permissions->merge($permissionsx);
                }
            }
        }
        if ($permissions == null || count($permissions) <= 0) {
            return true;
        } else {
            $currentUser = Auth::user();
            $currentUserRoles = $currentUser->roles;
            foreach($currentUserRoles as $role){
                // Danh sách quyền của role
                $user_permissions = $role->permissions;
                // Duyệt danh sách quyền của role
                foreach ($user_permissions as $permission) {
                    if($permissions->contains('id', $permission->id)){
                        return true;
                    }
                }
            }
        }
        return false;
    }
}