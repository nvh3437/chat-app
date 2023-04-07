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
            $category->alias = Helper::createSlug(trim($category->name));
            if (count(PostCategory::where('alias', $category->alias)->get()) > 0) {
                $category->alias = Helper::createSlug(trim($category->alias . ' ' . rand()));
            }
            $category->save();
            return back()->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Thêm thất bại');
        }
    }

    public function updateCategory(Request $request, $id)
    {
        try {
            $category = PostCategory::findOrFail($id);
            $category->name = $request->name;
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
            $alias = Helper::createSlug($request->name);
            if ($category->alias != $alias) {
                if (count(PostCategory::where('alias', '==', $alias)->get()) > 0) {
                    $category->alias = Helper::createSlug($alias . ' ' . rand());
                } else
                    $category->alias = $alias;
            }
            $category->save();
            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deleteCategory($id)
    {
        try{
            $category = PostCategory::findOrFail($id);
            if ($category->img != null) {
                File::delete($category->img);
            }
            $category->delete();
            return back()->with('Success', 'Xóa thành công');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }
}
