<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;
use App\Models\ModulesSettingsLink;

class ModuleController extends Controller
{
    public function listModule()
    {
        $modules = Module::all();
        return view('list-module',compact('modules'));
    }
    public function switchModule(Request $request)
    {
        $module = Module::findOrFail($request->name);
        if($module->isEnabled() == 0){
            $module->enable();
        }
        else{
            $module->disable();
        }
        return back();
    }

    public function modulesSettingsLink(){
        $items = ModulesSettingsLink::get();
        return view('modules-settings-link',compact('items'));
    }
}
