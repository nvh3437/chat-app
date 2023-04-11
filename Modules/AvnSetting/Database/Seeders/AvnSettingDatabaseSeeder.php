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
        $menu->route_name = 'navbar';
        $menu->icon = 'mdi mdi-arrange-send-to-back';
        $menu->module = "AvnSetting";
        $menu->save();

            $menu_navbar = new AvnMenu();
            $menu_navbar->label = 'Navbar';
            $menu_navbar->route_name = 'navbar';
            $menu_navbar->icon = 'uil-rss';
            $menu_navbar->module = "AvnSetting";
            $menu_navbar->parent = $menu->id;
            $menu_navbar->save();

            $menu_footer = new AvnMenu();
            $menu_footer->label = 'Footer';
            $menu_footer->route_name = 'footer';
            $menu_footer->icon = 'uil-rss';
            $menu_footer->module = "AvnSetting";
            $menu_footer->parent = $menu->id;
            $menu_footer->save();

            $menu_home = new AvnMenu();
            $menu_home->label = 'SEO Trang chủ';
            $menu_home->route_name = 'home-seo';
            $menu_home->icon = 'uil-rss';
            $menu_home->module = "AvnSetting";
            $menu_home->parent = $menu->id;
            $menu_home->save();

            $menu_contact = new AvnMenu();
            $menu_contact->label = 'SEO Liên hệ';
            $menu_contact->route_name = 'contact-seo';
            $menu_contact->icon = 'uil-rss';
            $menu_contact->module = "AvnSetting";
            $menu_contact->parent = $menu->id;
            $menu_contact->save();

            $menu_service = new AvnMenu();
            $menu_service->label = 'SEO Dịch vụ';
            $menu_service->route_name = 'service-seo';
            $menu_service->icon = 'uil-rss';
            $menu_service->module = "AvnSetting";
            $menu_service->parent = $menu->id;
            $menu_service->save();

            $menu_post = new AvnMenu();
            $menu_post->label = 'SEO Bài viết';
            $menu_post->route_name = 'post-seo';
            $menu_post->icon = 'uil-rss';
            $menu_post->module = "AvnSetting";
            $menu_post->parent = $menu->id;
            $menu_post->save();


        $permission1 = new Permission();
        $permission1->route_names = 'navbar, edit-navbar, store-navbar, update-navbar, delete-navbar, footer, store-footer, update-footer, delete-footer, store-footer-infor, update-footer-infor, delete-footer-infor, store-footer-icon, update-footer-icon, delete-footer-icon, contact-seo, update-contact-seo, service-seo, update-service-seo, post-seo, update-post-seo, update-footer-des, home-seo, update-home-seo';
        $permission1->name = 'Cài đặt trang';
        $permission1->menu_id = $menu->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();
    }
}
