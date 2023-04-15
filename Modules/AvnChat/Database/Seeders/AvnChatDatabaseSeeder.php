<?php

namespace Modules\AvnChat\Database\Seeders;

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
use Modules\AvnChat\Entities\ChatRoom;
use Modules\AvnChat\Entities\ChatRoomUser;

class AvnChatDatabaseSeeder extends Seeder
{
    public function run()
    {
        $menu_chat = new AvnMenu();
        $menu_chat->label = 'Chat';
        $menu_chat->route_name = 'chat-index';
        $menu_chat->icon = 'uil-comments-alt';
        $menu_chat->module = "AvnChat";
        $menu_chat->save();

        $global_room = new ChatRoom();
        $global_room->name = 'Community';
        $global_room->save();

        $global_room_user = new ChatRoomUser();
        $global_room_user->room_id = 1;
        $global_room_user->user_id = 1;
        $global_room_user->save();
    }
}