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
use Modules\AvnService\Entities\Service;

class AvnServiceDatabaseSeeder extends Seeder
{
    public function run()
    {
        $menu_service = new AvnMenu();
        $menu_service->label = 'Dịch vụ';
        $menu_service->route_name = 'service-setting';
        $menu_service->icon = 'uil-rss';
        $menu_service->module = "AvnSetting";
        $menu_service->parent = AvnMenu::where('route_name', 'page-setting')->first()->id;
        $menu_service->save();

        $permission1 = new Permission();
        $permission1->route_names = 'service-setting, update-service-setting, add-service, edit-service, store-service, update-service, delete-service';
        $permission1->name = 'Quản lý dịch vụ';
        $permission1->menu_id = $menu_service->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();

        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_seo_title';
        $setting->value = 'Services';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_seo_description';
        $setting->value = "The clean and well commented code allows easy customization of the theme.It's designed for
        describing your app, agency or business.";
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_seo_keywords';
        $setting->value = 'Pricing, Services';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_seo_image';
        $setting->value = 'resources/assets/images/logo3.png';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_title';
        $setting->value = 'Choose Simple Pricing';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_description';
        $setting->value = "The clean and well commented code allows easy customization of the theme.It's designed for
        describing your app, agency or business.";
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'service_page_icon';
        $setting->value = 'resources/assets/images/083934.png';
        $setting->save();

        $service = new Service();
        $service->name = 'STANDARD LICENSE';
        $service->img = 'resources/assets/images/54684616.png';
        $service->price = '$49 / LICENSE';
        $service->description = '<p>10 GB Storage</p><p>500 GB Bandwidth</p><p>No Domain</p><p>1 User</p><p>Email Support</p><p>24x7 </p>';
        $service->recommended = 0;
        $service->save();
        $service = new Service();
        $service->name = 'MULTIPLE LICENSE';
        $service->img = 'resources/assets/images/63456463.png';
        $service->price = '$99 / LICENSE';
        $service->description = '<p>50 GB Storage</p><p>900 GB Bandwidth</p><p>2 Domain</p><p>10 User</p><p>Email Support</p><p>24x7 </p>';
        $service->recommended = 1;
        $service->save();
        $service = new Service();
        $service->name = 'EXTENDED LICENSE';
        $service->img = 'resources/assets/images/4355555543.png';
        $service->price = '$599 / LICENSE';
        $service->description = '<p>100 GB Storage</p><p>Unlimited Bandwidth</p><p>10 Domain</p><p>Unlimited User</p><p>Email Support</p><p>24x7 </p>';
        $service->recommended = 0;
        $service->save();
    }
}