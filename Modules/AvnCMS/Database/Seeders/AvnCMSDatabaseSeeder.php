<?php

namespace Modules\AvnCMS\Database\Seeders;

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

class AvnCMSDatabaseSeeder extends Seeder
{
    public function run()
    {
        $menu = new AvnMenu();
        $menu->label = 'CMS';
        $menu->route_name = 'list-cms';
        $menu->icon = 'mdi mdi-web';
        $menu->module = "AvnCMS";
        $menu->save();

        $permission1 = new Permission();
        $permission1->route_names = 'list-cms, add-cms, edit-cms, store-cms, update-cms, delete-cms';
        $permission1->name = 'Quản lý CMS';
        $permission1->menu_id = $menu->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();
    }
}
