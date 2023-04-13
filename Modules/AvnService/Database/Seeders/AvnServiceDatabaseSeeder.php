<?php

namespace Modules\AvnService\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\PermissionRole;
use App\Models\AvnMenu;
use App\Models\User;
use App\Models\GeneralSettings;
use App\Models\ModulesSettingsLink;

class AvnServiceDatabaseSeeder extends Seeder
{
    public function run()
    {
        $menu = new AvnMenu();
        $menu->label = 'Dịch vụ';
        $menu->route_name = 'list-service';
        $menu->icon = 'mdi mdi-post';
        $menu->module = "AvnService";
        $menu->save();

            $menu_type = new AvnMenu();
            $menu_type->label = 'Loại dịch vụ';
            $menu_type->route_name = 'list-type';
            $menu_type->icon = 'uil-rss';
            $menu_type->module = "AvnService";
            $menu_type->parent = $menu->id;
            $menu_type->save();

            $menu_service = new AvnMenu();
            $menu_service->label = 'Bài dịch vụ';
            $menu_service->route_name = 'list-service';
            $menu_service->icon = 'mdi mdi-post';
            $menu_service->module = "AvnService";
            $menu_service->parent = $menu->id;
            $menu_service->save();

        $permission1 = new Permission();
        $permission1->route_names = 'list-type, store-type, update-type, delete-type, list-service, add-service, edit-service, store-service, update-service, delete-service';
        $permission1->name = 'Quản lý dịch vụ';
        $permission1->menu_id = $menu->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();
    }
}
