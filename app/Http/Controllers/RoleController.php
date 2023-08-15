<?php

namespace App\Http\Controllers;

use Aimeos\Shop\Controller\AdminController;
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
use Lang;

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
            return redirect()->route('role-list')->with('Success', Lang::get('settings.Add.Add_success'));
        } catch (Exception $e) {
            return redirect()->route('role-list')->with('Failed', Lang::get('settings.Add.Add_failed'));
        }
    }

    public function edit_permission($id)
    {
        $role = Role::findOrFail($id);
        if ($role->id == 1) {
            return redirect()->route('role-list')->with('Failed', Lang::get('settings.Role.Validate.Role_default_edit_failed'));
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
                return redirect()->route('role-list')->with('Failed', Lang::get('settings.Role.Validate.Role_default_edit_failed'));
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
            return redirect()->route('role-list')->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return redirect()->route('role-list')->with('Failed', Lang::get('settings.Update.Update_failed'));
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
            return redirect()->route('role-list')->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return redirect()->route('role-list')->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            if ($role->id == 1) {
                return redirect()->route('role-list')->with('Failed', Lang::get('settings.Role.Validate.Role_default_delete_failed'));
            }
            $role->delete();
            return redirect()->route('role-list')->with('Success', Lang::get('settings.Delete.Delete_success'));
        } catch (Exception $e) {
            return redirect()->route('role-list')->with('Failed', Lang::get('settings.Delete.Delete_failed'));
        }
    }
    public static function isNotBlock($menu = null, $route_names = null)
    {
        if ($route_names == null) {
            $permissions = Permission::where('route_names', 'like', '%' . $menu->route_name . '%')->get();
        } else {
            $permissions = collect();
            foreach ($route_names as $item) {
                $permissionsx = Permission::where('route_names', 'like', '%' . $item . '%')->get();
                if (count($permissionsx) > 0) {
                    $permissions = $permissions->merge($permissionsx);
                }
            }
        }
        $currentUser = Auth::user();
        if (($menu->route_names == 'aimeos_shop_admin' || $route_names == 'aimeos_shop_admin') && $currentUser->can('admin', [AdminController::class, config('shop.roles', ['admin', 'editor'])]) === true) {
            return true;
        }
        if ($permissions == null || count($permissions) <= 0) {
            return true;
        } else {
            $currentUserRoles = $currentUser->roles;
            foreach ($currentUserRoles as $role) {
                // Danh sách quyền của role
                $user_permissions = $role->permissions;
                // Duyệt danh sách quyền của role
                foreach ($user_permissions as $permission) {
                    if ($permissions->contains('id', $permission->id)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
