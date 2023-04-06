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

class ParternController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('avnuser::partern.profile', compact('user'));
    }

    public function updateParternProfile(Request $request, $id)
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
            $partern->gender_status = $request->gender_status ?? 0;
            $partern->exp_status = $request->exp_status ?? 0;
            $partern->address_status = $request->address_status ?? 0;
            $partern->description_status = $request->description_status ?? 0;
            $partern->email_status = $request->email_status ?? 0;
            $partern->birth_status = $request->birth_status ?? 0;
            $partern->phone_status = $request->phone_status ?? 0;
            $partern->money_status = 0;
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
            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }
}
