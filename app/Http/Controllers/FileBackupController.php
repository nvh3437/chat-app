<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileBackup;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Route;

class FileBackupController extends Controller
{
    public function listBackup()
    {
        $active_modules = Module::allEnabled();
        $active_module_names = [];
        foreach ($active_modules as $active_module) {
            array_push($active_module_names, $active_module->getName());
        }
        $backups = FileBackup::whereIn('module',$active_module_names)->orderBy('module')->get();
        return view('list-backup',compact('backups','active_module_names'));
    }
    public function confirmBackup(Request $request)
    {
        $route = FileBackup::findOrFail($request->route);
        if($request->type == 'export'){
            return redirect()->route($route->route_name_export);
        }
    }
}
