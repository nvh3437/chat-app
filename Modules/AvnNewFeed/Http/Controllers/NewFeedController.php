<?php

namespace Modules\AvnNewFeed\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnNewFeed\Entities\NewFeed;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\AvnNewFeed\Http\Requests\NewFeedRequest;
use Modules\AvnNewFeed\Entities\NewFeedComment;

class NewFeedController extends Controller
{
    public function newFeed()
    {
        $new_feeds = NewFeed::where('status', 0)->orderBy('updated_at', 'DESC')->get();
        return view('avnnewfeed::new-feed', compact('new_feeds'));
    }

    public function myFeed()
    {
        $user = Auth::user();
        $my_feeds = NewFeed::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->get();
        return view('avnnewfeed::my-feed', compact('my_feeds'));
    }

    public function storeFeed(NewFeedRequest $request)
    {
        try {
            $new_feed = new NewFeed();
            $new_feed->description = $request->description;
            $new_feed->alias = Str::random(10);
            $new_feed->status = $request->status ?? 0;
            $new_feed->user_id = Auth::user()->id;
            $new_feed->save();
            return back()->with('Success', 'Đăng bài thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Đăng bài thất bại');
        }
    }

    public function editFeed($alias)
    {
        $new_feed = NewFeed::where('alias', $alias)->first();
        if (!$new_feed) {
            $new_feed = Store::findOrFail($alias);
        }
        return view('avnnewfeed::edit-feed', compact('new_feed'));
    }

    public function updateFeed(NewFeedRequest $request, $id)
    {
        try {
            $new_feed = NewFeed::findOrFail($id);
            $new_feed->description = $request->description;
            $new_feed->alias = Str::random(10);
            $new_feed->status = $request->status ?? 0;
            $new_feed->user_id = Auth::user()->id;
            $new_feed->save();
            return redirect()->route('new-feed')->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deleteFeed($id)
    {
        try{
            $new_feed = NewFeed::findOrFail($id)->delete();
            return back()->with('Success', 'Xóa thành công');
        }
        catch(Exception $e){
            return back()->with('Failed', 'Xóa thất bại');
        }
    }
}
