@extends('layouts.admin')
@section('title')
    Chat
@endsection
@php
    use App\Http\Controllers\Helper;
@endphp
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row mt-3">
            <!-- start chat users-->
            <div class="col-xxl-3 col-xl-6 order-xl-1">
                <div class="card h-100">
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
                        <div class="tab-content">
                            <div class="tab-pane show active p-3" id="allChat">
                                <!-- start search box -->
                                @include('avnchat::components.search-chat-room')
                                <!-- end search box -->
                                <!-- users -->
                                <div class="row">
                                    <div class="col">
                                        <div data-simplebar style="height: 550px">
                                            @foreach ($rooms as $room)
                                                @include('avnchat::components.chat-room', compact('room'))
                                            @endforeach
                                        </div> <!-- end slimscroll-->
                                    </div> <!-- End col -->
                                </div>
                                <!-- end users -->
                            </div> <!-- end Tab Pane-->
                            <div class="tab-pane p-3" id="partnerFree">
                                <!-- start search box -->
                                @include('avnchat::components.search-chat-room')
                                <!-- end search box -->
                                <!-- users -->
                                <div class="row">
                                    <div class="col">
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
                                        </div> <!-- end slimscroll-->
                                    </div> <!-- End col -->
                                </div>
                                <!-- end users -->
                            </div> <!-- end Tab Pane-->
                            <div class="tab-pane p-3" id="partnerBusy">
                                <!-- start search box -->
                                @include('avnchat::components.search-chat-room')
                                <!-- end search box -->
                                <!-- users -->
                                <div class="row">
                                    <div class="col">
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
                                        </div> <!-- end slimscroll-->
                                    </div> <!-- End col -->
                                </div>
                                <!-- end users -->
                            </div> <!-- end Tab Pane-->
                        </div> <!-- end tab content-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
            <!-- end chat users-->
            <!-- chat area -->
            <div class="col-xxl-6 col-xl-12 order-xl-2">
                <div class="card chat-conatiner d-none">
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
                        </ul>
                        <div class="row">
                            <div class="col">
                                <div class="mt-2 bg-light p-3 rounded">
                                    <div class="alert alert-primary d-none alert-join-room text-center" role="alert">
                                        Nhấn <a href="javascript:void(0);" class="alert-link join-room">Tham gia</a> để
                                        chat.
                                    </div>
                                    <form class="chat-form" name="chat-form" id="chat-form">
                                        <div class="row">
                                            <div class="col mb-2 mb-sm-0">
                                                <input type="text" class="form-control border-0"
                                                    placeholder="Enter your text" id="message" required="">
                                            </div>
                                            <div class="col-sm-auto">
                                                <div class="btn-group">
                                                    {{-- <a href="#" class="btn btn-light"><i
                                                            class="uil uil-paperclip"></i></a> --}}
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
            <div class="col-xxl-3 col-xl-6 order-xl-1 order-xxl-2">
                <div class="card chat-info d-none">
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
                        <div class="dropdown float-end">
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
                        </div>

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
                                <button class="btn btn-success btn-sm mt-1 start-sesion d-none"><i
                                        class='mdi mdi-connection me-1'></i>Bắt đầu phiên làm việc</button>
                                <button class="btn btn-danger btn-sm mt-1 end-sesion d-none"><i
                                        class='mdi mdi-clock-check-outline me-1'></i>Kết thúc phiên làm việc</button>
                                <p class="text-muted mt-2 font-14">Last Interacted: <strong>Few hours back</strong></p>
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
    <script>
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

        $('#add-users-select').select2({
            ajax: {
                url: "{{ route('get-users') }}",
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
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

        $(document).ready(function() {
            var room_id = null;
            var page = null;
            var last_page = null;
            var load_more = true;

            // listen chanel 
            window.Echo.private('chat.user.{{ $user->id }}')
                .listen('.newMessage', (e) => {
                    console.log(e);
                    if (room_id == e.room_id) {
                        add_my_receive_message(e.name, e.img, e.message)
                    } else {
                        $(".chat-room[data-id=" + room_id + "] .new-message").html(e.message);
                    }
                })

            // add csrf
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
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
                                set_name_image_chat_info(res.name, res.imgs)
                                set_name_image_chat_room(res.name, res.imgs)
                                update_users_in_list_users_in_room(res.join_users)
                            }
                        }
                    });
                }
            })
            // add users to room
            $('.start-session').on('click', function() {
                $.ajax({
                    method: 'post',
                    url: "{{ route('start-session-chat') }}",
                    dataType: "json",
                    data: {
                        id: room_id,
                    },
                    success: function(res) {
                        if (res) {
                            $('#add-users-select').val(null).trigger('change');
                            set_name_image_chat_info(res.name, res.imgs)
                            set_name_image_chat_room(res.name, res.imgs)
                            update_users_in_list_users_in_room(res.join_users)
                        }
                    }
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
                            set_name_image_chat_info(res.name, res.imgs)
                            set_name_image_chat_room(res.name, res.imgs)
                            update_users_in_list_users_in_room(res.join_users)
                            $('#chat-form').removeClass('d-none')
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
            $('.chat-room').on('click', function() {
                $('.chat-conatiner').removeClass('d-none')
                $('.chat-info').removeClass('d-none')
                if (room_id != $(this).data('id')) {
                    $('.chat-room .chat-room-badge.bg-light').removeClass('bg-light')
                    $('.chat-conatiner .pre-loader').removeClass('d-none')
                    $('.chat-info .pre-loader').removeClass('d-none')
                    $('.workspace-session').addClass('d-none')
                    $('.workspace-session .start-sesion').addClass('d-none')
                    $('.workspace-session .end-sesion').addClass('d-none')
                    $('.add-users-group').addClass('d-none')
                    clear_message()
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
                            if (!res.join_room) {
                                $('#chat-form').addClass('d-none')
                                $('.alert-join-room').removeClass('d-none')
                                $('button.join-room').removeClass('d-none')
                            } else {
                                $('#chat-form').removeClass('d-none')
                                $('.alert-join-room').addClass('d-none')
                                $('button.join-room').addClass('d-none')
                                $('.add-users-group').removeClass('d-none')
                                if (res.is_workspace) {
                                    $('.workspace-session').removeClass('d-none')
                                    $('.workspace-session .start-sesion').removeClass('d-none')
                                    $('.workspace-session .end-sesion').removeClass('d-none')
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
                var message = $('#message').val();
                add_my_send_message(message)
                $('#message').val('')
                $('.new-message').html(message)
                $.ajax({
                    method: 'post',
                    url: "{{ route('send-message-to-user') }}",
                    dataType: "json",
                    data: {
                        id: room_id,
                        message: message
                    },
                    success: function(res) {}
                });

            })

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
                    htm += '</span>'
                    htm += '</div>'
                });
                $('.list-users-in-room .simplebar-content').html(htm)
            }

            function set_name_image_chat_room(name, imgs) {
                $('.chat-room[data-id=' + room_id + '] .room-name').html(name)
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
                $('.chat-room[data-id=' + room_id + '] .chat-room-img').html(htm)
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
                    console.log(imgs);
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
                res.data.forEach(message => {
                    date = new Date(message.created_at)
                    if (date.getFullYear() != now.getFullYear() || date.getMonth() != now.getMonth() ||
                        date
                        .getDate() != now.getDate()) {
                        var htm = '<li class = "text-center date-message">'
                        htm += '<span class="badge badge-success-lighten">' + now.getDate() + '/' + now
                            .getMonth() + '/' + now.getFullYear() + '</span>'
                        htm += '</li>'
                        $('.conversation-list .simplebar-content').prepend(htm);
                        now = date
                    }
                    if (message.user_id == {{ $user->id }}) {
                        add_my_send_message(message.message, date, false)
                    } else {
                        var avatar = 'resources/assets/images/users/avatar-1.jpg'
                        if (message.user.profile.img) {
                            avatar = message.user.profile.img
                        }
                        add_my_receive_message(
                            message.user.name,
                            avatar,
                            message.message,
                            date,
                            false)
                    }
                });
                page = res.current_page
                last_page = res.last_page
            }

            function clear_message() {
                $('.conversation-list .clearfix').remove()
            }

            function scroll_to_bottom_message_container() {
                $(".conversation-list .simplebar-content-wrapper").animate({
                    scrollTop: $(
                            '.conversation-list .simplebar-content-wrapper .simplebar-content')
                        .height()
                }, 1500);
            }

            function add_my_send_message(message, date = new Date(), append = true) {
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
                htm += message
                htm += '</p>'
                htm += '</div>'
                htm += '</div>'
                htm += '<div class="conversation-actions dropdown">'
                htm +=
                    '<button class="btn btn-sm btn-link" data-bs-toggle="dropdown" aria-expanded="false"><i class="uil uil - ellipsis - v "></i></button>'
                htm += '<div class="dropdown-menu">'
                htm += '<a class="dropdown-item" href="#">Copy Message</a>'
                htm += '<a class="dropdown-item" href="#">Edit</a>'
                htm += '<a class="dropdown-item" href="#">Delete</a>'
                htm += '</div>'
                htm += '</div>'
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
                htm += message
                htm += '</p>'
                htm += '</div>'
                htm += '</div>'
                htm += '<div class="conversation-actions dropdown">'
                htm +=
                    '<button class="btn btn-sm btn-link" data-bs-toggle="dropdown" aria-expanded="false"><i class="uil uil-ellipsis-v"></i></button>'
                htm += '<div class="dropdown-menu dropdown-menu-end">'
                htm += '<a class="dropdown-item" href="#">Copy Message</a>'
                htm += '<a class="dropdown-item" href="#">Edit</a>'
                htm += '<a class="dropdown-item" href="#">Delete</a>'
                htm += '</div>'
                htm += '</div>'
                htm += '</li>'
                if (append) {
                    $('.conversation-list .simplebar-content').append(htm);
                } else {
                    $('.conversation-list .simplebar-content').prepend(htm);
                }
            }
        });
    </script>
@endsection
@section('css')
    <style>
        .new-message {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            line-clamp: 3;
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
    </style>
@endsection
