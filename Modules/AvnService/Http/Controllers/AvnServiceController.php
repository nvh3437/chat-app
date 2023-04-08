<?php

namespace Modules\AvnService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnService\Entities\ServiceType;
use Modules\AvnService\Entities\Service;

class AvnServiceController extends Controller
{
    //-------------------- Trang chủ --------------------//
    public static function getService()
    {
        $services = Service::orderByDesc('updated_at')->limit(3)->get();
        return $services;
    }
    //-------------------- Quản lý ----------------------//
    public function listService()
    {
        $services = Service::get();
        return view('avnservice::service.list-service', compact('services'));
    }

    public function addService()
    {
        $types = ServiceType::get();
        return view('avnservice::service.add-service', compact('types'));
    }

    public function storeService(Request $request)
    {
        try {
            $service = new Service();
            $service->name = $request->name;
            $service->price = $request->price;
            $service->description = $request->description;
            $service->recommended = $request->recommended ?? 0;
            $service->type_id = $request->type_id;
            $service->save();
            return redirect()->route('list-service')->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Thêm thất bại');
        }
    }

    public function editService($id)
    {
        $service = Service::findOrFail($id);
        $types = ServiceType::get();
        return view('avnservice::service.edit-service', compact('service', 'types'));
    }

    public function updateService(Request $request, $id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->name = $request->name;
            $service->price = $request->price;
            $service->description = $request->description;
            $service->recommended = $request->recommended ?? 0;
            $service->type_id = $request->type_id;
            $service->save();
            return redirect()->route('list-service')->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deleteService($id)
    {
        try{
            $service = Service::findOrFail($id)->delete();
            return back()->with('Success', 'Xóa thất bại');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }

    //-------------------- Trang chủ ----------------------//
    public function servicePage()
    {
        $services = Service::get();
        return view('avnservice::service.service-page', compact('services'));
    }
}
