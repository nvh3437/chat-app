@php
    use App\Http\Controllers\NotificationController;
    use Modules\AvnNewFeed\Http\Controllers\NewFeedLikeController;
    $notifications = App\Http\Controllers\NotificationController::getNotifications();
@endphp
@extends('layouts.guest')
@section('title')
    {{ $title ?? '' }}
@endsection
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-12 order-lg-1 order-xxl-1">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">Sửa hồ sơ</a>
                            </div>
                        </div>
                        <div class="d-flex align-self-start">
                            @if ($user->profile && $user->profile->img)
                                <img class="d-flex align-self-start rounded me-2"
                                    src="{{ asset($user->profile->img ?? '/resources/assets/images/logo.png') }}"
                                    style="height: 48px; width: 48px; object-fit: cover;">
                            @else
                                <img class="d-flex align-self-start rounded me-2"
                                    src="{{ asset('/resources/assets/images/logo.png') }}"
                                    style="height: 48px; width: 48px; object-fit: cover;">
                            @endif
                            <div class="w-100 overflow-hidden">
                                <h5 class="mt-1 mb-0">{{ $user->name }}</h5>
                                <p class="mb-1 mt-1 text-muted">
                                    @if ($user->type == 'system')
                                        Quản lý
                                    @elseif($user->type == 'customer')
                                        Khách hàng
                                    @else
                                        Chuyên gia
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="list-group list-group-flush mt-2">
                            <a href="{{ route('new-feed') }}"
                                class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'new-feed' ? 'text-primary' : '' }} border-0"><i
                                    class='uil uil-images me-1'></i> Bản tin</a>
                            <a href="{{ route('my-feed') }}"
                                class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'my-feed' ? 'text-primary' : '' }} border-0"><i
                                    class='uil uil-images me-1'></i> Tin của tôi</a>
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action border-0"><i
                                    class='uil uil-comment-alt-message me-1'></i> Tin nhắn</a>
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <form action="{{ route('clear-notifications') }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="dropdown-item">Xóa hết</button>
                                </form>
                            </div>
                        </div>
                        <h4 class="header-title mb-1">Thông báo</h4>
                        <div class="d-flex mt-3">
                            @foreach ($notifications as $notification)
                                <i class='uil uil-arrow-growth me-2 font-18 text-primary'></i>
                                <div>
                                    <a class="mt-1 font-14"
                                        href="{{ route('read-notifications', ['id' => $notification->id]) }}"
                                        data-link="{{ $notification->link ?? 'none' }}" data-id="{{ $notification->id }}"
                                        data-status="{{ $notification->status }}">
                                        <strong>{{ $notification->title }}:</strong>
                                        <span class="text-muted">
                                            {!! $notification->content !!}
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9 col-lg-9 col-md-8 col-sm-12 order-lg-2 order-xxl-1">
                <div class="card shadow-lg">
                    <div class="card-body p-0">
                        @php
                            if (isset($edit_feed)) {
                                $is_edit = true;
                            } else {
                                $is_edit = false;
                            }
                        @endphp
                        <ul class="nav nav-tabs nav-bordered">
                            <li class="nav-item">
                                <a href="#newpost" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link active px-3 py-2">
                                    <i class="mdi mdi-pencil-box-multiple font-18 d-md-none d-block"></i>
                                    <span class="d-none d-md-block">{{ $is_edit ? 'Sửa bài' : 'Đăng bài' }}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active p-3" id="newpost">
                                <div class="border rounded">
                                    <form
                                        action="{{ $is_edit ? route('update-feed', $edit_feed->id) : route('store-feed') }}"
                                        method="POST" enctype="multipart/form-data" class="comment-area-box">
                                        @csrf
                                        @if ($is_edit)
                                            @method('PUT')
                                        @endif
                                        <textarea rows="4" class="form-control border-0 resize-none" name="description" id="editor"
                                            placeholder="Nhập bài đăng....">
                                            @if ($is_edit)
{!! $edit_feed->description !!}
@endif
                                        </textarea>
                                        <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="status"
                                                        value="1"
                                                        {{ $is_edit && $edit_feed->status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Cá nhân</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success"><i
                                                    class='uil uil-message me-1'></i>{{ $is_edit ? 'Cập nhật' : 'Đăng' }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @include('avnnewfeed::components.feeds', compact('user','notifications','newsfeed')) --}}
                @isset($newsfeed)
                    @foreach ($newsfeed as $item)
                        <div class="card shadow-lg">
                            <div class="card-body pb-1">
                                <div class="d-flex">
                                    @if ($item->new_feed_user->profile && $item->new_feed_user->profile->img)
                                        <img class="me-2 rounded"
                                            src="{{ asset($item->new_feed_user->profile->img ?? '/resources/assets/images/logo.png') }}"
                                            style="height: 32px; width: 32px; object-fit: cover;">
                                    @else
                                        <img class="me-2 rounded" src="{{ asset('/resources/assets/images/logo.png') }}"
                                            style="height: 32px; width: 32px; object-fit: cover;">
                                    @endif
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
                                                    <a href="{{ route('edit-feed', $params) }}" class="dropdown-item">Chỉnh
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
                                <hr class="m-0" />
                                <div class="my-3 w-100 overflow-hidden ck-content">
                                    {!! $item->description !!}
                                </div>
                                <hr class="m-0" />
                                <div class="my-1">
                                    <a href="javascript: void(0);" feed-id="{{ $item->id }}"
                                        class="like-btn btn btn-sm btn-link text-muted ps-0"><i
                                            class='mdi mdi-thumb-up{{ NewFeedLikeController::isLikeFeed($item->id) ? '' : '-outline' }}'></i>
                                        <span>{{ count($item->new_feed_likes) }}</span></a>
                                    <a href="javascript: void(0);" data-bs-toggle="modal"
                                        data-bs-target="#open-{{ $item->id }}"
                                        class="btn btn-sm btn-link text-muted ps-0"><i class='uil uil-comments-alt'></i>
                                        {{ count($item->new_feed_comments) }}</a>
                                </div>
                                <div class="modal fade" id="open-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark">Bài viết của
                                                    {{ $item->new_feed_user->name }}</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="post">
                                                    <div class="d-flex">
                                                        @if ($item->new_feed_user->profile && $item->new_feed_user->profile->img)
                                                            <img class="me-2 rounded"
                                                                src="{{ asset($item->new_feed_user->profile->img ?? '/resources/assets/images/logo.png') }}"
                                                                style="height: 32px; width: 32px; object-fit: cover;">
                                                        @else
                                                            <img class="me-2 rounded"
                                                                src="{{ asset('/resources/assets/images/logo.png') }}"
                                                                style="height: 32px; width: 32px; object-fit: cover;">
                                                        @endif
                                                        <div class="w-100">
                                                            @if ($user->id == $item->user_id)
                                                                <div class="dropdown float-end text-muted">
                                                                    <a href="#"
                                                                        class="dropdown-toggle arrow-none card-drop"
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
                                                                    <a href="#"
                                                                        class="dropdown-toggle arrow-none card-drop"
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
                                                    <hr class="m-0" />
                                                    <div class="my-3 w-100 overflow-hidden ck-content">
                                                        {!! $item->description !!}
                                                    </div>
                                                    <hr class="m-0" />
                                                    <div class="my-1">
                                                        <a href="javascript: void(0);"
                                                            class="btn btn-sm btn-link text-muted ps-0"><i
                                                                class='uil uil-comments-alt'></i>
                                                            {{ count($item->new_feed_comments) }}</a>
                                                    </div>
                                                </div>
                                                <div class="comments" post-id="{{ $item->id }}"
                                                    total="{{ $item->new_feed_comments->count() }}">
                                                    @php $comment_count = 0 @endphp
                                                    @foreach ($item->new_feed_comments as $index => $child)
                                                        @if ($index == 0)
                                                            <hr class="m-0 mb-3" />
                                                        @endif
                                                        <div class="d-flex item" comment-id="{{ $child->id }}">
                                                            @if ($child->new_feed_comment_user->profile && $child->new_feed_comment_user->profile->img)
                                                                <img class="me-2 rounded"
                                                                    src="{{ asset($child->new_feed_comment_user->profile->img ?? '/resources/assets/images/logo.png') }}"
                                                                    style="height: 32px; width: 32px; object-fit: cover;">
                                                            @else
                                                                <img class="me-2 rounded"
                                                                    src="{{ asset('/resources/assets/images/logo.png') }}"
                                                                    style="height: 32px; width: 32px; object-fit: cover;">
                                                            @endif
                                                            <div>
                                                                <h5 class="m-0">{{ $child->new_feed_comment_user->name }}
                                                                </h5>
                                                                <p class="text-muted mb-0">
                                                                    <small>{{ NotificationController::timeAgo($child->updated_at) }}</small>
                                                                </p>
                                                                <p class="comment-text text-dark mb-2">{!! $child->comment !!}
                                                                </p>
                                                                <!--- Người bình luận đc sửa --->
                                                                @if ($user->id == $child->user_id)
                                                                    <div>
                                                                        <a href="javascript: void(0);"
                                                                            class="edit-comment btn btn-sm btn-link text-muted p-0">
                                                                            <i class='mdi mdi-pencil'></i> Sửa
                                                                        </a>
                                                                        <a href="javascript: void(0);"
                                                                            class="delete-comment btn btn-sm btn-link text-muted p-0 ps-2">
                                                                            <i class='mdi mdi-delete'></i> Xóa
                                                                        </a>
                                                                    </div>
                                                                @elseif(Route::currentRouteName() == 'new-feed' && $user->type == 'system')
                                                                    <!---- Quản lý được xóa --->
                                                                    <div>
                                                                        <a href="javascript: void(0);"
                                                                            class="delete-comment btn btn-sm btn-link text-muted p-0">
                                                                            <i class='mdi mdi-delete'></i> Xóa
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        @php
                                                            if ($index == 1) {
                                                                if (count($item->new_feed_comments) - 1 > $index) {
                                                                    $comment_count = $index + 1;
                                                                }
                                                                break;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                </div>
                                                @if ($comment_count)
                                                    <div>
                                                        <hr />
                                                        <a href="javascript: void(0);"
                                                            class="loadmore-cm btn btn-sm btn-link text-muted ps-0"
                                                            comment-count="{{ $comment_count }}"
                                                            feed-id="{{ $item->id }}">Xem thêm bình luận</a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <div class="d-flex mb-2 w-100">
                                                    @if ($user->profile && $user->profile->img)
                                                        <img class="align-self-start rounded me-2"
                                                            src="{{ asset($user->profile->img ?? '/resources/assets/images/logo.png') }}"
                                                            style="height: 32px; width: 32px; object-fit: cover;">
                                                    @else
                                                        <img class="align-self-start rounded me-2"
                                                            src="{{ asset('/resources/assets/images/logo.png') }}"
                                                            style="height: 32px; width: 32px; object-fit: cover;">
                                                    @endif
                                                    <div class="w-100">
                                                        <form action="{{ route('store-comment-feed') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="feed_id"
                                                                value="{{ $item->id }}">
                                                            <input type="text"
                                                                class="form-control border-0 form-control-sm" name="comment"
                                                                placeholder="Bình luận....">
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
                    @endforeach()
                @endisset
            </div>
        </div>
    </div>
    <!----Modal Edit bình luận----->
    <div class="modal fade" style="background-color: rgba(49,58,70,0.7);" id="edit-comment" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Sửa bình luận</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('update-comment-feed', 0) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="feed_id" value="">
                    <div class="modal-body text-dark">
                        <input type="text" class="form-control border-0 form-control-sm" name="comment"
                            value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!----Modal Delete bình luận----->
    <div class="modal fade" style="background-color: rgba(49,58,70,0.7);" id="delete-comment" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Xác nhận</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
                </div>
                <div class="modal-body text-dark">
                    <p>Bạn có muốn xóa không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy
                    </button>
                    <form action="{{ route('delete-comment-feed', 0) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .card .modal-body .comments hr:last-of-type {
            display: none;
        }
    </style>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/translations/vi.js"></script>
    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline',
                    'bulletedList', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'mediaEmbed',
                    '|',
                ],
                shouldNotGroupWhenFull: true
            },
            language: 'vi',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Nội dung',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                        '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                // 'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType
                'MathType'
            ],
            ckfinder: {
                uploadUrl: "{{ route('image-upload') . '?_token=' . csrf_token() }}",
            }
        });
    </script>
    <script type="text/javascript">
        // add csrf
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        jQuery(document).ready(function($) {
            var modalEditComment = new bootstrap.Modal(document.getElementById('edit-comment'))
            var modalDeleteComment = new bootstrap.Modal(document.getElementById('delete-comment'))
            $('.comments').on('click', '.edit-comment', function() {
                let form = $('#edit-comment form');
                let action_str = form.attr('action');
                let idx = action_str.lastIndexOf('/');
                action_str = action_str.slice(0, idx + 1);
                form.attr('action', action_str + $(this).closest('.item').attr('comment-id'));
                form.find('[name="feed_id"]').val($(this).closest('.comments').attr('post-id'));
                form.find('[name="comment"]').val($(this).closest('.item').find('.comment-text').html());
                modalEditComment.show();
            })
            $('.comments').on('click', '.delete-comment', function() {
                let form = $('#delete-comment form');
                let action_str = form.attr('action');
                let idx = action_str.lastIndexOf('/');
                action_str = action_str.slice(0, idx + 1);
                form.attr('action', action_str + $(this).closest('.item').attr('comment-id'));
                modalDeleteComment.show();
            })
            $('.like-btn').on('click', function() {
                let $this = $(this);
                let feed_id = $this.attr('feed-id');
                if ($this.find('i').hasClass('mdi-thumb-up-outline')) {
                    $this.find('i').addClass('mdi-thumb-up').removeClass('mdi-thumb-up-outline');
                    $this.find('span').text(parseInt($this.find('span').text()) + 1);
                    $.ajax({
                        method: 'post',
                        url: "{{ route('store-like-feed') }}",
                        dataType: "json",
                        data: {
                            feed_id: feed_id,
                        },
                        success: function(res) {}
                    });
                } else {
                    $this.find('i').addClass('mdi-thumb-up-outline').removeClass('mdi-thumb-up');
                    $this.find('span').text(parseInt($this.find('span').text()) - 1);
                    $.ajax({
                        method: 'post',
                        url: "{{ route('delete-like-feed') }}",
                        dataType: "json",
                        data: {
                            feed_id: feed_id,
                        },
                        success: function(res) {}
                    });
                }
            })
            $('.loadmore-cm').on('click', function() {
                let $this = $(this);
                let container = $(this).closest('.modal').find('.comments');
                let feed_id = $(this).attr('feed-id');
                let comment_count = parseInt($(this).attr('comment-count'));
                let total = parseInt(container.attr('total'));
                $this.addClass("disabled");
                $.ajax({
                    method: 'get',
                    url: "{{ route('load-comment-feed') }}",
                    // dataType: "json",
                    data: {
                        feed_id: feed_id,
                        comment_count: comment_count,
                        currentRouteName: '{{ Route::currentRouteName() }}',
                    },
                    success: function(res) {
                        if (res) {
                            comment_count += 1;
                            if (comment_count >= total) {
                                $this.parent().remove();
                            } else {
                                $this.attr('comment-count', comment_count);
                            }
                            container.append(res);
                            $this.removeClass("disabled");
                        }
                    }
                });
            })
        })
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('resources/css/ckeditor.css') }}">
@endsection
