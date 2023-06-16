<?php

namespace Modules\AvnNewFeed\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\AvnNewFeed\Entities\NewFeedLike;

class NewFeedLikeController extends Controller
{
    public static function isLikeFeed($feed_id)
    {
        $like = NewFeedLike::where([
            'feed_id' => $feed_id,
            'user_id' => Auth::user()->id
        ])->count();
        return $like;
    }

    public function storeLikeFeed(Request $request)
    {
        $like = new NewFeedLike();
        $like->feed_id = $request->feed_id;
        $like->user_id = Auth::user()->id;
        $like->save();
        return false;
    }

    public function deleteLikeFeed(Request $request)
    {
        $like = NewFeedLike::where([
            'feed_id' => $request->feed_id,
            'user_id' => Auth::user()->id
        ])->first()->delete();
        return false;
    }
}
