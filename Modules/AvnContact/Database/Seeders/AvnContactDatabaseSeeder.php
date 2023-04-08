<?php

namespace Modules\AvnContact\Database\Seeders;

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

class AvnContactDatabaseSeeder extends Seeder
{
    public function run()
    {
        $menu = new AvnMenu();
        $menu->label = 'Liên hệ';
        $menu->route_name = 'list-contact';
        $menu->icon = 'mdi mdi-email-alert-outline';
        $menu->module = "AvnContact";
        $menu->save();

        $permission1 = new Permission();
        $permission1->route_names = 'list-contact, delete-contact';
        $permission1->name = 'Quản lý liên hệ';
        $permission1->menu_id = $menu->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();
    }
}
