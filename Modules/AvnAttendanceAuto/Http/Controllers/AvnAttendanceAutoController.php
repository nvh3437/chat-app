<?php

namespace Modules\AvnAttendanceAuto\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnAttendanceAuto\Entities\AttendanceAutoData;

class AvnAttendanceAutoController extends Controller
{
    public function index()
    {
        return view('avnattendanceauto::index');
    }
    public function handleTimekeeping(Request $request)
    {
        $request_data = $request->all();
        $request_headers = $request->headers->all();
        $request_headers['other'] = [
            'ip' => $request->ip(),
            'userAgent' => $request->userAgent(),
            'preferredLanguage' => $request->getPreferredLanguage(),
            'httpMethod' => $request->method(),
            'host' => $request->getHost()

        ];
        $data = new AttendanceAutoData();
        $data->header = json_encode($request_headers);
        $data->value = json_encode($request_data);
        $data->save();
        return response()->json(['message' => 'Request data has been saved successfully']);
    }
}
