<?php

namespace Modules\AvnUser\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnUser\Entities\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Modules\AvnUser\Http\Requests\StorePartnerRequest;
use Modules\AvnUser\Http\Requests\UpdatePartnerRequest;
use Modules\AvnChat\Entities\ChatRoomUser;
use Modules\AvnChat\Entities\ChatRoom;
use Illuminate\Database\Eloquent\Builder;
use Modules\AvnUser\Entities\AddSubMoney;

class PartnerManagerController extends Controller
{
    public function listPartner()
    {
        $partners = Profile::whereHas('user', function (Builder $query) {
            $query->where('type', 'partner');
        })->orderByDesc('updated_at')->get();
        return view('avnuser::manager.list-partner', compact('partners'));
    }

    public function addPartner()
    {
        return view('avnuser::manager.add-partner');
    }

    public function storePartner(StorePartnerRequest $request)
    {
        try {
            // Lưu bảng user 
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->type = 'partner';
            $user->password = Hash::make($request->password);
            $user->save();

            $global_chat_room_user = new ChatRoomUser();
            $global_chat_room_user->user_id = $user->id;
            $global_chat_room_user->room_id = 1;
            $global_chat_room_user->save();

            $partner_chat_room = new ChatRoom();
            $partner_chat_room->is_workspace = 1;
            $partner_chat_room->save();

            $partner_chat_room_user = new ChatRoomUser();
            $partner_chat_room_user->user_id = $user->id;
            $partner_chat_room_user->room_id = $partner_chat_room->id;
            $partner_chat_room_user->save();

            // Lưu bảng partner
            $partner = new Profile();
            $partner->id = $user->id;
            $partner->exp = $request->exp;
            $partner->money = 0;
            $partner->price = $request->price;
            $partner->gender = $request->gender;
            $partner->address = $request->address;
            $partner->description = $request->description;
            $partner->birth = $request->birth;
            $partner->phone = $request->phone;
            $partner->gender_status = 0;
            $partner->exp_status = 0;
            $partner->address_status = 0;
            $partner->description_status = 0;
            $partner->money_status = 0;
            $partner->email_status = 0;
            $partner->birth_status = 0;
            $partner->phone_status = 0;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnUser')) {
                    File::makeDirectory('storage/app/AvnUser', 0777, true, true);
                }
                $image->storeAs('AvnUser', $filename);
                $path = 'storage/app/AvnUser/' . $filename;
                $partner->img = $path;
            }
            $partner->save();
            return redirect()->route('list-partner')->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Thêm thất bại');
        }
    }

    public function editPartner($id)
    {
        $partner = Profile::findOrFail($id);
        $user = User::findOrFail($id);
        return view('avnuser::manager.edit-partner', compact('partner', 'user'));
    }

    public function updatePartner(UpdatePartnerRequest $request, $id)
    {
        try {
            // Lưu bảng user 
            $user = User::findOrFail($id);
            $user->name = $request->name;
            if ($user->email != $request->email && $request->email) {
                $user_change_mail = User::where('email', $request->email)->first();
                if ($user_change_mail) {
                    return back()->with('Failed', 'Email đã tồn tại');
                }
                $user->email = $request->email;
            }
            if ($request->password != null && strlen($request->password) > 0) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Lưu bảng partner
            $partner = Profile::findOrFail($id);
            $partner->exp = $request->exp;
            $partner->price = $request->price;
            $partner->gender = $request->gender;
            $partner->address = $request->address;
            $partner->description = $request->description;
            $partner->birth = $request->birth;
            $partner->phone = $request->phone;
            $partner->gender_status = 0;
            $partner->exp_status = 0;
            $partner->address_status = 0;
            $partner->description_status = 0;
            $partner->money_status = 0;
            $partner->email_status = 0;
            $partner->birth_status = 0;
            $partner->phone_status = 0;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                if ($partner->img != null) {
                    File::delete($partner->img);
                }
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnUser')) {
                    File::makeDirectory('storage/app/AvnUser', 0777, true, true);
                }
                $image->storeAs('AvnUser', $filename);
                $path = 'storage/app/AvnUser/' . $filename;
                $partner->img = $path;
            }
            $partner->save();
            return redirect()->route('list-partner')->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }
    public function updateMoneyPartner(Request $request, $id)
    {
        try {
            $partner = Profile::findOrFail($id);
            if ($request->add) {
                $partner->money += $request->add;
            } else {
                $partner->money -= $request->sub;
            }
            $partner->save();
            $addsub = new AddSubMoney();
            $addsub->user_id = $partner->id;
            $addsub->add = $request->add;
            $addsub->sub = $request->sub;
            $addsub->note = $request->note;
            $addsub->surplus = $partner->money;
            $addsub->save();

            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }
    public function deletePartner($id)
    {
        try {
            $user = User::findOrFail($id)->delete();
            $partner = Profile::findOrFail($id);
            if ($partner->img != null) {
                File::delete($partner->img);
            }
            $partner->delete();
            return back()->with('Success', 'Xóa thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Xóa thất bại');
        }
    }
}