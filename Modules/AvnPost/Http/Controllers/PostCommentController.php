<?php

namespace Modules\AvnPost\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnPost\Entities\PostComment;
use Modules\AvnPost\Entities\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostCommentController extends Controller
{
    public function storePostComment(Request $request)
    {
        try {
            $comment = new PostComment();
            $comment->comment = $request->comment;
            $comment->user_id = Auth::user()->id;
            $comment->post_id = $request->post_id;
            $comment->save();
            return back()->with('Success', 'Bình luận thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Bình luận thất bại');
        }
    }

    public function updatePostComment(Request $request, $id)
    {
        try {
            $comment = PostComment::where('user_id', Auth::user()->id)->findOrFail($id);
            $comment->comment = $request->comment;
            $comment->post_id = $request->post_id;
            $comment->save();
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    public function deletePostComment($id)
    {
        try {
            $comment = PostComment::where('user_id', Auth::user()->id)->findOrFail($id);
            return back()->with('Success', Lang::get('settings.Delete.Delete_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Delete.Delete_failed'));
        }
    }
}
