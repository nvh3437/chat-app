<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AvnMenu;

class UserSeeder extends Seeder
{
    public function run()
    {
        $menu = new AvnMenu();
        $menu->label = 'Quản lý người dùng';
        $menu->route_name = 'list-user';
        $menu->icon = 'uil-sitemap';
        $menu->save();
    }
}
