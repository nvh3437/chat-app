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
use App\Http\Controllers\NotificationController;

class NewFeedController extends Controller
{
    public function newFeed()
    {
        $user = Auth::user();
        $title = 'NewFeed';
        $newsfeed = NewFeed::where('status', 0)->orderBy('updated_at', 'DESC')->get();
        return view('avnnewfeed::new-feed', compact('user', 'title', 'newsfeed'));
    }

    public function myFeed()
    {
        $user = Auth::user();
        $title = 'Bài đăng của tôi';
        $newsfeed = NewFeed::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->get();
        return view('avnnewfeed::new-feed', compact('user', 'title', 'newsfeed'));
    }

    public function loadCommentFeed(Request $request)
    {
        $user = Auth::user();
        $currentRouteName = $request->currentRouteName ?? '';
        $comments = NewFeedComment::where('feed_id', $request->feed_id)->orderBy('updated_at', 'DESC')->skip($request->comment_count)->take(1)->get();

        foreach ($comments as $index => $child):
            echo '<div class="d-flex item" comment-id="' . $child->id . '">';
            if ($child->new_feed_comment_user->profile && $child->new_feed_comment_user->profile->img):
                echo '<img class="me-2 rounded" src="' . asset($child->new_feed_comment_user->profile->img ?? '/resources/assets/images/logo.png') . '" style="height: 32px; width: 32px; object-fit: cover;">';
            else:
                echo '<img class="me-2 rounded" src="' . asset('/resources/assets/images/logo.png') . '" style="height: 32px; width: 32px; object-fit: cover;">';
            endif;
            echo '<div>
                            <h5 class="m-0">' . $child->new_feed_comment_user->name . '</h5>
                            <p class="text-muted mb-0">
                                <small>' . NotificationController::timeAgo($child->updated_at) . '</small>
                            </p>
                            <p class="comment-text text-dark mb-2">' . $child->comment . '</p>
                            <!--- Người bình luận đc sửa --->';
            if ($user->id == $child->user_id):
                echo '<div>
                            <a href="javascript: void(0);"
                                class="edit-comment btn btn-sm btn-link text-muted p-0">
                                <i class="mdi mdi-pencil"></i> Sửa
                            </a>
                            <a href="javascript: void(0);" 
                                class="delete-comment btn btn-sm btn-link text-muted p-0 ps-2">
                                <i class="mdi mdi-delete"></i> Xóa
                            </a>
                        </div>';
            elseif ($currentRouteName == 'new-feed' && $user->type == 'system'):
                echo '<!---- Quản lý được xóa --->;
                        <div>
                            <a href="javascript: void(0);" 
                                class="delete-comment btn btn-sm btn-link text-muted p-0">
                                <i class="mdi mdi-delete"></i> Xóa
                            </a>
                        </div>';
            endif;
            echo '</div>
            </div>
            <hr />';
            // if ($index == 1):
            //     if (count($item->new_feed_comments) - 1 > $index):
            //         echo '<hr />
            //         <a href="javascript: void(0);" class="loadmore-cm btn btn-sm btn-link text-muted ps-0" comment-count="'.$index.'" feed-id="'.$item->id.'">Xem thêm bình luận</a>';
            //     endif;
            //     break;
            // endif;
        endforeach;
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
        $user = Auth::user();
        $title = 'Sửa bài';
        $edit_feed = NewFeed::where('alias', $alias)->first();
        if (!$edit_feed) {
            $edit_feed = Store::findOrFail($alias);
        }
        return view('avnnewfeed::new-feed', compact('user', 'title', 'edit_feed'));
    }

    public function updateFeed(NewFeedRequest $request, $id)
    {
        try {
            $new_feed = NewFeed::where([
                'id' => $id,
                'user_id' => Auth::user()->id
            ])->first();
            $new_feed->description = $request->description;
            $new_feed->alias = Str::random(10);
            $new_feed->status = $request->status ?? 0;
            $new_feed->save();
            return redirect()->route('new-feed')->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }

    public function deleteFeed($id)
    {
        try {
            if (Auth::user()->type == 'system') {
                NewFeed::destroy($id);
            } else {
                $new_feed = NewFeed::where([
                    'id' => $id,
                    'user_id' => Auth::user()->id
                ])->first()->delete();
            }
            return back()->with('Success', 'Xóa thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Xóa thất bại');
        }
    }
}