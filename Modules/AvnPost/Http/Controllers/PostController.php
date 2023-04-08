<?php

namespace Modules\AvnPost\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnPost\Entities\PostCategory;
use Modules\AvnPost\Entities\Post;
use Modules\AvnPost\Entities\PostComment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //------------------------------------ Quản lý -------------------------------//
    public function listPost()
    {
        $posts = Post::get();
        return view('avnpost::post.list-post', compact('posts'));
    }

    public function addPost()
    {
        $categories = PostCategory::get();
        return view('avnpost::post.add-post', compact('categories'));
    }

    public function storePost(Request $request)
    {
        try {
            $post = new Post();
            $post->name = $request->name;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnPost')) {
                    File::makeDirectory('storage/app/AvnPost', 0777, true, true);
                }
                $image->storeAs('AvnPost', $filename);
                $path = 'storage/app/AvnPost/' . $filename;
                $post->img = $path;
            }
            $post->description = $request->description;
            $post->category_id = $request->category_id;
            $post->created_by = Auth::user()->id;
            $post->updated_by = Auth::user()->id;
            $post->alias = Helper::createSlug(trim($post->name));
            if (count(Post::where('alias', $post->alias)->get()) > 0) {
                $post->alias = Helper::createSlug(trim($post->alias . ' ' . rand()));
            }
            $post->save();
            return redirect()->route('list-post')->with('Success', 'Thêm thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Thêm thất bại');
        }
    }

    public function editPost($id)
    {
        $post = Post::findOrFail($id);
        $categories = PostCategory::get();
        return view('avnpost::post.edit-post', compact('post', 'categories'));
    }

    public function updatePost(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->name = $request->name;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                if ($post->img != null) {
                    File::delete($post->img);
                }
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnPost')) {
                    File::makeDirectory('storage/app/AvnPost', 0777, true, true);
                }
                $image->storeAs('AvnPost', $filename);
                $path = 'storage/app/AvnPost/' . $filename;
                $post->img = $path;
            }
            $post->description = $request->description;
            $post->category_id = $request->category_id;
            $post->created_by = $post->created_by;
            $post->updated_by = Auth::user()->id;
            $alias = Helper::createSlug($request->name);
            if ($post->alias != $alias) {
                if (count(Post::where('alias', '==', $alias)->get()) > 0) {
                    $post->alias = Helper::createSlug($alias . ' ' . rand());
                } else
                    $post->alias = $alias;
            }
            $post->save();
            return redirect()->route('list-post')->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deletePost($id)
    {
        try{
            $post = Post::findOrFail($id);
            if ($post->img != null) {
                File::delete($post->img);
            }
            $post->delete();
            return back()->with('Success', 'Xóa thành công');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }

    //------------------------------------ Trang chủ -------------------------------//
    public function postPage()
    {
        $posts = Post::orderByDesc('updated_at')->limit(15)->get();
        $categories = PostCategory::get();
        return view('avnpost::post.post-page', compact('posts', 'categories'));
    }

    public function postOfCategory($alias)
    {
        $category = PostCategory::where('alias', $alias)->first();
        if (!$category) {
            $category = PostCategory::findOrFail($alias);
        }
        $posts = Post::where('category_id', $category->id)->orderByDesc('updated_at')->limit(15)->get();
        $categories = PostCategory::get();
        return view('avnpost::post.post-of-category', compact('category', 'posts', 'categories'));
    }

    public function viewPost($alias)
    {
        $post = Post::where('alias', $alias)->first();
        if (!$post) {
            $post = Post::findOrFail($alias);
        }
        $comments = PostComment::where('post_id', $post->id)->get();
        return view('avnpost::post.view-post', compact('post', 'comments'));
    }
}
