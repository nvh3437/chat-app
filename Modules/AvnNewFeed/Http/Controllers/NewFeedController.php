<?php

namespace Modules\AvnNewFeed\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnNewFeed\Entities\NewFeed;
use Modules\AvnNewFeed\Entities\NewFeedImage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\AvnNewFeed\Http\Requests\NewFeedRequest;
use Modules\AvnNewFeed\Entities\NewFeedComment;
use App\Http\Controllers\NotificationController;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Lang;

class NewFeedController extends Controller
{
    public function newFeed()
    {
        $user = Auth::user();
        $newsfeed = NewFeed::where('status', 0)->orWhere('user_id', $user->id)->orderBy('updated_at', 'DESC')->paginate(10);
        return view('avnnewfeed::new-feed', compact('user', 'newsfeed'));
    }
    public function loadNewFeed()
    {
        $user = Auth::user();
        $newsfeed = NewFeed::where('status', 0)->orWhere('user_id', $user->id)->orderBy('updated_at', 'DESC')->paginate(10, ['*'], 'newfeed_paginate');
        return view('avnnewfeed::components.newfeed', compact('user', 'newsfeed'));
    }

    public function myFeed()
    {
        $user = Auth::user();
        $newsfeed = NewFeed::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->get();
        return view('avnnewfeed::new-feed', compact('user', 'newsfeed'));
    }

    public function loadCommentFeed(Request $request)
    {
        $user = Auth::user();
        $comments = NewFeedComment::where('feed_id', $request->feed_id)
            ->whereHas('feed', function (Builder $query) use ($user) {
                $query->where('status', 0)->orWhere('user_id', $user->id);
            })
            ->orderBy('updated_at', 'DESC')
            ->paginate(10, ['*'], 'comment_paginate');
        return view('avnnewfeed::components.comments', compact('user', 'comments'));
    }

    public function storeFeed(Request $request)
    {
        try {
            $new_feed = new NewFeed();
            $new_feed->description = $request->description ?? '';
            $new_feed->alias = Str::random(15);
            $new_feed->status = $request->status ?? 0;
            $new_feed->user_id = Auth::user()->id;
            $new_feed->save();
            if ($request->images && count($request->images)) {
                if (!file_exists('storage/app/AvnNewFeed')) {
                    File::makeDirectory('storage/app/AvnNewFeed', 0777, true, true);
                }
                foreach ($request->images as $image) {
                    if ($image->isValid()) {
                        try {
                            $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                            $image_resize = Image::make($image->getRealPath());
                            $image_resize->resize(1500, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            $path = "storage/app/AvnNewFeed/" . $filename;
                            if (!file_exists('storage/app/AvnNewFeed')) {
                                File::makeDirectory('storage/app/AvnNewFeed', 0777, true, true);
                            }
                            $image_resize->save($path);

                            $feed_image = new NewFeedImage();
                            $feed_image->feed_id = $new_feed->id;
                            $feed_image->image = $path;
                            $feed_image->save();
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }
            }
            return $new_feed;
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.failed', ['name' => Lang::get('settings.Add_post')]));
        }
    }

    public function editFeed($alias)
    {
        $user = Auth::user();
        $edit_feed = NewFeed::where('alias', $alias)->first();
        if (!$edit_feed) {
            abort(404);
        }
        return view('avnnewfeed::edit-feed', compact('user', 'edit_feed'));
    }

    public function updateFeed(Request $request, $id)
    {
        try {
            $new_feed = NewFeed::where(
                'user_id', Auth::user()->id
            )->findOrFail($id);
            $new_feed->description = $request->description ?? '';
            $new_feed->status = $request->status ?? 0;
            $new_feed->save();
            if ($request->remove_images && count($request->remove_images)) {
                foreach ($request->remove_images as $remove_image) {
                    $remove_image = NewFeedImage::where('feed_id', $new_feed->id)->find($remove_image);
                    if ($remove_image) {
                        File::delete($remove_image);
                        $remove_image->delete();
                    }
                }
            }
            if ($request->images && count($request->images)) {
                if (!file_exists('storage/app/AvnNewFeed')) {
                    File::makeDirectory('storage/app/AvnNewFeed', 0777, true, true);
                }
                foreach ($request->images as $image) {
                    if ($image->isValid()) {
                        try {
                            $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                            $image_resize = Image::make($image->getRealPath());
                            $image_resize->resize(1500, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            $path = "storage/app/AvnNewFeed/" . $filename;
                            if (!file_exists('storage/app/AvnNewFeed')) {
                                File::makeDirectory('storage/app/AvnNewFeed', 0777, true, true);
                            }
                            $image_resize->save($path);

                            $feed_image = new NewFeedImage();
                            $feed_image->feed_id = $new_feed->id;
                            $feed_image->image = $path;
                            $feed_image->save();
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }
            }
            return $new_feed;
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }

    public function deleteFeed($id)
    {
        try {
            if (Auth::user()->type == 'system') {
                $new_feed = NewFeed::findOrFail($id);
            } else {
                $new_feed = NewFeed::where('user_id', Auth::user()->id)->findOrFail($id);
            }
            if ($new_feed->remove_images && count($new_feed->remove_images)) {
                foreach ($new_feed->remove_images as $remove_image) {
                    $remove_image = NewFeedImage::where('feed_id', $new_feed->id)->find($remove_image);
                    if ($remove_image) {
                        File::delete($remove_image);
                        $remove_image->delete();
                    }
                }
            }
            $new_feed->delete();
            return back()->with('Success', Lang::get('settings.Delete.Delete_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Delete.Delete_failed'));
        }
    }
}