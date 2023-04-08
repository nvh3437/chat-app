<?php

namespace Modules\AvnSetting\Database\Seeders;

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

class AvnSettingDatabaseSeeder extends Seeder
{
    public function run()
    {
        $menu = new AvnMenu();
        $menu->label = 'Cài đặt trang';
        $menu->route_name = 'list-navbar';
        $menu->icon = 'mdi mdi-arrange-send-to-back';
        $menu->module = "AvnSetting";
        $menu->save();

            $menu_navbar = new AvnMenu();
            $menu_navbar->label = 'Navbar';
            $menu_navbar->route_name = 'list-navbar';
            $menu_navbar->icon = 'uil-rss';
            $menu_navbar->module = "AvnSetting";
            $menu_navbar->parent = $menu->id;
            $menu_navbar->save();


        $permission1 = new Permission();
        $permission1->route_names = 'list-navbar, edit-navbar, store-navbar, update-navbar, delete-navbar';
        $permission1->name = 'Cài đặt trang';
        $permission1->menu_id = $menu->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();
    }
}
