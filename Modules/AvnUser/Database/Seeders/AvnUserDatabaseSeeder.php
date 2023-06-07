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
        $menu_partner = new AvnMenu();
        $menu_partner->label = 'Chuyên gia';
        $menu_partner->en = 'Expert';
        $menu_partner->vi = 'Chuyên gia';
        $menu_partner->ja = 'エキスパート';
        $menu_partner->route_name = 'list-partner';
        $menu_partner->icon = 'dripicons-user-id';
        $menu_partner->module = "AvnUser";
        $menu_partner->save();

        $permission1 = new Permission();
        $permission1->route_names = 'list-partner, add-partner, edit-partner, store-partner, update-partner, delete-partner, update-money-partner';
        $permission1->name = 'Quản lý chuyên gia';
        $permission1->menu_id = $menu_partner->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();

        $menu_customer = new AvnMenu();
        $menu_customer->label = 'Khách hàng';
        $menu_customer->en = 'Customer';
        $menu_customer->vi = 'Khách hàng';
        $menu_customer->ja = '顧客';
        $menu_customer->route_name = 'list-customer';
        $menu_customer->icon = 'dripicons-user-group';
        $menu_customer->module = "AvnUser";
        $menu_customer->save();

        $permission1 = new Permission();
        $permission1->route_names = 'list-customer, add-customer, edit-customer, store-customer, update-customer, delete-customer, update-money-customer';
        $permission1->name = 'Quản lý khách hàng';
        $permission1->menu_id = $menu_customer->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();
    }
}