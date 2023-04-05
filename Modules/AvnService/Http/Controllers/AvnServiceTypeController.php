<?php

namespace Modules\AvnService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnService\Entities\ServiceType;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AvnServiceTypeController extends Controller
{
    public function listType()
    {
        $types = ServiceType::get();
        return view('avnservice::type.list-type', compact('types'));
    }

    public function storeType(Request $request)
    {
        try {
            $type = new ServiceType();
            $type->name = $request->name;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnService')) {
                    File::makeDirectory('storage/app/AvnService', 0777, true, true);
                }
                $image->storeAs('AvnService', $filename);
                $path = 'storage/app/AvnService/' . $filename;
                $type->img = $path;
            }
            $type->save();
            return back()->with('Success', 'Tạo thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Tạo thất bại');
        }
    }

    public function updateType(Request $request, $id)
    {
        try {
            $type = ServiceType::findOrFail($id);
            $type->name = $request->name;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                if ($type->img != null) {
                    File::delete($type->img);
                }
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnService')) {
                    File::makeDirectory('storage/app/AvnService', 0777, true, true);
                }
                $image->storeAs('AvnService', $filename);
                $path = 'storage/app/AvnService/' . $filename;
                $type->img = $path;
            }
            $type->save();
            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deleteType($id)
    {
        try{
            $type = ServiceType::findOrFail($id);
            if ($type->img != null) {
                File::delete($type->img);
            }
            $type->delete();
            return back()->with('Success', 'Xóa thành công');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }
}
