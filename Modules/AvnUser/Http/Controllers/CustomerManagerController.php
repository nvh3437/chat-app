<?php

namespace Modules\AvnUser\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnUser\Entities\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Modules\AvnUser\Http\Requests\StoreCustomerRequest;
use Modules\AvnUser\Http\Requests\UpdateCustomerRequest;

class CustomerManagerController extends Controller
{
    public function listCustomer()
    {
        $customers = Customer::get();
        return view('avnuser::manager.list-customer', compact('customers'));
    }

    public function addCustomer()
    {
        return view('avnuser::manager.add-customer');
    }

    public function storeCustomer(StoreCustomerRequest $request)
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

            // Lưu bảng customer
            $customer = new Customer();
            $customer->id = $user->id;
            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->address = $request->address;
            $customer->description = $request->description;
            $customer->money = 0;
            $customer->gender_status = 0;
            $customer->address_status = 0;
            $customer->description_status = 0;
            $customer->money_status = 0;
            $customer->email_status = 0;
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
            return redirect()->route('list-customer')->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Thêm thất bại');
        }
    }

    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $user = User::findOrFail($id);
        return view('avnuser::manager.edit-customer', compact('customer', 'user'));
    }

    public function updateCustomer(UpdateCustomerRequest $request, $id)
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

            // Lưu bảng customer
            $customer = Customer::findOrFail($id);
            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->address = $request->address;
            $customer->description = $request->description;
            $customer->money = 0;
            $customer->gender_status = 0;
            $customer->address_status = 0;
            $customer->description_status = 0;
            $customer->money_status = 0;
            $customer->email_status = 0;
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
            return redirect()->route('list-customer')->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deleteCustomer($id)
    {
        try{    
            $user = User::findOrFail($id)->delete();
            $customer = Customer::findOrFail($id);
            if ($customer->img != null) {
                File::delete($customer->img);
            }
            $customer->delete();
            return back()->with('Success', 'Xóa thành công');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }
}
