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
use Modules\AvnSetting\Entities\Navbar;
use Modules\AvnSetting\Entities\Footer;

class AvnSettingDatabaseSeeder extends Seeder
{
    public function run()
    {
        $menu = new AvnMenu();
        $menu->label = 'Cài đặt trang';
        $menu->route_name = 'page-setting';
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
        $menu_home->label = 'Trang chủ';
        $menu_home->route_name = 'home-seo';
        $menu_home->icon = 'uil-rss';
        $menu_home->module = "AvnSetting";
        $menu_home->parent = $menu->id;
        $menu_home->save();

        $menu_contact = new AvnMenu();
        $menu_contact->label = 'Liên hệ';
        $menu_contact->route_name = 'contact-seo';
        $menu_contact->icon = 'uil-rss';
        $menu_contact->module = "AvnSetting";
        $menu_contact->parent = $menu->id;
        $menu_contact->save();



        $menu_post = new AvnMenu();
        $menu_post->label = 'Bài viết';
        $menu_post->route_name = 'post-seo';
        $menu_post->icon = 'uil-rss';
        $menu_post->module = "AvnSetting";
        $menu_post->parent = $menu->id;
        $menu_post->save();


        $permission1 = new Permission();
        $permission1->route_names = 'navbar, edit-navbar, store-navbar, update-navbar, delete-navbar, footer, store-footer, update-footer, delete-footer, contact-seo, update-contact-seo, service-seo, update-service-seo, post-seo, update-post-seo, update-footer-des, home-seo, update-home-seo';
        $permission1->name = 'Cài đặt trang';
        $permission1->menu_id = $menu->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();




        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_seo_title';
        $setting->value = 'Chat App Home';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_seo_description';
        $setting->value = 'Chat online web app make with AvnTech';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_seo_keywords';
        $setting->value = 'Chat online, Transalte, webapp';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_seo_image';
        $setting->value = 'resources/assets/images/logo1.png';
        $setting->save();

        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_banner_title';
        $setting->value = 'Responsive Web UI Kit & Dashboard Template';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_banner_description';
        $setting->value = 'Hyper is a fully featured dashboard and admin template comes with tones of well designed UI elements, components, widgets and pages.';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_banner_link';
        $setting->value = 'https://avntech.vn/';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_banner_image';
        $setting->value = 'resources/assets/images/startupxx.svg';
        $setting->save();

        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_feature_icon';
        $setting->value = 'resources/assets/images/heart.png';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_feature_img';
        $setting->value = 'resources/assets/images/features-1xp.svg';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_feature_title';
        $setting->value = "Features you'll love";
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_feature_des';
        $setting->value = 'Hyper comes with next generation ui design and have multiple benefits';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_feature_sub_title';
        $setting->value = 'Inbuilt applications and pages';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_feature_sub_des';
        $setting->value = 'Hyper comes with a variety of ready-to-use applications and pages that help to speed up the development';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_feature_link';
        $setting->value = 'https://avntech.vn/';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_feature_list_item_1';
        $setting->value = 'Projects & Tasks';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_feature_list_item_2';
        $setting->value = 'Ecommerce Application Pages';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_feature_list_item_3';
        $setting->value = 'Profile, pricing, invoice';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'home_feature_list_item_4';
        $setting->value = 'Login, signup, forget password';
        $setting->save();


        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'post_seo_title';
        $setting->value = 'Bài viết';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'post_seo_description';
        $setting->value = 'Chia sẻ kinh nghiệm và kiến thức';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'post_seo_keywords';
        $setting->value = 'Posts, Share, life style';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'post_seo_image';
        $setting->value = 'resources/assets/images/logo2.png';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'post_page_title';
        $setting->value = 'Chia sẻ bài viết';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'post_page_description';
        $setting->value = 'Chia sẻ kinh nghiệm và kiến thức';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'post_page_icon';
        $setting->value = 'resources/assets/images/heartCopy.png';
        $setting->save();


        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'contact_seo_title';
        $setting->value = 'Contact us';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'contact_seo_description';
        $setting->value = 'Please fill out the following form and we will get back to you shortly. For more information please contact us.';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'contact_seo_keywords';
        $setting->value = 'Contact us, Get In Touch';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'contact_seo_image';
        $setting->value = 'resources/assets/images/logo4.png';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'contact_page_title';
        $setting->value = 'Get In Touch';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'contact_page_description';
        $setting->value = 'Please fill out the following form and we will get back to you shortly. For more information please contact us.';
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'contact_page_icon';
        $setting->value = 'resources/assets/images/heartCopy2.png';
        $setting->save();

        $nav = new Navbar();
        $nav->name = 'Pricing';
        $nav->link = 'service';
        $nav->order = 1;
        $nav->parent_id = 0;
        $nav->save();
        $nav = new Navbar();
        $nav->name = 'Blog';
        $nav->link = 'post';
        $nav->order = 2;
        $nav->parent_id = 0;
        $nav->save();
        $nav = new Navbar();
        $nav->name = 'Contact';
        $nav->link = 'contact';
        $nav->order = 3;
        $nav->parent_id = 0;
        $nav->save();

        $footer_app = new Footer();
        $footer_app->name = 'Chat App';
        $footer_app->parent_id = 0;
        $footer_app->save();
        $footer = new Footer();
        $footer->name = 'Pricing';
        $footer->link = 'service';
        $footer->parent_id = $footer_app->id;
        $footer->save();
        $footer = new Footer();
        $footer->name = 'Blog';
        $footer->link = 'post';
        $footer->parent_id = $footer_app->id;
        $footer->save();
        $footer = new Footer();
        $footer->name = 'Contact';
        $footer->link = 'contact';
        $footer->parent_id = $footer_app->id;
        $footer->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'footer_description';
        $setting->value = trim('Hyper makes it easier to build better websites with<br>
        great speed. Save hundreds of hours of design<br>
        and development by using it.');
        $setting->save();

        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'social_facebook';
        $setting->value = trim('https://www.facebook.com/');
        $setting->save();
        $setting = new GeneralSettings();
        $setting->key = $setting->key ?? 'social_google';
        $setting->value = trim('https://www.google.com/');
        $setting->save();
    }
}