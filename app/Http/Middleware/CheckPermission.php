<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRole;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentRoute = Route::currentRouteName();
        $currentUser = Auth::user();

        // Danh sách role của user hiện tại
        $currentUserRoles = $currentUser->roles;
        // Danh sách route user được truy cập
        $allowPermissions = "";

        // Duyệt dánh sách role của user hiện tại
        foreach($currentUserRoles as $role){
            // Danh sách quyền của role
            $permissions = $role->permissions;
            // Duyệt danh sách quyền của role
            foreach ($permissions as $permission) {
                // Thêm route name của quyền vào danh sách route user được truy cập
                $allowPermissions .= $permission->route_names.", ";
            }
        }
        // Nếu route hiện tại có trong danh sách thì cho đi qua
        if(str_contains($allowPermissions, $currentRoute)){
            return $next($request);
        }
        // nếu không thì báo forbidden
        return redirect('forbidden');
    }
}
