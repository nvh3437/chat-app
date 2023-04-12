<?php

namespace Modules\AvnService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnService\Entities\ServiceType;
use Modules\AvnService\Entities\Service;
use App\Models\GeneralSettings;
use Modules\AvnService\Http\Requests\ServiceRequest;

class AvnServiceController extends Controller
{
    //-------------------- Trang chủ --------------------//
    public static function getService()
    {
        $services = Service::orderByDesc('recommended', 1)->limit(4)->get();
        return $services;
    }
    //-------------------- Quản lý ----------------------//
    public function listService()
    {
        $services = Service::orderByDesc('updated_at')->get();
        return view('avnservice::service.list-service', compact('services'));
    }

    public function addService()
    {
        $types = ServiceType::get();
        return view('avnservice::service.add-service', compact('types'));
    }

    public function storeService(ServiceRequest $request)
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

    public function updateService(ServiceRequest $request, $id)
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

    //-------------------- Trang dịch vụ ----------------------//
    public function servicePage()
    {
        $services = Service::orderByDesc('recommended', 1)->get();
        $service_seo = GeneralSettings::whereIn('key', [
            'service_seo_title',
            'service_seo_description',
            'service_seo_keywords',
            'service_seo_image'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avnservice::service.service-page', compact('services', 'service_seo'));
    }
}
