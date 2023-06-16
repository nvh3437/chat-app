<?php

namespace Modules\AvnPost\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnPost\Entities\PostCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Lang;

class PostCatgoryController extends Controller
{
    public function listCategory()
    {
        $categories = PostCategory::get();
        return view('avnpost::category.list-category', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        try {
            $category = new PostCategory();
            $category->name = $request->name;
            if ($request->multi_lang) {
                $category->ja = $request->group_name[0];
                $category->vi = $request->group_name[1];
                $category->en = $request->group_name[2];
            }
            $category->description = $request->description;
            if ($request->multi_lang) {
                $category->description_ja = $request->description_ja;
                $category->description_vi = $request->description_vi;
                $category->description_en = $request->description_en;
            }
            $category->keywords = $request->keywords;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnPost')) {
                    File::makeDirectory('storage/app/AvnPost', 0777, true, true);
                }
                $image->storeAs('AvnPost', $filename);
                $path = 'storage/app/AvnPost/' . $filename;
                $category->img = $path;
            }
            $category->alias = Helper::createSlug(trim($request->multi_lang ? $category->en : $request->name));
            if (count(PostCategory::where('alias', $category->alias)->get()) > 0) {
                $category->alias = Helper::createSlug(trim($category->alias . ' ' . rand()));
            }
            $category->save();
            return back()->with('Success', Lang::get('settings.Add.Add_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Add.Add_failed'));
        }
    }

    public function updateCategory(Request $request, $id)
    {
        try {
            $category = PostCategory::findOrFail($id);
            $category->name = $request->name;
            if ($request->multi_lang) {
                $category->ja = $request->group_name[0];
                $category->vi = $request->group_name[1];
                $category->en = $request->group_name[2];
            } else {
                $category->ja = null;
                $category->vi = null;
                $category->en = null;
            }
            $category->description = $request->description;
            if ($request->multi_lang) {
                $category->description_ja = $request->description_ja;
                $category->description_vi = $request->description_vi;
                $category->description_en = $request->description_en;
            } else {
                $category->description_ja = null;
                $category->description_vi = null;
                $category->description_en = null;
            }
            $category->keywords = $request->keywords;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                if ($category->img != null) {
                    File::delete($category->img);
                }
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnPost')) {
                    File::makeDirectory('storage/app/AvnPost', 0777, true, true);
                }
                $image->storeAs('AvnPost', $filename);
                $path = 'storage/app/AvnPost/' . $filename;
                $category->img = $path;
            }
            $alias = Helper::createSlug($request->multi_lang ? $category->en : $request->name);
            if ($category->alias != $alias) {
                if (count(PostCategory::where('alias', '==', $alias)->get()) > 0) {
                    $category->alias = Helper::createSlug($alias . ' ' . rand());
                } else
                    $category->alias = $alias;
            }
            $category->save();
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category = PostCategory::findOrFail($id);
            if ($category->img != null) {
                File::delete($category->img);
            }
            $category->delete();
            return back()->with('Success', Lang::get('settings.Delete.Delete_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Delete.Delete_failed'));
        }
    }
}