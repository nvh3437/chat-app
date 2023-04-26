@php
    // $logo = App\Http\Controllers\Helper::getLogo();
    $seo_props = [];
    $seo_props['seo_title'] = 'chat';
    // if (isset($contact_seo['contact_seo_description'])) {
    //     $seo_props['seo_description'] = $contact_seo['contact_seo_description']['value'] ?? '';
    // }
    // if (isset($contact_seo['contact_seo_keywords'])) {
    //     $seo_props['seo_keywords'] = $contact_seo['contact_seo_keywords']['value'] ?? '';
    // }
    // if (isset($contact_seo['contact_seo_image'])) {
    //     $seo_props['seo_image'] = $contact_seo['contact_seo_image']['value'] ?? '';
    // }
@endphp
@extends('layouts.guest', $seo_props)
@php
    use App\Http\Controllers\Helper;
@endphp
@section('content')
    <!-- Start Content-->
    <div class="container">
        <div class="row mt-3">
            <!-- start chat users-->
            <div class="col-xl-3 room-col">
                <div class="card shadow-lg">
                    <div class="card-body p-0">
                        <ul class="nav nav-tabs nav-bordered">
                            <li class="nav-item">
                                <a href="#allChat" data-bs-toggle="tab" aria-expanded="false" class="nav-link active py-2">
                                    Tất cả
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#partnerFree" data-bs-toggle="tab" aria-expanded="true" class="nav-link py-2">
                                    Đang rảnh
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#partnerBusy" data-bs-toggle="tab" aria-expanded="true" class="nav-link py-2">
                                    Đang bận
                                </a>
                            </li>
                        </ul> <!-- end nav-->
                        <div class="tab-content chat-rooms-conatiner">
                            <div class="tab-pane show active p-3" id="allChat">
                                <!-- start search box -->
                                @include('avnchat::components.search-chat-room')
                                <!-- end search box -->
                                <!-- users -->
                                <div data-simplebar style="height: 550px">
                                    @foreach ($rooms as $room)
                                        @include('avnchat::components.chat-room', compact('room'))
                                    @endforeach
                                </div>
                                <!-- end users -->
                            </div> <!-- end Tab Pane-->
                            <div class="tab-pane p-3" id="partnerFree">
                                <!-- start search box -->
                                @include('avnchat::components.search-chat-room')
                                <!-- end search box -->
                                <!-- users -->
                                <div data-simplebar style="height: 550px">
                                    @foreach ($rooms as $room)
                                        @php
                                            if (!$room->users->where('type', 'partner')->count()) {
                                                continue;
                                            }
                                            if ($room->users->where('type', 'customer')->count()) {
                                                continue;
                                            }
                                        @endphp
                                        @include('avnchat::components.chat-room', compact('room'))
                                    @endforeach
                                </div>
                                <!-- end users -->
                            </div> <!-- end Tab Pane-->
                            <div class="tab-pane p-3" id="partnerBusy">
                                <!-- start search box -->
                                @include('avnchat::components.search-chat-room')
                                <!-- end search box -->
                                <!-- users -->
                                <div data-simplebar style="height: 550px">
                                    @foreach ($rooms as $room)
                                        @php
                                            if (!$room->users->where('type', 'partner')->count()) {
                                                continue;
                                            }
                                            if (!$room->users->where('type', 'customer')->count()) {
                                                continue;
                                            }
                                        @endphp
                                        @include('avnchat::components.chat-room', compact('room'))
                                    @endforeach
                                </div>
                                <!-- end users -->
                            </div> <!-- end Tab Pane-->
                        </div> <!-- end tab content-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
            <!-- end chat users-->
            <!-- chat area -->
            <div class="col-xl-6 chat-col d-none ">
                <div class="card shadow-lg mb-0 d-lg-none chat-navigation shadow-lg rounded-0"
                    style="background: rgba(var(--bs-primary-rgb),0.5);">
                    <div class="card-body d-flex align-items-center py-1">
                        <a href="javascript:void(0);" class="back-to-room-col">
                            <i class="dripicons-arrow-thin-left fw-bold fs-1 text-primary"></i>
                        </a>
                        <div class="d-flex align-items-center chat-room-badge flex-grow-1 p-1">
                            <div class="me-2 flex-shrink-0 position-relative chat-room-img">
                                <img src="http://localhost:8080/japan-chat-app/storage/app/AvnUser/21.png"
                                    class="rounded-circle img-thumbnail p-0"
                                    style="object-fit: cover; height:48px; width:48px;" alt="partner21">
                            </div>
                            <div class="w-100 overflow-hidden">
                                <h4 class="mt-0 mb-0 room-name">
                                    partner21
                                </h4>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="show-room-info">
                            <i class="dripicons-align-right  fw-bold fs-1 text-primary"></i>
                        </a>
                    </div>
                </div>
                <div class="card chat-conatiner d-none shadow-lg">
                    <div class="card-body position-relative">
                        <div class="pre-loader position-absolute w-100 h-100 bg-secondary top-0 start-0 d-none"
                            style="z-index: 10">
                            <div class="btn btn-primary position-absolute top-50 start-50"
                                style="transform: translate(-50%, -50%);">
                                <span class="spinner-border spinner-border-sm me-1" role="status"
                                    aria-hidden="true"></span>
                                Đang tải thông tin...
                            </div>
                        </div>
                        <div class="pre-loader-error position-absolute w-100 h-100 bg-secondary top-0 start-0 d-none"
                            style="z-index: 10">
                            <div class="btn btn-danger position-absolute top-50 start-50"
                                style="transform: translate(-50%, -50%);">
                                <span class="spinner-border spinner-border-sm me-1" role="status"
                                    aria-hidden="true"></span>
                                Có lỗi xảy ra hãy thông báo với quản trị viên...
                            </div>
                        </div>
                        <ul class="conversation-list min-vh-75" data-simplebar style="height: 537px">
                            {{-- <li class = "text-center date-message">
                                <span class="badge badge-secondary-lighten">
                                    ngu
                                </span>
                            </li> --}}
                        </ul>
                        <div class="row">
                            <div class="col">
                                <div class="mt-2 bg-light p-3 rounded">
                                    <div class="alert alert-primary d-none alert-join-room text-center mb-0" role="alert">
                                        <b>Bạn không thể trả lời tin nhắn này</b>
                                    </div>
                                    <form class="chat-form" name="chat-form" id="chat-form">
                                        <div class="row">
                                            <div class="col-12 files-container d-none">
                                                <div class="card mb-1 shadow-none border p-2">
                                                    <div class="row g-1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col mb-2 mb-sm-0 pe-0">
                                                {{-- <p contenteditable="true" name="message" id="message"
                                                    class="form-control border-0 mb-0"></p> --}}
                                                <input type="text" class="form-control border-0"
                                                    placeholder="Enter your text" id="message" required="">

                                            </div>
                                            <div class="col-sm-auto ps-0">
                                                <div class="btn-group">
                                                    <label for="files" class="btn btn-light"><i
                                                            class="uil uil-paperclip"></i></label>
                                                    <input type="file" accept="image/*" hidden name="files" multiple
                                                        id="files">
                                                    {{-- <a href="#" class="btn btn-light"> <i
                                                            class='uil uil-smile'></i>
                                                    </a> --}}
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-success chat-send"><i
                                                                class='uil uil-message'></i></button>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row-->
                                    </form>
                                </div>
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div>
            <!-- end chat area-->

            <!-- start user detail -->
            <div class="col-xl-3 info-col">
                <div class="card chat-info d-none shadow-lg">
                    <div class="card-body position-relative">
                        <div class="pre-loader position-absolute w-100 h-100 bg-secondary top-0 start-0 d-none"
                            style="z-index: 10">
                            <div class="btn btn-primary position-absolute top-50 start-50"
                                style="transform: translate(-50%, -50%);">
                                <span class="spinner-border spinner-border-sm me-1" role="status"
                                    aria-hidden="true"></span>
                                Đang tải tin nhắn...
                            </div>
                        </div>
                        <div class="pre-loader-error position-absolute w-100 h-100 bg-secondary top-0 start-0 d-none"
                            style="z-index: 10">
                            <div class="btn btn-danger position-absolute top-50 start-50"
                                style="transform: translate(-50%, -50%);">
                                <span class="spinner-border spinner-border-sm me-1" role="status"
                                    aria-hidden="true"></span>
                                Có lỗi xảy ra hãy thông báo với quản trị viên...
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="back-to-chat-col position-absolute d-lg-none">
                            <i class="dripicons-arrow-thin-left fw-bold fs-1 text-primary"></i>
                        </a>
                        {{-- <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">View full</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Edit Contact Info</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Remove</a>
                            </div>
                        </div> --}}

                        <div class="mt-3 text-center">
                            <img src="#" alt=""
                                class="img-thumbnail avatar-lg rounded-circle chat-info-img d-none"
                                style="object-fit: cover" />
                            <div class="position-relative chat-info-imgs d-none" style="height: 3rem;">

                            </div>
                            <h4 class="chat-info-name"></h4>
                            <button class="btn btn-primary btn-sm mt-1 join-room"><i class='uil uil-plus me-1'></i>Tham
                                gia</button>
                            <div class="group text-center mt-1 add-users-group d-none">
                                <label class="form-label">Thêm thành viên</label>
                                <!-- Multiple Select -->
                                <select class="form-control" multiple="multiple" data-placeholder="Choose ..."
                                    id="add-users-select">
                                </select>
                                <button class="btn btn-primary btn-sm mt-1 add-users"><i
                                        class='uil uil-plus me-1'></i>Thêm
                                    thành viên</button>
                            </div>
                            <div class="mt-2 workspace-session d-none">
                                <hr class="" />
                                <button class="btn btn-success btn-sm mt-1 start-session d-none"><i
                                        class='mdi mdi-connection me-1'></i>Bắt đầu phiên làm việc</button>
                                <button class="btn btn-danger btn-sm mt-1 end-session d-none"><i
                                        class='mdi mdi-clock-check-outline me-1'></i>Kết thúc phiên làm việc</button>
                                <p class="text-muted mt-2 font-14 time-session d-none">Thời gian hoạt động: <br>
                                    <span class="text-success">
                                        <strong class="day d-none">10days : </strong>
                                        <strong class="hour d-none">10hours : </strong>
                                        <strong class="minute d-none">10mins : </strong>
                                        <strong class="second d-none">10secs</strong>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <hr class="" />
                        <div class="mt-3 list-users-in-room" data-simplebar style="height: 350px">
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
            <!-- end user detail -->
        </div> <!-- end row-->
    </div> <!-- container -->
@endsection
@section('js')
    @vite(['Modules/AvnChat/resources/assets/js/chat.js'])
    {{-- <script src="{{ asset('Modules/AvnChat/resources/assets/js/index.js') }}"></script> --}}
    <script>
        // add csrf
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $(document).ready(function() {
            var room_id = null;
            var page = null;
            var last_page = null;
            var load_more = true;
            var count_up = null;
            var preview_images = [];
            var images = [];
            // listen chanel 
            @foreach ($rooms as $room)
                window.Echo.private('chat.room.{{ $room->id }}')
                    .listen('.newMessage', (e) => {
                        if (e.is_system) {
                            var system_message = ''
                            if (e.message.message.indexOf("add-user") == 0) {
                                $.ajax({
                                    method: 'get',
                                    url: "{{ route('get-room-info') }}",
                                    dataType: "json",
                                    data: {
                                        id: e.message.room_id,
                                    },
                                    success: function(res) {
                                        if (!$('.chat-room[data-id=' + res.room_id + ']').length) {
                                            var htm =
                                                '<a href="javascript:void(0);" class="text-body chat-room" data-id="' +
                                                res.room_id + '">'
                                            htm +=
                                                '<div class="d-flex align-items-start mt-1 p-2 chat-room-badge">'
                                            htm += '<div class="me-2 flex-shrink-0 chat-room-img">'
                                            if (res.imgs.length == 1)
                                                htm += '<img src="' + (res.imgs[0] ??
                                                    'resources/assets/images/users/avatar-1.jpg') +
                                                '" class="rounded-circle img-thumbnail p-0" style="object-fit: cover; height:48px; width:48px;" alt="' +
                                                res.name + '" />'
                                            else
                                                htm +=
                                                '<div class="position-relative" style="width: 48px; height: 48px;">'
                                            res.imgs.forEach((img, index) => {
                                                htm += '<img src="' + (img ??
                                                        'resources/assets/images/users/avatar-1.jpg'
                                                    ) +
                                                    '" class="rounded-circle img-thumbnail position-absolute p-0 ' +
                                                    (
                                                        index % 2 == 0 ? 'top-0 start-0' :
                                                        'bottom-0 end-0') +
                                                    '" style="object-fit: cover; height:36px; width:36px;" alt="' +
                                                    res.name +
                                                    '" />'
                                            });
                                            htm += '</div>'
                                            htm += '</div>'
                                            htm += '<div class="w-100 overflow-hidden">'
                                            htm += '<h5 class="mt-0 mb-0 font-14">'
                                            htm +=
                                                '<span class="float-end text-muted font-12 last-message-time" data-time=""></span>'
                                            htm += '<span class="room-name">' + res.name + '</span>'
                                            htm += '</h5>'
                                            htm += '<p class="mt-1 mb-0 text-muted font-14">'
                                            htm += '<span class="ms-2 float-end text-end d-none">'
                                            htm += '<span class="badge badge-danger room-status">'
                                            htm += '<i class="uil uil-comment-alt-redo"></i>'
                                            htm += '</span>'
                                            htm += '</span>'
                                            htm += '<span class="new-message text-truncate"></span>'
                                            htm += '</p>'
                                            htm += '</div>'
                                            htm += '</div>'
                                            htm += '</a>'
                                            $('#allChat .simplebar-content').append(htm);
                                        }
                                        set_name_image_chat_room(res.name, res.imgs, res.room_id)
                                        if (res.room_id == room_id) {
                                            set_name_image_chat_info(res.name, res.imgs)
                                            update_users_in_list_users_in_room(res.join_users)
                                            scroll_to_bottom_message_container()
                                        }
                                        update_room_status(res.is_workspace, res.has_session, res
                                            .join_users, res.room_id)
                                    },
                                });
                            } else if (e.message.message.indexOf("kick-user") == 0) {
                                $.ajax({
                                    method: 'get',
                                    url: "{{ route('get-room-info') }}",
                                    dataType: "json",
                                    data: {
                                        id: e.message.room_id,
                                    },
                                    success: function(res) {
                                        if (!res) {
                                            $('.alert-join-room').removeClass('d-none')
                                            $('#chat-form').addClass('d-none')
                                        } else {
                                            if (!res.joined_room) {
                                                $('.add-users-group').addClass('d-none')
                                                $('.join-room').removeClass('d-none')
                                                $('.alert-join-room').removeClass('d-none')
                                                $('#chat-form').addClass('d-none')
                                            }
                                            set_name_image_chat_room(res.name, res.imgs, res
                                                .room_id)
                                            if (res.room_id == room_id) {
                                                set_name_image_chat_info(res.name, res.imgs)
                                                update_users_in_list_users_in_room(res.join_users)
                                                scroll_to_bottom_message_container()
                                            }
                                            update_room_status(res.is_workspace, res.has_session,
                                                res
                                                .join_users, res.room_id)
                                        }
                                    },
                                });
                            } else if (e.message.message.indexOf("start-session") == 0) {
                                $('.add-users-group').addClass('d-none')
                                @if ($user->type == 'system')
                                    $('.workspace-session .start-session').addClass(
                                        'd-none')
                                    $('.workspace-session .end-session').removeClass(
                                        'd-none')
                                @endif
                                $('.workspace-session .time-session').removeClass(
                                    'd-none')
                                timer_count_up(new Date(e.message.created_at))
                                update_room_status(true, true, null, e.message.room_id)
                            } else if (e.message.message.indexOf("end-session") == 0) {
                                @if ($user->type == 'system')
                                    $('.add-users-group').removeClass('d-none')
                                    $('.workspace-session .start-session').removeClass(
                                        'd-none')
                                    $('.workspace-session .end-session').addClass(
                                        'd-none')
                                @endif
                                $('.workspace-session .time-session').addClass(
                                    'd-none')
                                @if ($user->type != 'system')
                                    $('.workspace-session').addClass('d-none')
                                @endif
                                clearInterval(count_up);
                                $.ajax({
                                    async: false,
                                    method: 'get',
                                    url: "{{ route('get-room-info') }}",
                                    dataType: "json",
                                    data: {
                                        id: e.message.room_id,
                                    },
                                    success: function(res) {
                                        update_room_status(res.is_workspace, res.has_session, res
                                            .join_users, res.room_id)
                                    },
                                });
                            }

                            if (e.message.room_id == room_id) {
                                add_message_send_by_system(e.message)
                            }
                            update_new_message_in_chat_room_send_by_system(e.message)
                        } else {
                            if (room_id == e.message.room_id) {
                                add_my_receive_message(e.name, e.img, e.message, new Date(e.message
                                    .created_at))
                            }
                            update_new_message_in_chat_room(e.message.message, e.message.created_at, e.message
                                .room_id)
                            scroll_to_bottom_message_container()
                        }
                    })
            @endforeach
            // back to room lists
            $('.back-to-room-col').on('click', function() {
                $('.room-col').removeClass('d-none')
                $('.chat-col').addClass('d-none')
                $('.info-col').addClass('d-none')
            })
            // show room-info
            $('.show-room-info').on('click', function() {
                $('.room-col').addClass('d-none')
                $('.chat-col').addClass('d-none')
                $('.info-col').removeClass('d-none')
            })
            // back to chat-col
            $('.back-to-chat-col').on('click', function() {
                $('.room-col').addClass('d-none')
                $('.chat-col').removeClass('d-none')
                $('.info-col').addClass('d-none')
            })
            // file upload show pre upload
            $('#files').change(function(e) {
                e.preventDefault();
                if (this.files) {
                    $('.files-container').removeClass('d-none')
                    var htm = ''
                    var filesAmount = this.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        file = this.files[i]
                        images[images.length] = file
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            preview_images[preview_images.length] = event.target.result
                            htm = '<div class="avatar-sm position-relative img-thumbnail mx-1">'
                            htm += '<img src="' +
                                event.target
                                .result +
                                '" class="rounded w-100 h-100" style="object-fit: cover;">'
                            htm +=
                                '<a class="remove-image" href="javascript: void(0);" style="display: inline;">&#215;</a>'
                            htm += '</div>'
                            $('.files-container .row').append(htm)
                        }
                        reader.readAsDataURL(file);
                    }
                    $("#files").val('')
                }
            })
            // remove file upload
            $('.files-container').on('click', '.remove-image', function() {
                var index = preview_images.indexOf($(this).parent().find('img').attr('src'));
                if (index > -1) { // only splice array when item is found
                    preview_images.splice(index, 1); // 2nd parameter means remove one item only
                    images.splice(index, 1); // 2nd parameter means remove one item only
                    $(this).parent().remove()
                }
                if (!preview_images.length) {
                    $('.files-container').addClass('d-none')
                }
            })
            // add users to room
            $('.add-users').on('click', function() {
                users = $('#add-users-select').val()
                if (users.length) {
                    $.ajax({
                        method: 'post',
                        url: "{{ route('add-users-chat') }}",
                        dataType: "json",
                        data: {
                            id: room_id,
                            users: users,
                        },
                        success: function(res) {
                            if (res) {
                                $('#add-users-select').val(null).trigger('change');
                            }
                        }
                    });
                }
            })
            // start session
            $('.start-session').on('click', function() {
                $.ajax({
                    method: 'post',
                    url: "{{ route('start-session-chat') }}",
                    dataType: "json",
                    data: {
                        id: room_id,
                    },
                    success: function(res) {}
                });
            })
            // end session
            $('.end-session').on('click', function() {
                $.ajax({
                    method: 'post',
                    url: "{{ route('end-session-chat') }}",
                    dataType: "json",
                    data: {
                        id: room_id,
                    },
                    success: function(res) {}
                });
            })
            // join room
            $('.join-room').on('click', function(e) {
                $.ajax({
                    method: 'post',
                    url: "{{ route('join-room-chat') }}",
                    dataType: "json",
                    data: {
                        id: room_id,
                    },
                    success: function(res) {
                        if (res) {
                            $('#chat-form').removeClass('d-none')
                            $('.add-users-group').removeClass('d-none')
                            $('.alert-join-room').addClass('d-none')
                            $('button.join-room').addClass('d-none')
                        }
                    }
                });

            })
            // scroll to load more
            $('.conversation-list .simplebar-content-wrapper').scroll(function() {
                if ($(this).scrollTop() == 0) {
                    if (load_more && page != last_page) {
                        load_more = false
                        var before_height = $('.conversation-list .simplebar-content').height()
                        var htm =
                            '<button class="btn btn-primary w-100 pre-message-loading mb-1" type="button" disabled>'
                        htm +=
                            '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>'
                        htm += 'Đang tải...'
                        htm += '</button>'
                        $('.conversation-list .simplebar-content').prepend(htm);
                        $.ajax({
                            method: 'get',
                            url: "{{ route('get-messages') }}",
                            dataType: "json",
                            data: {
                                id: room_id,
                                page: page + 1
                            },
                            success: function(res) {
                                message_ajax_to_element(res)
                                $('.conversation-list .simplebar-content-wrapper').scrollTop(
                                    $('.conversation-list .simplebar-content').height() -
                                    before_height);
                                $(".conversation-list .simplebar-content .pre-message-loading")
                                    .remove()
                            },
                            error: function() {
                                $('.chat-conatiner .pre-loader-error').removeClass('d-none')
                            }
                        });
                        load_more = true
                    }
                }
            });
            // load room
            $('.chat-rooms-conatiner').on('click', '.chat-room', function() {
                $('.chat-conatiner').removeClass('d-none')
                $('.chat-info').removeClass('d-none')
                if ($(window).width() <= 992) {
                    $('.room-col').addClass('d-none')
                    $('.info-col').addClass('d-none')
                }
                $('.chat-col').removeClass('d-none')
                if (room_id != $(this).data('id')) {
                    $('.chat-room .chat-room-badge.bg-light').removeClass('bg-light')
                    $('.chat-conatiner .pre-loader').removeClass('d-none')
                    $('.chat-info .pre-loader').removeClass('d-none')
                    $('.workspace-session').addClass('d-none')
                    $('.workspace-session .start-session').addClass('d-none')
                    $('.workspace-session .end-session').addClass('d-none')
                    $('.add-users-group').addClass('d-none')
                    $('.workspace-session .time-session').addClass(
                        'd-none')
                    $('.chat-navigation .room-name').html($(this).find('.room-name').html());
                    $('.chat-navigation .chat-room-img').html($(this).find('.chat-room-img').html());
                    clearInterval(count_up);
                    clear_message()
                    preview_images = []
                    images = []
                    $('.files-container').addClass('d-none')
                    $('.files-container .row div').remove()
                    room_id = $(this).data('id')
                    $('.chat-room[data-id=' + room_id + '] .chat-room-badge').addClass('bg-light')
                    // load room info
                    $.ajax({
                        method: 'get',
                        url: "{{ route('get-room-info') }}",
                        dataType: "json",
                        data: {
                            id: room_id,
                        },
                        success: function(res) {
                            set_name_image_chat_info(res.name, res.imgs)
                            update_users_in_list_users_in_room(res.join_users)
                            if (!res.joined_room) {
                                $('#chat-form').addClass('d-none')
                                $('.alert-join-room').removeClass('d-none')
                                $('button.join-room').removeClass('d-none')
                            } else {
                                $('#chat-form').removeClass('d-none')
                                $('.alert-join-room').addClass('d-none')
                                $('button.join-room').addClass('d-none')
                                @if ($user->type == 'system')
                                    $('.add-users-group').removeClass('d-none')
                                @endif
                                if (res.is_workspace) {
                                    $('.workspace-session').removeClass('d-none')
                                    if (res.has_session) {
                                        @if ($user->type == 'system')
                                            $('.workspace-session .end-session').removeClass(
                                                'd-none')
                                        @endif
                                        $('.workspace-session .time-session').removeClass(
                                            'd-none')
                                        $('.add-users-group').addClass('d-none')
                                        timer_count_up(new Date(res.session_start_on))
                                    } else if (res.join_users.filter(function(user) {
                                            return user.type == 'customer'
                                        })) {
                                        @if ($user->type == 'system')
                                            $('.workspace-session .start-session').removeClass(
                                                'd-none')
                                        @endif
                                    }
                                }
                            }
                            $('.chat-info .pre-loader').addClass('d-none')
                            $('.chat-info .pre-loader-error').addClass('d-none')
                        },
                        error: function() {
                            $('.chat-info .pre-loader-error').removeClass('d-none')
                        }
                    });
                    // load message
                    $.ajax({
                        method: 'get',
                        url: "{{ route('get-messages') }}",
                        dataType: "json",
                        data: {
                            id: room_id,
                        },
                        success: function(res) {
                            message_ajax_to_element(res)
                            $('.chat-conatiner .pre-loader').addClass('d-none')
                            $('.chat-conatiner .pre-loader-error').addClass('d-none')
                            scroll_to_bottom_message_container()
                            load_more = true
                        },
                        error: function() {
                            $('.chat-conatiner .pre-loader-error').removeClass('d-none')
                        }
                    });
                }
            })
            // send message
            $('#chat-form').on('submit', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var message = $('#message').val()
                var form_data = new FormData()
                form_data.append("id", room_id);
                form_data.append("message", message);
                random_message_id = Math.floor(Math.random() * 100000000000000)
                form_data.append("random_message_id", random_message_id);
                images.forEach(img => {
                    form_data.append("images[]", img);
                });
                add_my_send_message(message, new Date(), true, random_message_id)
                $('#message').val('')
                update_new_message_in_chat_room(message)
                scroll_to_bottom_message_container()
                preview_images = []
                images = []
                $('.files-container').addClass('d-none')
                $('.files-container .row div').remove()
                $.ajax({
                    method: 'post',
                    url: "{{ route('send-message-to-user') }}",
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data: form_data,
                    success: function(res) {
                        if (res) {
                            $('div[data-random_message_id=' + res.random_message_id + ']').each(
                                function(index) {
                                    htm = '<a href="' +
                                        res.message_files[index].file + '" target="_blank">'
                                    htm += '<img src="' + res.message_files[index].file +
                                        '" class="rounded w-100 h-100 p-0" style="object-fit: cover;">'
                                    htm += '</a>'
                                    $(this).html(htm)
                                })
                        }
                    }
                });

            })
            // remove user
            $('.list-users-in-room').on('click', '.remove-user', function() {
                var user_id = $(this).attr('data-id');
                $.ajax({
                    method: 'post',
                    url: "{{ route('kick-user-chat') }}",
                    dataType: "json",
                    data: {
                        id: room_id,
                        user_id: user_id
                    },
                    success: function(res) {}
                });
            })
            // init select users add to chat
            $('#add-users-select').select2({
                ajax: {
                    url: "{{ route('get-customers') }}",
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            room_id: room_id,
                        }
                        return query;
                    },
                    processResults: function(data) {
                        console.log(data);
                        return {
                            results: data
                        };
                    },
                    delay: 250,
                    cache: true,
                    minimumInputLength: 4,
                },
                templateResult: formatSelect,
                templateSelection: formatSelectSelection,
            });
            // format select users add to chat
            function formatSelect(data) {
                if (data.loading) {
                    return $('<span>Đang tải...</span>')
                }
                var htm = '<div class="d-flex align-items-center">'
                htm += '<img src="'
                if (data && data.profile && data.profile.img) {
                    htm += data.profile.img
                } else {
                    htm += 'resources/assets/images/users/avatar-1.jpg'
                }
                htm +=
                    '" class="rounded-circle img-thumbnail me-2 p-0 bottom-0 end-0" style="object-fit: cover;height:36px; width:36px;">'
                htm += '<span class="text-body fw-semibold">'
                htm += data.name
                htm += '<br>'
                htm += '<small class="text-body fw-semibold">'
                htm += data.username
                htm += '</small>'
                htm += '</span>'
                htm += '</div>'
                var $select_option = $(htm);
                return $select_option;
            }
            // format selected users add to chat
            function formatSelectSelection(data) {
                var htm = '<div class="d-flex align-items-center text-start">'
                htm += '<img src="'
                if (data && data.profile && data.profile.img) {
                    htm += data.profile.img
                } else {
                    htm += 'resources/assets/images/users/avatar-1.jpg'
                }
                htm +=
                    '" class="rounded-circle img-thumbnail me-2 p-0 bottom-0 end-0" style="object-fit: cover;height:36px; width:36px;">'
                htm += '<span class="fw-semibold">'
                htm += data.name
                htm += '<br>'
                htm += '<small class="fw-semibold">'
                htm += data.username
                htm += '</small>'
                htm += '</span>'
                htm += '</div>'
                var $select_option = $(htm);
                return $select_option;
            }

            function update_room_status(is_workspace, has_session, join_users, c_room_id) {
                var room_status = $(".chat-room[data-id=" + c_room_id + "] .room-status")
                if (is_workspace) {
                    $(room_status).parent().removeClass('d-none');
                    if (has_session) {
                        $('.workspace-session').removeClass('d-none')
                        @if ($user->type == 'system')
                            $('.end-session').removeClass('d-none')
                            $('.start-session').addClass('d-none')
                        @endif
                        $('.time-session').removeClass('d-none')
                        $(room_status).removeAttr('class');
                        $(room_status).addClass('badge badge-danger-lighten room-status');
                    } else if (join_users.filter(function(user) {
                            return user.type == 'customer'
                        }).length) {
                        @if ($user->type == 'system')
                            $('.workspace-session').removeClass('d-none')
                            $('.end-session').addClass('d-none')
                            $('.time-session').addClass('d-none')
                            $('.start-session').removeClass('d-none')
                        @endif
                        $(room_status).removeAttr('class');
                        $(room_status).addClass('badge badge-warning-lighten room-status');
                    } else {
                        $('.workspace-session').addClass('d-none')
                        $(room_status).removeAttr('class');
                        $(room_status).addClass('badge badge-success-lighten room-status');
                    }
                } else {
                    $(room_status).parent().addClass('d-none');
                    $('.workspace-session').addClass('d-none')
                }
            }

            function update_new_message_in_chat_room(message, date, room = null) {
                if (message) {
                    var html = message;
                    html = html.replaceAll("<div>", " ")
                    html = html.replaceAll("</div>", " ")
                    html = html.replaceAll("<br>", " ")
                    var div = document.createElement("div");
                    div.innerHTML = html;
                    var text = div.textContent || div.innerText || "";
                    $(".chat-room[data-id=" + (room ?? room_id) + "] .new-message").html(text);
                }
                if (date) {
                    $(".chat-room[data-id=" + (room ?? room_id) + "] .last-message-time").html(time_ago(new Date(
                        date)));
                    $(".chat-room[data-id=" + (room ?? room_id) + "] .last-message-time").attr('data-time', date);
                } else {
                    $(".chat-room[data-id=" + (room ?? room_id) + "] .last-message-time").html(time_ago(
                        new Date()));
                    $(".chat-room[data-id=" + (room ?? room_id) + "] .last-message-time").attr('data-time',
                        new Date());
                }
            }

            function timer_count_up(date) {
                var countDownDate = date.getTime();
                count_up = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = now - countDownDate;
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    var day_elem = $('.workspace-session .time-session .day')
                    var hour_elem = $('.workspace-session .time-session .hour')
                    var minute_elem = $('.workspace-session .time-session .minute')
                    var second_elem = $('.workspace-session .time-session .second')
                    if (days) {
                        $(day_elem).removeClass(
                            'd-none')
                        $(day_elem).html(days + 'days')
                    } else {
                        $(day_elem).addClass(
                            'd-none')
                    }
                    if (hours) {
                        $(hour_elem).removeClass(
                            'd-none')
                        $(hour_elem).html(hours + 'hours')
                    } else {
                        $(hour_elem).addClass(
                            'd-none')
                    }
                    if (minutes) {
                        $(minute_elem).removeClass(
                            'd-none')
                        $(minute_elem).html(minutes + 'mins')
                    } else {
                        $(minute_elem).addClass(
                            'd-none')
                    }
                    if (seconds) {
                        $(second_elem).removeClass(
                            'd-none')
                        $(second_elem).html(seconds + 'secs')
                    } else {
                        $(second_elem).addClass(
                            'd-none')
                    }
                }, 1000);
            }

            function update_users_in_list_users_in_room(join_users) {
                var htm = ''
                join_users.reverse().forEach(element => {
                    htm += '<div class="d-flex align-items-center mb-2">'
                    htm +=
                        '<img src="' + (element.img ?? 'resources/assets/images/users/avatar-1.jpg') +
                        '" class="rounded-circle img-thumbnail me-2 p-0 bottom-0 end-0" style="object-fit: cover;height:36px; width:36px;">'
                    htm += '<span class="text-body fw-semibold">'
                    htm += element.name
                    htm += '<br>'
                    if (element.type == 'system') {
                        htm += '<span class="badge badge-danger-lighten p-1 font-12">Admin</span>'
                    } else if (element.type == 'partner') {
                        htm += '<span class="badge badge-primary-lighten p-1 font-12">Partner</span>'
                    } else {
                        htm += '<span class="badge badge-success-lighten p-1 font-12">Client</span>'
                    }
                    @if ($user->type == 'system')
                        if (element.type != 'partner') {
                            htm +=
                                '<span role="button" class="text-primary ms-2 font-12 remove-user" data-id="' +
                                element.id + '">Xóa</span>'
                            htm += '</span>'
                        }
                    @endif
                    htm += '</div>'
                });
                $('.list-users-in-room .simplebar-content').html(htm)
            }

            function set_name_image_chat_room(name, imgs, c_room_id) {
                $('.chat-room[data-id=' + c_room_id + '] .room-name').html(name)
                var htm = ''
                if (imgs.length == 1) {
                    htm += '<img src="' + (imgs[0] ??
                            'resources/assets/images/users/avatar-1.jpg') +
                        '" class="rounded-circle img-thumbnail p-0" style="object-fit: cover; height:48px; width:48px;" />'
                } else {
                    htm +=
                        '<div class="position-relative" style="width: 48px; height: 48px;">'
                    imgs.forEach((img, index) => {
                        htm += '<img src="' + (img ??
                                'resources/assets/images/users/avatar-1.jpg'
                            ) +
                            '" class="rounded-circle img-thumbnail position-absolute p-0 ' +
                            (index % 2 == 0 ? 'top-0' : 'bottom-0') + ' ' +
                            (
                                index % 2 == 0 ? 'start-0' : 'end-0') +
                            '" style="object-fit: cover; height:36px; width:36px;" />'

                    });
                    htm += '</div>'
                }
                $('.chat-room[data-id=' + c_room_id + '] .chat-room-img').html(htm)
            }

            function set_name_image_chat_info(name, imgs) {
                $('.chat-info-name').html(name)
                if (imgs.length == 1) {
                    $('.chat-info-img').attr('src', imgs[0] ??
                        'resources/assets/images/users/avatar-1.jpg')
                    $('.chat-info-img').attr('alt', name)
                    $('.chat-info-img').removeClass('d-none')
                    $('.chat-info-imgs').addClass('d-none')
                } else {
                    var htm = ''
                    imgs.forEach((img, index) => {
                        htm += '<img src="' + (img ??
                                'resources/assets/images/users/avatar-1.jpg'
                            ) +
                            '" class="rounded-circle img-thumbnail avatar-sm" style="object-fit: cover;" alt="' +
                            name + '" />'
                    });
                    $('.chat-info-imgs').html(htm)
                    $('.chat-info-imgs').removeClass('d-none')
                    $('.chat-info-img').addClass('d-none')
                }
            }
            // ajax response json to messages
            function message_ajax_to_element(res) {
                var now = new Date()
                res.forEach(message => {
                    date = new Date(message.created_at)
                    var htm = ''
                    if (date.getFullYear() != now.getFullYear() || date.getMonth() != now.getMonth() ||
                        date
                        .getDate() != now.getDate()) {
                        htm = '<li class = "text-center date-message">'
                        htm += '<span class="badge badge-success-lighten">' + now.getDate() + '/' + now
                            .getMonth() + '/' + now.getFullYear() + '</span>'
                        htm += '</li>'
                        $('.conversation-list .simplebar-content').prepend(htm);
                        now = date
                    }
                    if (!message.user_id) {
                        add_message_send_by_system(message, false)
                    } else if (message.user_id == {{ $user->id }}) {
                        add_my_send_message(message, date, false)
                    } else {
                        var avatar = 'resources/assets/images/users/avatar-1.jpg'
                        if (message.user.profile && message.user.profile.img) {
                            avatar = message.user.profile.img
                        }
                        add_my_receive_message(
                            message.user.name,
                            avatar,
                            message,
                            date,
                            false)
                    }
                });
                page = res.current_page
                last_page = res.last_page
            }

            function add_message_send_by_system(message, append = true) {
                var system_message = ''
                if (message.message.indexOf("add-user") == 0) {
                    system_message = 'Đã thêm ' + message.message.substring(message.message.indexOf(
                        " "), message.message.length)
                } else if (message.message.indexOf("kick-user") == 0) {
                    system_message = 'Đã xóa ' + message.message.substring(message.message.indexOf(
                        " "), message.message.length)
                } else if (message.message.indexOf("start-session") == 0) {
                    system_message = 'Bắt đầu phiên làm việc'
                } else if (message.message.indexOf("end-session") == 0) {
                    system_message = 'Kết thúc phiên làm việc'
                }
                htm = '<li class = "text-center date-message">'
                htm += '<span class="badge badge-secondary-lighten">' + system_message + '</span>'
                htm += '</li>'
                if (append) {
                    $('.conversation-list .simplebar-content').append(htm);
                } else {
                    $('.conversation-list .simplebar-content').prepend(htm);
                }
                scroll_to_bottom_message_container()
            }

            function update_new_message_in_chat_room_send_by_system(message) {
                var system_message = ''
                if (message.message.indexOf("add-user") == 0) {
                    system_message = 'Đã thêm ' + message.message.substring(message.message.indexOf(
                        " "), message.message.length)
                } else if (message.message.indexOf("kick-user") == 0) {
                    system_message = 'Đã xóa ' + message.message.substring(message.message.indexOf(
                        " "), message.message.length)
                } else if (message.message.indexOf("start-session") == 0) {
                    system_message = 'Bắt đầu phiên làm việc'
                } else if (message.message.indexOf("end-session") == 0) {
                    system_message = 'Kết thúc phiên làm việc'
                }

                $(".chat-room[data-id=" + (message.room_id) + "] .new-message").html(system_message);
                $(".chat-room[data-id=" + (message.room_id) + "] .last-message-time").html(time_ago(
                    new Date(
                        message.created_at)));
                $(".chat-room[data-id=" + (message.room_id) + "] .last-message-time").attr('data-time',
                    message.created_at);
            }

            function clear_message() {
                $('.conversation-list .simplebar-content').html('')
            }

            function scroll_to_bottom_message_container() {
                $(".conversation-list .simplebar-content-wrapper").animate({
                    scrollTop: $(
                            '.conversation-list .simplebar-content-wrapper .simplebar-content')
                        .height()
                }, 1);
            }

            function add_my_send_message(message, date = new Date(), append = true, random_message_id = null) {
                var htm = '<li class="clearfix odd">'
                htm += '<div class="chat-avatar">'
                htm +=
                    '<img src="{{ asset($user->profile->img ?? 'resources/assets/images/users/avatar-1.jpg') }}" class="rounded" alt="{{ $user->name }}" />'
                htm += '<i>' + date.getHours() + ':' + date.getMinutes() + '</i>'
                htm += '</div>'
                htm += '<div class="conversation-text">'
                htm += '<div class="ctext-wrap">'
                htm += '<i>{{ $user->name }}</i>'
                htm += '<p>'
                htm += message.message ?? message
                htm += '</p>'
                if (message.files && message.files.length) {
                    htm += '<div class="card mb-1 shadow-none border p-2">'
                    htm += '<div class="row g-1">'
                    message.files.forEach(file => {
                        htm += '<a href="' +
                            file.file + '" target="_blank">'
                        htm += '<img src="' + file.file +
                            '" class="rounded w-100 h-100 p-0" style="object-fit: cover;">'
                        htm += '</a>'
                    });
                    htm += '</div>'
                    htm += '</div>'
                } else if (preview_images.length) {
                    htm += '<div class="card mb-1 shadow-none border p-2">'
                    htm += '<div class="row g-1">'
                    preview_images.forEach(preview_image => {
                        htm +=
                            '<div class="col-12 position-relative m-0 p-0" data-random_message_id="' +
                            random_message_id + '">'
                        htm += '<div class="spinner-border" role="status">'
                        htm += '<span class="visually-hidden">Loading...</span>'
                        htm += '</div>'
                        htm += '</div>'
                    });
                    htm += '</div>'
                    htm += '</div>'
                }
                htm += '</div>'
                htm += '</div>'
                // if (message.files && message.files.length) {

                //     htm += '<div class="conversation-actions dropdown">'
                //     htm +=
                //         '<button class="btn btn-sm btn-link" data-bs-toggle="dropdown" aria-expanded="false"><i class="uil uil-ellipsis-v "></i></button>'
                //     htm += '<div class="dropdown-menu">'
                //     htm += '<a class="dropdown-item" href="#">Download</a>'
                //     // htm += '<a class="dropdown-item" href="#">Edit</a>'
                //     // htm += '<a class="dropdown-item" href="#">Delete</a>'
                //     htm += '</div>'
                //     htm += '</div>'
                // }
                htm += '</li>'
                // $(htm).insertAfter('li.clearfix:last-child');
                if (append) {
                    $('.conversation-list .simplebar-content').append(htm);
                } else {
                    $('.conversation-list .simplebar-content').prepend(htm);
                }
            }

            function add_my_receive_message(name, img, message, date, append = true) {
                var htm = '<li class="clearfix">'
                htm += '<div class="chat-avatar">'
                htm += '<img src="' + (img) + '" class="rounded"'
                htm += 'alt="' + name + '" />'
                htm += '<i>' + date.getHours() + ':' + date.getMinutes() + '</i>'
                htm += '</div>'
                htm += '<div class="conversation-text">'
                htm += '<div class="ctext-wrap">'
                htm += '<i>' + name + '</i>'
                htm += '<p>'
                htm += message.message
                htm += '</p>'
                if (message.files && message.files.length) {
                    htm +=
                        '<div class="card mb-1 shadow-none border p-2">'
                    htm += '<div class="row g-1">'
                    message.files.forEach(file => {
                        htm += '<a href="' +
                            file.file + '" target="_blank">'
                        htm += '<img src="' + file.file +
                            '" class="rounded w-100 h-100 p-0" style="object-fit: cover;">'
                        htm += '</a>'
                    });
                    htm += '</div>'
                    htm += '</div>'


                }
                htm += '</div>'
                htm += '</div>'
                // if (message.files && message.files.length) {
                //     htm += '<div class="conversation-actions dropdown">'
                //     htm +=
                //         '<button class="btn btn-sm btn-link" data-bs-toggle="dropdown" aria-expanded="false"><i class="uil uil-ellipsis-v"></i></button>'
                //     htm += '<div class="dropdown-menu dropdown-menu-end">'
                //     htm += '<a class="dropdown-item" href="#">Download</a>'
                //     // htm += '<a class="dropdown-item" href="#">Edit</a>'
                //     // htm += '<a class="dropdown-item" href="#">Delete</a>'
                //     htm += '</div>'
                //     htm += '</div>'
                // }
                htm += '</li>'
                if (append) {
                    $('.conversation-list .simplebar-content').append(htm);
                } else {
                    $('.conversation-list .simplebar-content').prepend(htm);
                }
            }

            function time_ago(date) {
                var now = new Date()
                time_elapsed = Math.floor((now.getTime() - date.getTime()) / 1000)
                var seconds = time_elapsed
                var minutes = Math.floor(time_elapsed / 60)
                var hours = Math.floor(time_elapsed / 3600)
                var days = Math.floor(time_elapsed / 86400)
                var weeks = Math.floor(time_elapsed / 604800)
                var months = Math.floor(time_elapsed / 2600640)
                var years = Math.floor(time_elapsed / 31207680)
                // Seconds
                if (seconds <= 60) {
                    return 'Bây giờ'
                }
                //Minutes
                else if (minutes <= 60) {
                    return minutes + ' phút trước'
                }
                //Hours
                else if (hours <= 24) {
                    return hours + ' giờ trước'
                }
                //Days
                else if (days <= 7) {
                    return days + ' ngày trước'
                }
                //Weeks
                else if (weeks <= 4.3) {
                    return weeks + ' tuần trước'
                }
                //Months
                else if (months <= 12) {
                    return months + ' tháng trước'
                }
                //Years
                else {
                    return years + ' năm trước'
                }
            }
            // update time ago
            setInterval(() => {
                $(".chat-room[data-id=" + room_id + "] .last-message-time").each(function() {
                    if ($(this).attr('data-time')) {
                        $(this).html(time_ago(new Date($(this).attr('data-time'))))
                    }
                });
            }, 60000);
        });
    </script>
@endsection
@section('css')
    <style>
        .room-name,
        .new-message {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: normal;
        }

        .select2-selection__choice {
            display: flex;
            flex-direction: row-reverse;
            align-items: center;
        }

        .select2-selection__choice__remove {
            margin-left: 5px;
            margin-right: 0px;
        }

        .chat-avatar img {
            width: 42px;
            height: 42px;
            object-fit: cover;
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

        .conversation-list .odd .conversation-text,
        .conversation-list .conversation-text {
            width: 100% !important;
        }
    </style>
@endsection
