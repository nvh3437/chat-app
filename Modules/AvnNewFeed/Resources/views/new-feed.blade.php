@php
    use App\Http\Controllers\NotificationController;
    use Modules\AvnNewFeed\Http\Controllers\NewFeedLikeController;
    $notifications = App\Http\Controllers\NotificationController::getNotifications();
@endphp
@extends('layouts.guest', ['seo_title' => 'Bản tin'])
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col-lg-3 order-md-1 order-lg-1 position-relative mb-3">
                <div class="position-sticky top-0">
                    <div class="card shadow-lg mb-0">
                        <div class="card-body">
                            <div class="d-flex align-self-start">
                                <img class="d-flex align-self-start rounded me-2"
                                    src="{{ asset($user->profile->img ?? config('constants.default_avatar')) }}"
                                    style="height: 48px; width: 48px; object-fit: cover;">
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
                                <a href="{{ route('chat-index') }}"
                                    class="list-group-item list-group-item-action border-0"><i
                                        class='uil uil-comment-alt-message me-1'></i> Tin nhắn</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-md-1 order-lg-2 position-relative mb-3 d-none d-lg-block">
                <div class="position-sticky top-0">
                    <div class="card shadow-lg mb-0">
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
                            @foreach ($notifications as $notification)
                                <div class="d-flex mt-3">
                                    <i class='uil uil-arrow-growth me-2 font-18 text-primary'></i>
                                    <div>
                                        <a class="mt-1 font-14"
                                            href="{{ route('read-notifications', ['id' => $notification->id]) }}"
                                            data-link="{{ $notification->link ?? 'none' }}"
                                            data-id="{{ $notification->id }}" data-status="{{ $notification->status }}">
                                            <strong>{{ $notification->title }}:</strong>
                                            <span class="text-muted">
                                                {!! $notification->content !!}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-md-2 order-lg-1" id="feed-container">
                <div class="card shadow-lg">
                    <div class="card-body p-0">
                        <ul class="nav nav-tabs nav-bordered">
                            <li class="nav-item">
                                <a href="#newpost" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link active px-3 py-2">
                                    Đăng bài
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active p-3" id="newpost">
                                <div class="border rounded">
                                    <form class="comment-area-box" id="feed-form">
                                        @csrf
                                        <textarea rows="4" class="form-control border-0 resize-none" name="description"
                                            placeholder="Bạn đang nghĩ gì...."></textarea>
                                        <div class="files-container d-none">
                                            <div class="card mb-1 shadow-none p-2">
                                                <div class="row g-1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="status"
                                                    value="1">
                                                <label class="form-check-label">Cá nhân</label>
                                            </div>
                                            <div class="btn-group">
                                                <input type="file" id="input-images" accept="image/*" multiple hidden>
                                                <input type="file" name="images" id="images" accept="image/*"
                                                    multiple hidden>
                                                <label class="btn btn-link btn-sm text-muted font-18" for="input-images">
                                                    <i class="dripicons-paperclip"></i>
                                                </label>
                                                <button type="button" class="btn btn-sm btn-success text-end"
                                                    id="feed-submit"><i class='uil uil-message me-1'></i>Đăng
                                                    bài</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('avnnewfeed::components.newfeed', ['newsfeed' => $newsfeed])
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lightgallery.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-zoom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-thumbnail.css">
    <style>
        .card .modal-body .comments hr:last-of-type {
            display: none;
        }

        .remove-image {
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 100%;
            padding: 1px 4px 2px;
            font: 700 13px/13px sans-serif;
            background: #555;
            border: 2px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .remove-image:hover {
            background: #E54E4E;
            top: -11px;
            right: -11px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('Modules/AvnNewFeed/Resources/assets/sort-image.css') }}">
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/lightgallery.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/zoom/lg-zoom.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/thumbnail/lg-thumbnail.umd.js"></script>
    <script type="text/javascript">
        window.newfeed_paginate = 1;
        window.load_more_feed = true;
        init_gallery();
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() + $('footer').outerHeight() >= $(document).height()) {
                if (window.load_more_feed) {
                    window.load_more_feed = false;
                    ++window.newfeed_paginate;
                    var htm =
                        '<button id="load-more-spin" class="btn btn-primary w-100 mb-1" type="button" disabled>'
                    htm +=
                        '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>'
                    htm += 'Đang tải thêm ...'
                    htm += '</button>'
                    $('#feed-container').append(htm);
                    $.ajax({
                        method: 'get',
                        url: "{{ route('load-new-feed') }}",
                        dataType: "html",
                        data: {
                            newfeed_paginate: window.newfeed_paginate,
                        },
                        success: function(res) {
                            $('#load-more-spin').remove();
                            if (!res) {
                                window.load_more_feed = false;
                                var htm =
                                    '<button id="load-more-spin" class="btn btn-outline-primary w-100 mb-1 fw-bold" type="button" disabled="">Tất cả đã được tải</button>'
                                $('#feed-container').append(htm);
                            } else {
                                window.load_more_feed = true;
                                $('#feed-container').append(res);
                                init_gallery();
                            }
                        }
                    });
                }
            }
        })

        function init_gallery() {
            $(".feed-without-gallery .animated-thumbnails-gallery").each(function() {
                window.lightGallery(
                    this, {
                        galleryId: "nature",
                        plugins: [lgZoom, lgThumbnail],
                        mobileSettings: {
                            controls: false,
                            showCloseIcon: false,
                            download: false,
                            rotate: false
                        }
                    }
                );
            })
            $('.feed-without-gallery .gallery-container').each(function() {
                var container = this
                var img = $(this).find('img:not(.d-none)');
                var aspect_ratio = [];
                if (img.length > 1) {
                    img.each(function(index, image) {
                        if (image.height / image.width > 1.1) {
                            aspect_ratio[aspect_ratio.length] = 'portrait';
                        } else if (image.height / image.width < 0.9) {
                            aspect_ratio[aspect_ratio.length] = 'landscape';
                        } else {
                            aspect_ratio[aspect_ratio.length] = 'square';
                        }
                    });
                    if (aspect_ratio.length == 2) {
                        $(container).addClass('gallery-container2');
                    }
                    if (aspect_ratio.length == 3) {
                        if (aspect_ratio[0] == 'landscape') {
                            $(container).addClass('gallery-container3-2');
                        } else if (
                            aspect_ratio[0] == 'square' ||
                            aspect_ratio.filter((item) => (item == 'portrait')).length == 3
                        ) {
                            $(container).addClass('gallery-container3-3');
                        } else {
                            $(container).addClass('gallery-container3-1');
                        }
                    }
                    if (aspect_ratio.length == 4) {
                        if (aspect_ratio[0] == 'square') {
                            $(container).addClass('gallery-container4-1');
                        } else if (aspect_ratio[0] == 'landscape') {
                            $(container).addClass('gallery-container4-3');
                        } else {
                            $(container).addClass('gallery-container4-2');
                        }
                        console.log($(container).attr('data-view-more'));
                        if ($(container).attr('data-view-more')) {
                            $(container).find('a:not(.d-none):nth-child(4)').append(
                                '<div class="position-absolute top-0 start-0 w-100 h-100 text-white fw-bold d-flex fs-2 justify-content-center align-items-center" style=" background-color: rgba(var(--bs-dark-rgb),0.4)!important; ">+' +
                                $(container).attr('data-view-more') + '</div>')
                        }
                    }
                    img.addClass('h-100 w-100')
                }
            });
            $('.feed-without-gallery').removeClass('feed-without-gallery');
        }
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
            $('#feed-container ').on('click', '.comments .edit-comment', function() {
                let form = $('#edit-comment form');
                let action_str = form.attr('action');
                let idx = action_str.lastIndexOf('/');
                action_str = action_str.slice(0, idx + 1);
                form.attr('action', action_str + $(this).closest('.item').attr('comment-id'));
                form.find('[name="feed_id"]').val($(this).closest('.comments').attr('post-id'));
                form.find('[name="comment"]').val($(this).closest('.item').find('.comment-text').html()
                    .trim());
                modalEditComment.show();
            })
            $('#feed-container').on('click', '.comments .delete-comment', function() {
                let form = $('#delete-comment form');
                let action_str = form.attr('action');
                let idx = action_str.lastIndexOf('/');
                action_str = action_str.slice(0, idx + 1);
                form.attr('action', action_str + $(this).closest('.item').attr('comment-id'));
                modalDeleteComment.show();
            })
            $('#feed-container').on('click', '.like-btn', function() {
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
            $('#feed-container').on('click', '.load-more-comment', function() {
                var button = this;
                var feed_id = $(this).attr('data-feed-id');
                var comment_paginate = $(this).attr('data-page');
                comment_paginate++;
                $(this).attr('data-page', comment_paginate);
                $(this).addClass("d-none");
                var htm =
                    '<p class="load-more-spin w-100 mb-1">'
                htm +=
                    '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>'
                htm += 'Đang tải thêm ...'
                htm += '</p>'
                $(htm).insertBefore(this);
                $.ajax({
                    method: 'get',
                    url: "{{ route('load-comment-feed') }}",
                    dataType: "html",
                    data: {
                        feed_id: feed_id,
                        comment_paginate: comment_paginate,
                    },
                    success: function(res) {
                        $(button).parent().find('.load-more-spin').remove();
                        if (res) {
                            $(res).insertBefore(button);
                            $(button).removeClass("d-none");
                        } else {
                            $('<p class="mb-1 fw-bold text-primary">Tất cả đã được tải</p>')
                                .insertBefore(button);

                        }
                    }
                });
            })
        })
    </script>
    <script>
        // check file upload 
        $('label[for=input-images]').on('click', function(e) {
            if (images.length >= 6) {
                e.preventDefault();
                e.stopPropagation();
                $.NotificationApp.send("Thất bại", "Tối đa 6 tệp", "bottom-right",
                    "rgba(0,0,0,0.2)", "error")
            }
        })
        window.images = [];
        window.preview_images = [];
        $('#input-images').change(function(e) {
            e.preventDefault();
            if (this.files) {
                $('.files-container').removeClass('d-none')
                var htm = ''
                var filesAmount = this.files.length;
                for (i = 0; i < filesAmount; i++) {
                    if (images.length >= 6) {
                        $.NotificationApp.send("Thất bại", "Tối đa 6 tệp", "bottom-right",
                            "rgba(0,0,0,0.2)", "error")
                        break
                    }
                    file = this.files[i]
                    images[images.length] = file
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        preview_images[preview_images.length] = event.target.result
                        htm =
                            '<div class="col-6 col-lg-4 col-xxl-3"><div class="position-relative img-thumbnail " style="padding-bottom:100%;">'
                        htm += '<img src="' +
                            event.target
                            .result +
                            '" class="position-absolute start-0 top-0  rounded w-100 h-100" style="object-fit: cover;">'
                        htm +=
                            '<a class="remove-image" href="javascript: void(0);" style="display: inline;">&#215;</a>'
                        htm += '</div></div>'
                        $('.files-container .row').append(htm)
                    }
                    reader.readAsDataURL(file);
                }
                $("#input-images").val('')
            }
        })

        // remove file upload
        $('.files-container').on('click', '.remove-image', function() {
            var index = preview_images.indexOf($(this).parent().find('img').attr('src'));
            if (index > -1) { // only splice array when item is found
                preview_images.splice(index, 1); // 2nd parameter means remove one item only
                images.splice(index, 1); // 2nd parameter means remove one item only
                $(this).parent().parent().remove()
            }
            if (!preview_images.length) {
                $('.files-container').addClass('d-none')
            }
        })

        $('#feed-submit').on('click', function() {
            $(this).text('Đang tải lên');
            $(this).attr('disabled', 'true');
            $('#feed-form').append(
                '<p class="d-flex align-items-center"><span class="spinner-border text-primary flex-shrink-0 me-1" role="status"></span> <span>Đang tải lên vui lòng không rời khỏi trang.</span></p>'
            )
            var status = $('#feed-form input[name=status]')[0].checked ? 1 : 0;
            var description = $('#feed-form textarea[name=description]').val();
            var form_data = new FormData()
            form_data.append("status", status);
            form_data.append("description", description);
            images.forEach(img => {
                form_data.append("images[]", img);
            });
            $.ajax({
                method: 'post',
                url: "{{ route('store-feed') }}",
                dataType: "json",
                processData: false,
                contentType: false,
                data: form_data,
                success: function(res) {
                    location.reload();
                },
                error: function(e) {
                    if (!navigator.onLine) {
                        var request = this
                        setTimeout(function() {
                            $.ajax(request);
                        }, 3000);
                    }
                }
            });
        })
    </script>
@endsection
