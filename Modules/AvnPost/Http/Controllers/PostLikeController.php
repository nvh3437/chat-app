<?php

namespace Modules\AvnPost\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnPost\Entities\PostLike;
use Modules\AvnPost\Entities\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    public function storePostLike(Request $request)
    {
        try {
            $like = new PostLike();
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
            return back();
        } catch (Exception $e) {
            return back();
        }
    }

    public function deletePostLike(Request $request, $id)
    {
        try {
            $like = PostLike::findOrFail($id)->delete();
            return back();
        } catch (Exception $e) {
            return back();
        }
    }

}
