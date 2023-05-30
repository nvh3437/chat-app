@php
    use App\Http\Controllers\NotificationController;
@endphp
<div class="d-flex item" comment-id="{{ $child->id }}">
    <img class="me-2 rounded"
        src="{{ asset($child->new_feed_comment_user->profile->img ?? config('constants.default_avatar')) }}"
        style="height: 32px; width: 32px; object-fit: cover;">
    <div>
        <h5 class="m-0">
            {{ $child->new_feed_comment_user->name }}
            <!--- Người bình luận đc sửa --->
            @if ($user->id == $child->user_id)
                <div class="dropdown float-end ms-1">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                        aria-expanded="true">
                        <i class="mdi mdi-dots-horizontal"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a href="javascript: void(0);" class="dropdown-item edit-comment">
                            <i class='mdi mdi-pencil'></i> Sửa
                        </a>
                        <a href="javascript: void(0);" class="dropdown-item delete-comment ">
                            <i class='mdi mdi-delete'></i> Xóa
                        </a>
                    </div>
                </div>
            @elseif(Route::currentRouteName() == 'new-feed' && $user->type == 'system')
                <!---- Quản lý được xóa --->
                <div class="dropdown float-end ms-1">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                        aria-expanded="true">
                        <i class="mdi mdi-dots-horizontal"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a href="javascript: void(0);" class="dropdown-item delete-comment">
                            <i class='mdi mdi-delete'></i> Xóa
                        </a>
                    </div>
                </div>
            @endif
        </h5>
        <p class="text-muted mb-0">
            <small>{{ NotificationController::timeAgo($child->updated_at) }}</small>
        </p>
        <p class="comment-text text-dark mb-2">
            {!! $child->comment !!}
        </p>
    </div>
</div>
