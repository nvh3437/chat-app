@php
    use App\Http\Controllers\NotificationController;
    use Modules\AvnNewFeed\Http\Controllers\NewFeedLikeController;
    use Modules\AvnNewFeed\Entities\NewFeedComment;
@endphp
@foreach ($newsfeed as $item)
    @php
        $comments = NewFeedComment::where('feed_id', $item->id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(10, ['*'], 'comment_paginate');
    @endphp
    <div class="card shadow-lg feed-without-gallery">
        <div class="card-body pb-1">
            <div class="d-flex">
                <img class="me-2 rounded"
                    src="{{ asset($item->new_feed_user->profile->img ?? config('constants.default_avatar')) }}"
                    style="height: 32px; width: 32px; object-fit: cover;">
                <div class="w-100">
                    @if ($user->id == $item->user_id)
                        <div class="dropdown float-end text-muted">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                @php
                                    $params = [
                                        'alias' => $item->alias ?? $item->id,
                                    ];
                                @endphp
                                <a href="{{ route('edit-feed', $params) }}" class="dropdown-item">Chỉnh
                                    sửa</a>
                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#delete-{{ $item->id }}" class="dropdown-item">Xóa</a>
                            </div>
                        </div>
                        <!------- Quản lý thì đc phép xóa --------->
                    @elseif(Route::currentRouteName() == 'new-feed' && $user->type == 'system')
                        <div class="dropdown float-end text-muted">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#delete-{{ $item->id }}" class="dropdown-item">Xóa</a>
                            </div>
                        </div>
                    @endif

                    <h5 class="m-0">{{ $item->new_feed_user->name }}</h5>
                    <p class="text-muted">
                        <small>{{ NotificationController::timeAgo($item->updated_at) }}
                            @if ($user->id == $item->new_feed_user->id)
                                <span class="mx-1">⚬</span>
                                <span>
                                    @if ($item->status == '0')
                                        Public
                                    @else
                                        Cá nhân
                                    @endif
                                </span>
                            @endif
                        </small>
                    </p>
                </div>
            </div>
            <div class="py-3 w-100 overflow-hidden border-top border-bottom ">
                <div class="font-18 mx-1">
                    {!! $item->description !!}
                </div>
                <div class="gallery-container animated-thumbnails-gallery position-relative"
                    {{ count($item->images) > 4 ? 'data-view-more=' . count($item->images) - 4 : '' }}>
                    @foreach ($item->images as $image)
                        <a href="{{ asset($image->image) }}"
                            class="gallery-item {{ $loop->index > 3 ? 'd-none' : '' }}">
                            <img src="{{ asset($image->image) }}"
                                class="img-fluid {{ $loop->index > 3 ? 'd-none' : '' }}">
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="my-1">
                <a href="javascript: void(0);" feed-id="{{ $item->id }}"
                    class="like-btn btn btn-sm btn-link text-muted ps-0"><i
                        class='mdi mdi-thumb-up{{ NewFeedLikeController::isLikeFeed($item->id) ? '' : '-outline' }}'></i>
                    <span>{{ count($item->new_feed_likes) }}</span></a>
                <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#open-{{ $item->id }}"
                    class="btn btn-sm btn-link text-muted ps-0"><i class='uil uil-comments-alt'></i>
                    {{ $comments->total() }}</a>
            </div>
            <div class="modal fade" id="open-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark">Bài viết của
                                {{ $item->new_feed_user->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="post">
                                <div class="d-flex">
                                    <img class="me-2 rounded"
                                        src="{{ asset($item->new_feed_user->profile->img ?? config('constants.default_avatar')) }}"
                                        style="height: 32px; width: 32px; object-fit: cover;">
                                    <div class="w-100">
                                        @if ($user->id == $item->user_id)
                                            <div class="dropdown float-end text-muted">
                                                <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @php
                                                        $params = [
                                                            'alias' => $item->alias ?? $item->id,
                                                        ];
                                                    @endphp
                                                    <a href="{{ route('edit-feed', $params) }}"
                                                        class="dropdown-item">Chỉnh
                                                        sửa</a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete-{{ $item->id }}"
                                                        class="dropdown-item">Xóa</a>
                                                </div>
                                            </div>
                                            <!------- Quản lý thì đc phép xóa --------->
                                        @elseif(Route::currentRouteName() == 'new-feed' && $user->type == 'system')
                                            <div class="dropdown float-end text-muted">
                                                <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#delete-{{ $item->id }}"
                                                        class="dropdown-item">Xóa</a>
                                                </div>
                                            </div>
                                        @endif
                                        <h5 class="m-0">{{ $item->new_feed_user->name }}</h5>
                                        <p class="text-muted">
                                            <small>{{ NotificationController::timeAgo($item->updated_at) }}
                                                @if ($user->id == $item->new_feed_user->id)
                                                    <span class="mx-1">⚬</span>
                                                    <span>
                                                        @if ($item->status == '0')
                                                            Public
                                                        @else
                                                            Cá nhân
                                                        @endif
                                                    </span>
                                                @endif
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="my-3 w-100 overflow-hidden">
                                    {!! $item->description !!}
                                </div>
                                <div class="my-1 border-top border-bottom">
                                    <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted ps-0"><i
                                            class='uil uil-comments-alt'></i>
                                        {{ $comments->total() }}</a>
                                </div>
                            </div>
                            <div class="comments" post-id="{{ $item->id }}">
                                @include('avnnewfeed::components.comments', ['comments' => $comments])
                                @if ($comments->hasMorePages())
                                    <a href="javascript: void(0);"
                                        class="load-more-comment btn btn-sm btn-link text-muted ps-0" data-page="1"
                                        data-feed-id="{{ $item->id }}">Xem thêm
                                        bình luận</a>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <div class="d-flex mb-2 w-100">
                                <img class="align-self-start rounded me-2"
                                    src="{{ asset($user->profile->img ?? config('constants.default_avatar')) }}"
                                    style="height: 32px; width: 32px; object-fit: cover;">
                                <div class="w-100">
                                    <form action="{{ route('store-comment-feed') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="feed_id" value="{{ $item->id }}">
                                        <input type="text" class="form-control border-0 form-control-sm"
                                            name="comment" placeholder="Bình luận....">
                                        <div class="mt-2 d-flex justify-content-end align-items-center">
                                            <button type="submit" class="btn btn-sm btn-success">Bình
                                                luận</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!----Modal Delete bài viết----->
            <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                style="background-color: rgba(49,58,70,0.7);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark">Xác nhận</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-dark">
                            <p>Bạn có muốn xóa không?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy
                            </button>
                            <form action="{{ route('delete-feed', [$item->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-primary">Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
