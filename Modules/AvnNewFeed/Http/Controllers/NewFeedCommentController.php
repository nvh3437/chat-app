<?php

namespace Modules\AvnNewFeed\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnNewFeed\Entities\NewFeedComment;
use Modules\AvnNewFeed\Entities\NewFeed;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\AvnNewFeed\Http\Requests\NewFeedCommentRequest;
use Lang;
class NewFeedCommentController extends Controller
{
    public function storeCommentFeed(NewFeedCommentRequest $request)
    {
        try {
            $comment = new NewFeedComment();
            $comment->comment = $request->comment;
            $comment->feed_id = $request->feed_id;
            $comment->user_id = Auth::user()->id;
            $comment->save();
            return back()->with('Success', Lang::get('settings.success', ['name' => Lang::get('settings.Comment')]));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.failed', ['name' => Lang::get('settings.Comment')]));
        }
    }

    public function updateCommentFeed(NewFeedCommentRequest $request, $id)
    {
        try {
            $comment = NewFeedComment::where([
                'id' => $id,
                'feed_id' => $request->feed_id,
                'user_id' => Auth::user()->id
            ])->first();
            $comment->comment = $request->comment;
            $comment->save();
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    public function deleteCommentFeed($id)
    {
        try {
            $comment = NewFeedComment::where([
                'id' => $id,
                'user_id' => Auth::user()->id
            ])->first()->delete();
            return back()->with('Success', Lang::get('settings.Delete.Delete_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Delete.Delete_failed'));
        }
    }
}
