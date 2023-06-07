@php
    use App\Http\Controllers\NotificationController;
@endphp
@foreach ($comments as $comment)
    <div class="d-flex item" comment-id="{{ $comment->id }}">
        <img class="me-2 rounded"
            src="{{ asset($comment->new_feed_comment_user->profile->img ?? config('constants.default_avatar')) }}"
            style="height: 32px; width: 32px; object-fit: cover;">
        <div>
            <h5 class="m-0">
                {{ $comment->new_feed_comment_user->name }}
                <!--- Người bình luận đc sửa --->
                @if ($user->id == $comment->user_id)
                    <div class="dropdown float-end ms-1">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="true">
                            <i class="mdi mdi-dots-horizontal"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="javascript: void(0);" class="dropdown-item edit-comment">
                                <i class='mdi mdi-pencil'></i> @lang('settings.Update.update')
                            </a>
                            <a href="javascript: void(0);" class="dropdown-item delete-comment ">
                                <i class='mdi mdi-delete'></i> @lang('settings.Delete.delete')
                            </a>
                        </div>
                    </div>
                @elseif($user->type == 'system')
                    <!---- Quản lý được xóa --->
                    <div class="dropdown float-end ms-1">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="true">
                            <i class="mdi mdi-dots-horizontal"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="javascript: void(0);" class="dropdown-item delete-comment">
                                <i class='mdi mdi-delete'></i> @lang('settings.Delete.delete')
                            </a>
                        </div>
                    </div>
                @endif
            </h5>
            <p class="text-muted mb-0">
                <small>{{ NotificationController::timeAgo($comment->updated_at) }}</small>
            </p>
            <p class="comment-text text-dark mb-2">
                {!! $comment->comment !!}
            </p>
        </div>
    </div>
@endforeach
