<?php

namespace Modules\AvnUser\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnUser\Entities\Profile;
use Modules\AvnUser\Entities\AddSubMoney;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Modules\AvnUser\Http\Requests\StoreProfileRequest;
use Modules\AvnUser\Http\Requests\UpdateProfileRequest;
use Modules\AvnChat\Entities\ChatRoomUser;
use Illuminate\Database\Eloquent\Builder;
use Lang;

class CustomerManagerController extends Controller
{
    public function listCustomer()
    {
        $customers = Profile::whereHas('user', function (Builder $query) {
            $query->where('type', 'customer');
        })->orderByDesc('updated_at')->get();
        return view('avnuser::manager.list-customer', compact('customers'));
    }

    public function addCustomer()
    {
        return view('avnuser::manager.add-customer');
    }

    public function storeCustomer(StoreProfileRequest $request)
    {
        try {
            // Lưu bảng user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->type = 'customer';
            $user->password = Hash::make($request->password);
            $user->save();

            $global_chat_room_user = new ChatRoomUser();
            $global_chat_room_user->user_id = $user->id;
            $global_chat_room_user->room_id = 1;
            $global_chat_room_user->save();
            // Lưu bảng customer
            $customer = new Profile();
            $customer->id = $user->id;
            $customer->gender = $request->gender;
            $customer->address = $request->address;
            $customer->description = $request->description;
            $customer->birth = $request->birth;
            $customer->phone = $request->phone;
            $customer->money = 0;
            $customer->gender_status = 0;
            $customer->address_status = 0;
            $customer->description_status = 0;
            $customer->money_status = 0;
            $customer->email_status = 0;
            $customer->birth_status = 0;
            $customer->phone_status = 0;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnUser')) {
                    File::makeDirectory('storage/app/AvnUser', 0777, true, true);
                }
                $image->storeAs('AvnUser', $filename);
                $path = 'storage/app/AvnUser/' . $filename;
                $customer->img = $path;
            }
            $customer->save();
            return redirect()->route('list-customer')->with('Success', Lang::get('settings.Add.Add_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Add.Add_failed'));
        }
    }

    public function editCustomer($id)
    {
        $customer = Profile::findOrFail($id);
        $user = User::findOrFail($id);
        return view('avnuser::manager.edit-customer', compact('customer', 'user'));
    }

    public function updateCustomer(UpdateProfileRequest $request, $id)
    {
        try {
            // Lưu bảng user
            $user = User::findOrFail($id);
            $user->name = $request->name;
            if ($user->email != $request->email && $request->email) {
                $user_change_mail = User::where('email', $request->email)->first();
                if ($user_change_mail) {
                    return back()->with('Failed', Lang::get('settings.Auth.Validate.email.Unique'));
                }
                $user->email = $request->email;
            }
            if ($request->password != null && strlen($request->password) > 0) {
                $user->password = Hash::make($request->password);
            }
            $user->status = $request->status;
            $user->save();

            // Lưu bảng customer
            $customer = Profile::findOrFail($id);
            $customer->gender = $request->gender;
            $customer->address = $request->address;
            $customer->description = $request->description;
            $customer->birth = $request->birth;
            $customer->phone = $request->phone;
            $customer->money = 0;
            $customer->gender_status = 0;
            $customer->address_status = 0;
            $customer->description_status = 0;
            $customer->money_status = 0;
            $customer->email_status = 0;
            $customer->birth_status = 0;
            $customer->phone_status = 0;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                if ($customer->img != null) {
                    File::delete($customer->img);
                }
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnUser')) {
                    File::makeDirectory('storage/app/AvnUser', 0777, true, true);
                }
                $image->storeAs('AvnUser', $filename);
                $path = 'storage/app/AvnUser/' . $filename;
                $customer->img = $path;
            }
            $customer->save();
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }
    public function updateMoneyCustomer(Request $request, $id)
    {
        try {
            $customer = Profile::findOrFail($id);
            if ($request->add) {
                $customer->money = floatval($customer->money) + floatval(str_replace(",", "", $request->add));
            } else {
                $customer->money = floatval($customer->money) - floatval(str_replace(",", "", $request->sub));
            }
            $customer->save();
            $addsub = new AddSubMoney();
            $addsub->user_id = $customer->id;
            $addsub->add = floatval(str_replace(",", "", $request->add));
            $addsub->sub = floatval(str_replace(",", "", $request->sub));
            $addsub->note = $request->note;
            $addsub->surplus = $customer->money;
            $addsub->save();

            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }
    public function deleteCustomer($id)
    {
        try {
            $user = User::findOrFail($id)->delete();
            $customer = Profile::findOrFail($id);
            if ($customer->img != null) {
                File::delete($customer->img);
            }
            $customer->delete();
            return back()->with('Success', Lang::get('settings.Delete.Delete_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Delete.Delete_failed'));
        }
    }
}
