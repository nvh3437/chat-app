<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\UserRole;
use App\Models\PermissionRole;
use App\Models\AvnMenu;
use App\Models\Notification;
use App\Models\GeneralSettings;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $menu_shop = new AvnMenu();
        // $menu_shop->label = 'Cửa hàng';
        // $menu_shop->en = 'Shop';
        // $menu_shop->vi = 'Cửa hàng';
        // $menu_shop->ja = '店';
        // $menu_shop->route_name = 'aimeos_shop_admin';
        // $menu_shop->icon = 'mdi mdi-store';
        // $menu_shop->save();

            $user = new User();
            $user->id = 1;
            $user->name = 'adminsystem';
            $user->email = 'avncongnghe@gmail.com';
            $user->type = 'system';
            $user->username = 'adminsystem';
            $user->password = Hash::make('adminsystem');
            $user->save();



            $setting = new GeneralSettings();
            $setting->key = 'logo';
            $setting->value = null;
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'favicon';
            $setting->value = null;
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'admin_background';
            $setting->value = null;
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'login_background_img';
            $setting->value = null;
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'login_background_text';
            $setting->value = null;
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'company_name';
            $setting->value = 'Chat App';
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'web_title';
            $setting->value = 'Chat Online';
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'address';
            $setting->value = '281 Tiên Dung, Tiên Cát, Việt Trì';
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'phone_number';
            $setting->value = '0123456789';
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'basic_salary';
            $setting->value = '4149000';
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'type_a';
            $setting->value = '126';
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'type_b';
            $setting->value = '101';
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'type_c';
            $setting->value = '76';
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'type_d';
            $setting->value = '50';
            $setting->save();
            $setting = new GeneralSettings();
            $setting->key = 'email';
            $setting->value = 'email@gmail.com';
            $setting->save();

            $noti = new Notification();
            $noti->receiver = 1;
            $noti->title = 'Hệ thống';
            $noti->content = 'Chào mừng bạn đến với hệ thống';
            $noti->icon = 'mdi mdi-tooltip-edit';
            $noti->status = 0;
            $noti->save();

            // Menu hệ thống
            $menu_system = new AvnMenu();
            $menu_system->order = '1000';
            $menu_system->label = 'Hệ thống';
            $noti->vi = 'Hệ thống';
            $noti->en = 'System';
            $noti->ja = 'システム';
            $menu_system->route_name = 'system';
            $menu_system->icon = 'dripicons-gear noti-icon';
            $menu_system->save();

            // Khởi tạo role quản trị
            $role = new Role();
            $role->id = 1;
            $role->name = 'Quản trị';
            $role->save();
            // Khởi tạo user role hệ thống
            $user_roles = new UserRole();
            $user_roles->user_id = $user->id;
            $user_roles->role_id = $role->id;
            $user_roles->save();

            $menu = new AvnMenu();
            $menu->label = 'Trang chủ';
            $noti->vi = 'Trang chủ';
            $noti->en = 'Home page';
            $noti->ja = 'トップページ';
            $menu->route_name = 'dashboard-manager';
            $menu->icon = 'uil-tachometer-fast';
            $menu->save();
            $ss_permis2 = new Permission();
            $ss_permis2->route_names = 'dashboard-manager';
            $ss_permis2->name = 'Xem báo cáo';
            $ss_permis2->menu_id = $menu->id;
            $ss_permis2->save();
            $ss_pr2 = new PermissionRole();
            $ss_pr2->role_id = $role->id;
            $ss_pr2->permission_id = $ss_permis2->id;
            $ss_pr2->save();

            // Menu Role
            $menu_role = new AvnMenu();
            $menu_role->order = '998';
            $menu_role->label = 'Phân quyền';
            $noti->vi = 'Phân quyền';
            $noti->en = 'Authorization';
            $noti->ja = '権限管理';
            $menu_role->route_name = 'role-list';
            $menu_role->icon = 'uil-sitemap';
            $menu_role->parent = $menu_system->id;
            $menu_role->save();
            $role_permis1 = new Permission();
            $role_permis1->route_names = 'role-list';
            $role_permis1->name = 'Xem danh sách';
            $role_permis1->menu_id = $menu_role->id;
            $role_permis1->save();
            $role_permis2 = new Permission();
            $role_permis2->route_names = 'role-store';
            $role_permis2->name = 'Thêm nhóm quyền';
            $role_permis2->menu_id = $menu_role->id;
            $role_permis2->save();
            $role_permis3 = new Permission();
            $role_permis3->route_names = 'role-destroy';
            $role_permis3->name = 'Xóa nhóm quyền';
            $role_permis3->menu_id = $menu_role->id;
            $role_permis3->save();
            $role_permis4 = new Permission();
            $role_permis4->route_names = 'role-update, role-edit-user, role-edit-permission, role-update-user, role-update-permission';
            $role_permis4->name = 'Cập nhật nhóm quyền';
            $role_permis4->menu_id = $menu_role->id;
            $role_permis4->save();
            $role_pr1 = new PermissionRole();
            $role_pr1->role_id = $role->id;
            $role_pr1->permission_id = $role_permis1->id;
            $role_pr1->save();
            $role_pr2 = new PermissionRole();
            $role_pr2->role_id = $role->id;
            $role_pr2->permission_id = $role_permis2->id;
            $role_pr2->save();
            $role_pr3 = new PermissionRole();
            $role_pr3->role_id = $role->id;
            $role_pr3->permission_id = $role_permis3->id;
            $role_pr3->save();
            $role_pr4 = new PermissionRole();
            $role_pr4->role_id = $role->id;
            $role_pr4->permission_id = $role_permis4->id;
            $role_pr4->save();


            // Thông tin hệ thống
            $menu_sett_system = new AvnMenu();
            $menu_sett_system->order = '999';
            $menu_sett_system->label = 'Thông tin hệ thống';
            $noti->vi = 'Thông tin hệ thống';
            $noti->en = 'System information';
            $noti->ja = 'システム情報';
            $menu_sett_system->route_name = 'general-settings';
            $menu_sett_system->icon = 'uil-sitemap';
            $menu_sett_system->parent = $menu_system->id;
            $menu_sett_system->save();
            $ss_permis2 = new Permission();
            $ss_permis2->route_names = 'general-settings, general-settings-edit, general-settings-update, general-settings-update-image';
            $ss_permis2->name = 'Sửa';
            $ss_permis2->menu_id = $menu_sett_system->id;
            $ss_permis2->save();
            $ss_pr2 = new PermissionRole();
            $ss_pr2->role_id = $role->id;
            $ss_pr2->permission_id = $ss_permis2->id;
            $ss_pr2->save();

            $module_setting = new AvnMenu();
            $module_setting->order = '997';
            $module_setting->label = 'Thiết lập module';
            $noti->vi = 'Thiết lập module';
            $noti->en = 'Module setup';
            $noti->ja = 'モジュールの設定';
            $module_setting->route_name = 'modules-settings-link';
            $module_setting->icon = 'uil-sitemap';
            $module_setting->parent = $menu_system->id;
            $module_setting->save();
            $mds_permis1 = new Permission();
            $mds_permis1->route_names = 'modules-settings-link';
            $mds_permis1->name = 'Cài đặt module';
            $mds_permis1->menu_id = $module_setting->id;
            $mds_permis1->save();
            $md_pr1 = new PermissionRole();
            $md_pr1->role_id = $role->id;
            $md_pr1->permission_id = $mds_permis1->id;
            $md_pr1->save();

            $backup_file = new AvnMenu();
            $backup_file->label = 'Sao lưu';
            $noti->vi = 'Sao lưu';
            $noti->en = 'Backup';
            $noti->ja = 'バックアップ';
            $backup_file->route_name = 'list-backup';
            $backup_file->icon = 'uil-sitemap';
            $backup_file->parent = $menu_system->id;
            $backup_file->save();
            $bf_permis1 = new Permission();
            $bf_permis1->route_names = 'list-backup';
            $bf_permis1->name = 'Sao lưu và khôi phục';
            $bf_permis1->menu_id = $backup_file->id;
            $bf_permis1->save();
            $bf_pr1 = new PermissionRole();
            $bf_pr1->role_id = $role->id;
            $bf_pr1->permission_id = $bf_permis1->id;
            $bf_pr1->save();

            // Menu Enable Module
            $menu_module = new AvnMenu();
            $menu_module->order = '997';
            $menu_module->label = 'Quản lý module';
            $noti->vi = 'Quản lý module';
            $noti->en = 'Module management';
            $noti->ja = 'モジュール管理';
            $menu_module->route_name = 'list-module';
            $menu_module->icon = 'uil-sitemap';
            $menu_module->parent = $menu_system->id;
            $menu_module->save();
            $modul_permis1 = new Permission();
            $modul_permis1->route_names = 'list-module';
            $modul_permis1->name = 'Xem danh sách';
            $modul_permis1->menu_id = $menu_module->id;
            $modul_permis1->save();
            $modul_permis2 = new Permission();
            $modul_permis2->route_names = 'switch-module';
            $modul_permis2->name = 'Thay đổi module';
            $modul_permis2->menu_id = $menu_module->id;
            $modul_permis2->save();
            $md_pr1 = new PermissionRole();
            $md_pr1->role_id = $role->id;
            $md_pr1->permission_id = $modul_permis1->id;
            $md_pr1->save();
            $md_pr2 = new PermissionRole();
            $md_pr2->role_id = $role->id;
            $md_pr2->permission_id = $modul_permis2->id;
            $md_pr2->save();

            // Menu User
            $menu_user = new AvnMenu();
            $menu_user->label = 'Quản lý tài khoản';
            $noti->vi = 'Quản lý tài khoản';
            $noti->en = 'Account management';
            $noti->ja = 'アカウント管理';
            $menu_user->route_name = 'list-user';
            $menu_user->icon = 'uil-sitemap';
            $menu_user->parent = $menu_system->id;
            $menu_user->save();
            $userpermis1 = new Permission();
            $userpermis1->route_names = 'list-user';
            $userpermis1->name = 'Xem danh sách';
            $userpermis1->menu_id = $menu_user->id;
            $userpermis1->save();
            $userpermis2 = new Permission();
            $userpermis2->route_names = 'add-user, store-user';
            $userpermis2->name = 'Thêm';
            $userpermis2->menu_id = $menu_user->id;
            $userpermis2->save();
            $userpermis3 = new Permission();
            $userpermis3->route_names = 'edit-user, update-user';
            $userpermis3->name = 'Sửa';
            $userpermis3->menu_id = $menu_user->id;
            $userpermis3->save();
            $userpermis4 = new Permission();
            $userpermis4->route_names = 'delete-user';
            $userpermis4->name = 'Xóa';
            $userpermis4->menu_id = $menu_user->id;
            $userpermis4->save();
            $upr1 = new PermissionRole();
            $upr1->role_id = $role->id;
            $upr1->permission_id = $userpermis1->id;
            $upr1->save();
            $upr2 = new PermissionRole();
            $upr2->role_id = $role->id;
            $upr2->permission_id = $userpermis2->id;
            $upr2->save();
            $upr3 = new PermissionRole();
            $upr3->role_id = $role->id;
            $upr3->permission_id = $userpermis3->id;
            $upr3->save();
            $upr4 = new PermissionRole();
            $upr4->role_id = $role->id;
            $upr4->permission_id = $userpermis4->id;
            $upr4->save();
    }
}
