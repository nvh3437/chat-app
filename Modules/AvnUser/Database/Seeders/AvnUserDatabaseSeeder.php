<?php

namespace Modules\AvnUser\Database\Seeders;

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

class AvnUserDatabaseSeeder extends Seeder
{
    public function run()
    {
        $menu_partern = new AvnMenu();
        $menu_partern->label = 'Chuyên gia';
        $menu_partern->route_name = 'list-partern';
        $menu_partern->icon = 'dripicons-user-id';
        $menu_partern->module = "AvnUser";
        $menu_partern->save();

        $permission1 = new Permission();
        $permission1->route_names = 'list-partern, add-partern, edit-partern, store-partern, update-partern, delete-partern';
        $permission1->name = 'Quản lý chuyên gia';
        $permission1->menu_id = $menu_partern->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();
        
        $menu_customer = new AvnMenu();
        $menu_customer->label = 'Khách hàng';
        $menu_customer->route_name = 'list-customer';
        $menu_customer->icon = 'dripicons-user-group';
        $menu_customer->module = "AvnUser";
        $menu_customer->save();

        $permission1 = new Permission();
        $permission1->route_names = 'list-customer, add-customer, edit-customer, store-customer, update-customer, delete-customer';
        $permission1->name = 'Quản lý khách hàng';
        $permission1->menu_id = $menu_customer->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();
    }
}
