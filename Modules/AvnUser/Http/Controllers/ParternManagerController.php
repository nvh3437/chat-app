<?php

namespace Modules\AvnUser\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnUser\Entities\Partern;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Modules\AvnUser\Http\Requests\StoreParternRequest;
use Modules\AvnUser\Http\Requests\UpdateParternRequest;

class ParternManagerController extends Controller
{
    public function listPartern()
    {
        $parterns = Partern::get();
        return view('avnuser::manager.list-partern', compact('parterns'));
    }

    public function addPartern()
    {
        return view('avnuser::manager.add-partern');
    }

    public function storePartern(StoreParternRequest $request)
    {
        try {
            // Lưu bảng user 
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->type = 'partern';
            $user->password = Hash::make($request->password);
            $user->save();

            // Lưu bảng partern
            $partern = new Partern();
            $partern->id = $user->id;
            $partern->name = $request->name;
            $partern->exp = $request->exp;
            $partern->gender = $request->gender;
            $partern->address = $request->address;
            $partern->description = $request->description;
            $partern->birth = $request->birth;
            $partern->phone = $request->phone;
            $partern->money = 0;
            $partern->gender_status = 0;
            $partern->exp_status = 0;
            $partern->address_status = 0;
            $partern->description_status = 0;
            $partern->money_status = 0;
            $partern->email_status = 0;
            $partern->birth_status = 0;
            $partern->phone_status = 0;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnUser')) {
                    File::makeDirectory('storage/app/AvnUser', 0777, true, true);
                }
                $image->storeAs('AvnUser', $filename);
                $path = 'storage/app/AvnUser/' . $filename;
                $partern->img = $path;
            }
            $partern->save();
            return redirect()->route('list-partern')->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Thêm thất bại');
        }
    }

    public function editPartern($id)
    {
        $partern = Partern::findOrFail($id);
        $user = User::findOrFail($id);
        return view('avnuser::manager.edit-partern', compact('partern', 'user'));
    }

    public function updatePartern(UpdateParternRequest $request, $id)
    {
        try {
            // Lưu bảng user 
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password != null && strlen($request->password) > 0) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Lưu bảng partern
            $partern = Partern::findOrFail($id);
            $partern->name = $request->name;
            $partern->exp = $request->exp;
            $partern->gender = $request->gender;
            $partern->address = $request->address;
            $partern->description = $request->description;
            $partern->birth = $request->birth;
            $partern->phone = $request->phone;
            $partern->money = 0;
            $partern->gender_status = 0;
            $partern->exp_status = 0;
            $partern->address_status = 0;
            $partern->description_status = 0;
            $partern->money_status = 0;
            $partern->email_status = 0;
            $partern->birth_status = 0;
            $partern->phone_status = 0;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                if ($partern->img != null) {
                    File::delete($partern->img);
                }
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnUser')) {
                    File::makeDirectory('storage/app/AvnUser', 0777, true, true);
                }
                $image->storeAs('AvnUser', $filename);
                $path = 'storage/app/AvnUser/' . $filename;
                $partern->img = $path;
            }
            $partern->save();
            return redirect()->route('list-partern')->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deletePartern($id)
    {
        try{    
            $user = User::findOrFail($id)->delete();
            $partern = Partern::findOrFail($id);
            if ($partern->img != null) {
                File::delete($partern->img);
            }
            $partern->delete();
            return back()->with('Success', 'Xóa thành công');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }
}
