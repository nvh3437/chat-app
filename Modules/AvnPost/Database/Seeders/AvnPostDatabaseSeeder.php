<?php

namespace Modules\AvnPost\Database\Seeders;

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

class AvnPostDatabaseSeeder extends Seeder
{
    public function run()
    {
        $menu = new AvnMenu();
        $menu->label = 'Bài viết';
        $menu->en = 'Posts';
        $menu->vi = 'Bài viết';
        $menu->ja = '投稿';
        $menu->route_name = 'list-post';
        $menu->icon = 'mdi mdi-book-edit';
        $menu->module = "AvnPost";
        $menu->save();

        $menu_category = new AvnMenu();
        $menu_category->label = 'Danh mục';
        $menu_category->en = 'Category';
        $menu_category->vi = 'Danh mục';
        $menu_category->ja = 'カテゴリー';
        $menu_category->route_name = 'list-category';
        $menu_category->icon = 'uil-rss';
        $menu_category->module = "AvnPost";
        $menu_category->parent = $menu->id;
        $menu_category->save();

        $menu_post = new AvnMenu();
        $menu_post->label = 'Bài viết';
        $menu_post->en = 'Posts';
        $menu_post->vi = 'Bài viết';
        $menu_post->ja = '投稿';
        $menu_post->route_name = 'list-post';
        $menu_post->icon = 'mdi mdi-post';
        $menu_post->module = "AvnPost";
        $menu_post->parent = $menu->id;
        $menu_post->save();

        $permission1 = new Permission();
        $permission1->route_names = 'list-category, store-category, update-category, delete-category, list-post, add-post, edit-post, store-post, update-post, delete-post';
        $permission1->name = 'Quản lý bài viết';
        $permission1->menu_id = $menu->id;
        $permission1->save();

        $pr1 = new PermissionRole();
        $pr1->role_id = 1;
        $pr1->permission_id = $permission1->id;
        $pr1->save();

    }
}