@php
    $seo_props = [];
    $seo_props['seo_title'] = 'Chat';
@endphp
@extends('layouts.guest', $seo_props)
@php
    use App\Http\Controllers\Helper;
@endphp
@section('content')
    <div class="container">
        <div class="row mt-3">
            <!-- start chat users-->
            <div class="col-xl-3 room-col">
                @include('avnchat::components.chat-users', [$user, $rooms])
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
                                <img src="#" class="rounded-circle img-thumbnail p-0"
                                    style="object-fit: cover; height:48px; width:48px;">
                            </div>
                            <div class="w-100 overflow-hidden">
                                <h4 class="mt-0 mb-0 room-name"></h4>
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
                            <!--avatar-->
                            <img src="#" alt=""
                                class="img-thumbnail avatar-lg rounded-circle chat-info-img d-none"
                                style="object-fit: cover" />
                            <!--avatars-->
                            <div class="position-relative chat-info-imgs d-none" style="height: 3rem;"></div>
                            <!--room name-->
                            <h4 class="chat-info-name"></h4>
                            <button class="btn btn-success btn-sm mt-1 start-call d-none" id="start-call"
                                data-bs-toggle="modal" data-bs-target="#start-call-modal">
                                <i class='mdi mdi-phone me-1'></i>Gọi nhóm
                            </button>
                            <button class="btn btn-danger btn-sm mt-1 admin-stop-call d-none" id="admin-stop-call">
                                <i class='mdi mdi-phone-hangup me-1'></i>Kết thúc
                            </button>
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
                            @if ($user->type == 'system')
                                <button class="btn btn-primary btn-sm mt-1 join-room"><i
                                        class='uil uil-plus me-1'></i>Tham
                                    gia</button>
                                <div class="group text-center mt-1 add-users-group d-none">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card-header border-0 pb-0" id="headingOne">
                                            <h5 class="m-0">
                                                <a class="custom-accordion-title d-block pt-2 pb-2 text-primary"
                                                    data-bs-toggle="collapse" href="#change-info" aria-expanded="true"
                                                    aria-controls="change-info">
                                                    <i class="mdi mdi-information-outline"></i>
                                                    Thông tin đoạn chat
                                                    <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="change-info" class="collapse text-center" aria-labelledby="headingOne"
                                            data-bs-parent="#accordionExample">
                                            <div class="card-body pt-0">
                                                <hr>
                                                <label class="form-label">Tên đoạn chat</label>
                                                <input type="text" name="room_chat_name" id="room_chat_name"
                                                    class="form-control">
                                                <label class="form-label mt-1">Thay đổi ảnh</label>
                                                <input type="file"accept="image/*" name="room_chat_image"
                                                    id="room_chat_image" class="form-control">
                                                <button class="btn btn-primary btn-sm mt-1 update-chat-room">
                                                    <i class='dripicons-checkmark'></i>
                                                    Cập nhật</button>
                                                <hr>
                                                <label class="form-label">Thêm thành viên</label>
                                                <!-- Multiple Select -->
                                                <select class="form-control" multiple="multiple"
                                                    data-placeholder="Choose ..." id="add-users-select">
                                                </select>
                                                <button class="btn btn-primary btn-sm mt-1 add-users">
                                                    <i class='uil uil-plus me-1'></i>
                                                    Thêm thành viên
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
    <!--start call modal-->
    <div id="start-call-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-5 position-relative text-center">
                    ...
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary p-0 rounded-circle avatar-sm fs-3 mx-1 microphone"
                        disabled><i class="mdi mdi-microphone"></i></button>
                    <button type="button" class="btn btn-danger p-0 rounded-circle avatar-sm fs-3 mx-1 stop-call"
                        disabled data-bs-dismiss="modal"><i class="mdi mdi-phone-hangup"></i></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="mini-start-call" class="d-none position-fixed bottom-0 end-0 bg-light p-1 me-1 mb-1 d-flex">
        <button type="button" class="btn bg-light bg-transparent p-0 rounded-circle avatar-sm fs-5 mx-1"
            data-bs-toggle="modal" data-bs-target="#start-call-modal">
            <i class="dripicons-duplicate"></i>
        </button>
        <button type="button" class="btn btn-secondary p-0 rounded-circle avatar-sm fs-5 mx-1 microphone"
            disabled="">
            <i class="mdi mdi-microphone"></i>
        </button>
        <button type="button" class="btn btn-danger p-0 rounded-circle avatar-sm fs-5 mx-1 stop-call" disabled="">
            <i class="mdi mdi-phone-hangup"></i>
        </button>
    </div>
    <!--incoming call-->
    <div id="incoming-call-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-5 text-center">
                    <img src="#" alt=""
                        class="img-thumbnail avatar-lg rounded-circle chat-info-img d-none" style="object-fit: cover" />
                    <div class="position-relative chat-info-imgs" style="height: 3rem;">
                    </div>
                    <h4 class="chat-info-name"></h4>
                    <h5 class="text-muted status">Cuộc gọi sẽ bắt đầu ngay khi bấm chấp nhận</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success p-0 rounded-circle avatar-sm fs-3 mx-1"
                        data-bs-dismiss="modal" id="accept-call"><i class="mdi mdi-phone"></i></button>
                    <button type="button" class="btn btn-danger p-0 rounded-circle avatar-sm fs-3 mx-1"
                        data-bs-dismiss="modal" id="cancel-call"><i class="mdi mdi-phone-hangup"></i></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--in call modal-->
    <div id="in-call-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-4 text-center position-relative">
                    <img src="#" alt=""
                        class="img-thumbnail avatar-lg rounded-circle chat-info-img d-none" style="object-fit: cover" />
                    <div class="position-relative chat-info-imgs" style="height: 3rem;">
                    </div>
                    <h4 class="chat-info-name"></h4>
                    <h5 class="text-muted status">Đang kết nối...</h5>
                    <div id="mixedaudio"></div>
                    <div class="d-flex joined-users flex-wrap justify-content-center mt-3">
                    </div>
                    <button class="btn bg-light position-absolute top-0 end-0 bg-transparent" data-bs-dismiss="modal"><i
                            class="mdi mdi-window-minimize"></i></button>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary p-0 rounded-circle avatar-sm fs-3 mx-1 microphone"
                        disabled>
                        <i class="mdi mdi-microphone"></i>
                    </button>
                    <button type="button" class="btn btn-danger p-0 rounded-circle avatar-sm fs-3 mx-1 stop-call"
                        data-bs-dismiss="modal">
                        <i class="mdi mdi-phone-hangup"></i>
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="mini-in-call" class="d-none position-fixed bottom-0 end-0 bg-light p-1 me-1 mb-1 d-flex">
        <button type="button" class="btn bg-light bg-transparent p-0 rounded-circle avatar-sm fs-5 mx-1"
            data-bs-toggle="modal" data-bs-target="#in-call-modal">
            <i class="dripicons-duplicate"></i>
        </button>
        <button type="button" class="btn btn-secondary p-0 rounded-circle avatar-sm fs-5 mx-1 microphone"
            disabled="">
            <i class="mdi mdi-microphone"></i>
        </button>
        <button type="button" class="btn btn-danger p-0 rounded-circle avatar-sm fs-5 mx-1 stop-call" disabled="">
            <i class="mdi mdi-phone-hangup"></i>
        </button>
    </div>
    <!--stop call-->
    <div id="stop-call-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-5 text-center">
                    <img src="#" alt=""
                        class="img-thumbnail avatar-lg rounded-circle chat-info-img d-none" style="object-fit: cover" />
                    <div class="position-relative chat-info-imgs" style="height: 3rem;">
                    </div>
                    <h4 class="chat-info-name"></h4>
                    <h4 class="text-muted status">Cuộc gọi đã kết thúc</h4>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger p-0 rounded-circle avatar-sm fs-3 mx-1"
                        data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/8.2.2/adapter.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
    @vite(['Modules/AvnChat/resources/assets/js/chat.js'])
    <script src="{{ asset('resources/js/janus.js') }}"></script>
    <script type="text/javascript">
        window.room_id = null;
        window.user_id = {{ $user->id }};

        window.room_calling_id = null;
        window.call_id = null;
        window.call_pin = null;
        window.is_calling = false;
        window.is_ringing = false;
        window.is_incall = false;

        window.last_load = null;
        window.load_more = true;
        window.count_up = null;
        window.start_call_timeout
        window.preview_images = [];
        window.images = [];
        window.incoming_call_modal = new bootstrap.Modal(document.getElementById('incoming-call-modal'), {
            keyboard: false
        })
        window.start_call_modal = new bootstrap.Modal(document.getElementById('start-call-modal'), {
            keyboard: false
        })
        window.in_call_modal = new bootstrap.Modal(document.getElementById('in-call-modal'), {
            keyboard: false
        })
        window.stop_call_modal = new bootstrap.Modal(document.getElementById('stop-call-modal'), {
            keyboard: false
        })
        // add csrf
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $(document).ready(function() {
            // listen chanel 
            window.Echo.private('joined.user.{{ $user->id }}')
                .listen('.newRoom', (e) => {
                    new_room(e.room_id)
                })
            @foreach ($rooms as $room)
                Echo_listen('chat.room.{{ $room->id }}')
            @endforeach

            // reconnect broadcast
            window.Echo.connector.pusher.connection.bind('unavailable', (payload) => {
                window.Echo.connector.pusher.connect();
            });
            /**
             * @param {String} chanel_name
             */
            function Echo_listen(chanel_name) {
                window.Echo.private(chanel_name)
                    .listen('.newMessage', (e) => {
                        $.ajax({
                            method: 'post',
                            url: "{{ route('received-message-to-user') }}",
                            dataType: "json",
                            data: {
                                id: e.message.id,
                                room_id: e.message.room_id,
                                read: e.message.room_id == room_id ? 1 : 0,
                            },
                            success: function(res) {},
                        });
                        if (e.message.room_id != room_id && !$('.chat-room[data-id=' + e.message.room_id +
                                '] .text-primary').length) {
                            var $new_message_span = $('.chat-room[data-id=' + e.message.room_id +
                                '] .new-message')
                            $new_message_span.addClass('text-primary')
                            $new_message_span.prev().append(
                                '<i class="mdi mdi-checkbox-blank-circle text-primary"></i>')
                        }
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
                                        console.log(res);
                                        if (!res) {
                                            if (e.message.room_id == room_id) {
                                                $('.alert-join-room').removeClass('d-none')
                                                $('#chat-form').addClass('d-none')
                                            }
                                            @if ($user->type != 'system')
                                                window.Echo.leave(chanel_name);
                                            @endif
                                        } else {
                                            console.log(res.joined_room);
                                            if (!res.joined_room) {
                                                $('.add-users-group').addClass('d-none')
                                                $('.join-room').removeClass('d-none')
                                                $('.alert-join-room').removeClass('d-none')
                                                $('#chat-form').addClass('d-none')
                                                @if ($user->type != 'system')
                                                    window.Echo.leave(chanel_name);
                                                @endif
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
                            scroll_to_bottom_message_container()
                        } else if (e.message.user_id != {{ $user->id }}) {
                            if (room_id == e.message.room_id) {
                                add_my_receive_message(e.name, e.img, e.message, new Date(e.message
                                    .created_at))
                            }
                            update_new_message_in_chat_room(e.message.message, e.message.created_at, e.message
                                .room_id)
                            scroll_to_bottom_message_container()
                        }
                        var room_chats = $(".chat-room[data-id=" + e.message.room_id + "]")
                        room_chats.each(function() {
                            $room_chat = $(this)
                            $room_chat.parent().prepend($room_chat.clone())
                            $room_chat.remove()
                        });
                    })
                    .listen('.newCall', (e) => {
                        if (!is_calling && !is_incall && !is_ringing) {
                            $('.microphone').addClass('disabled')
                            $('.stop-call').addClass('disabled')
                            is_ringing = true
                            window.incoming_call_modal.hide()
                            call_id = e.call_id
                            call_pin = e.call_pin
                            // incoming-call-modal
                            $('#incoming-call-modal .chat-info-name').html(e.name)
                            if (e.imgs.length == 1) {
                                $('#incoming-call-modal .chat-info-img').attr('src', e.imgs[0] ??
                                    'resources/assets/images/users/avatar-1.jpg')
                                $('#incoming-call-modal .chat-info-img').removeClass('d-none')
                                $('#incoming-call-modal .chat-info-imgs').addClass('d-none')
                            } else {
                                var htm = ''
                                e.imgs.forEach((img, index) => {
                                    htm += '<img src="' +
                                        (img ?? 'resources/assets/images/users/avatar-1.jpg') +
                                        '" class="rounded-circle img-thumbnail avatar-sm" style="object-fit: cover;"/>'
                                });
                                $('#incoming-call-modal .chat-info-imgs').html(htm)
                                $('#incoming-call-modal .chat-info-imgs').removeClass('d-none')
                                $('#incoming-call-modal .chat-info-img').addClass('d-none')
                            }
                            // in-call-modal
                            $('#in-call-modal .chat-info-name').html(e.name)
                            $('#in-call-modal .status').html('Đã kết nối...')
                            if (e.imgs.length == 1) {
                                $('#in-call-modal .chat-info-img').attr('src', e.imgs[0] ??
                                    'resources/assets/images/users/avatar-1.jpg')
                                $('#in-call-modal .chat-info-img').removeClass('d-none')
                                $('#in-call-modal .chat-info-imgs').addClass('d-none')
                            } else {
                                var htm = ''
                                e.imgs.forEach((img, index) => {
                                    htm += '<img src="' +
                                        (img ?? 'resources/assets/images/users/avatar-1.jpg') +
                                        '" class="rounded-circle img-thumbnail avatar-sm" style="object-fit: cover;"/>'
                                });
                                $('#in-call-modal .chat-info-imgs').html(htm)
                                $('#in-call-modal .chat-info-imgs').removeClass('d-none')
                                $('#in-call-modal .chat-info-img').addClass('d-none')
                            }
                            window.incoming_call_modal.show()
                        }
                        if (e.room_id == room_id && !$('.clearfix[data-call-id="' + e.call_id + '"]').length) {
                            console.log(e);
                            add_join_call_button(e.call_id, e.call_pin)
                        }
                        if (e.room_id == room_id) {
                            $('#start-call').addClass('d-none')
                            @if ($user->type == 'system')
                                $('#admin-stop-call').removeClass('d-none')
                            @endif
                        }
                    })
                    .listen('.stopCall', (e) => {
                        $('.clearfix[data-call-id=' + e.call_id + ']').remove()
                        if (e.room_id == room_id) {
                            @if ($user->type == 'system')
                                $('#admin-stop-call').addClass('d-none')
                            @endif
                            $('#start-call').removeClass('d-none')
                        }
                        if ((is_calling || is_incall || is_ringing) && call_id == e.call_id) {
                            window.incoming_call_modal.hide()
                            window.start_call_modal.hide()
                            $('#mini-start-call').addClass('d-none')
                            window.in_call_modal.hide()
                            $('#mini-in-call').addClass('d-none')

                            $('#stop-call-modal .chat-info-name').html(e.name)
                            if (e.imgs.length == 1) {
                                $('#stop-call-modal .chat-info-img').attr('src', e.imgs[0] ??
                                    'resources/assets/images/users/avatar-1.jpg')
                                $('#stop-call-modal .chat-info-img').removeClass('d-none')
                                $('#stop-call-modal .chat-info-imgs').addClass('d-none')
                            } else {
                                var htm = ''
                                e.imgs.forEach((img, index) => {
                                    htm += '<img src="' +
                                        (img ?? 'resources/assets/images/users/avatar-1.jpg') +
                                        '" class="rounded-circle img-thumbnail avatar-sm" style="object-fit: cover;"/>'
                                });
                                $('#stop-call-modal .chat-info-imgs').html(htm)
                                $('#stop-call-modal .chat-info-imgs').removeClass('d-none')
                                $('#stop-call-modal .chat-info-img').addClass('d-none')
                            }
                            window.stop_call_modal.show()
                            window.is_calling = false
                            window.is_incall = false
                            window.is_ringing = false
                            leave_audio_room()
                        }
                    })
            }

            // check file upload 
            $('label[for=files]').on('click', function(e) {
                if (images.length >= 4) {
                    e.preventDefault();
                    e.stopPropagation();
                    $.NotificationApp.send("Thất bại", "Tối đa 4 tệp", "bottom-right",
                        "rgba(0,0,0,0.2)", "error")
                }
            })

            // file upload show pre upload
            $('#files').change(function(e) {
                e.preventDefault();
                if (this.files) {
                    $('.files-container').removeClass('d-none')
                    var htm = ''
                    var filesAmount = this.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        if (images.length >= 4) {
                            $.NotificationApp.send("Thất bại", "Tối đa 4 tệp", "bottom-right",
                                "rgba(0,0,0,0.2)", "error")
                            break
                        }
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
                    if (load_more && last_load) {
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
                            url: "{{ route('load-messages') }}",
                            dataType: "json",
                            data: {
                                last_load: last_load,
                                id: room_id,
                            },
                            success: function(res) {
                                if (res.length) {
                                    last_load = res[res.length - 1].id ?? 0

                                } else {
                                    last_load = 0
                                }
                                message_ajax_to_element(res, false)
                                $('.conversation-list .simplebar-content-wrapper')
                                    .scrollTop(
                                        $('.conversation-list .simplebar-content')
                                        .height() -
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
                $(this).find('i.text-primary').remove()
                $(this).find('.text-primary').removeClass('text-primary')
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
                    if (typeof load_info !== 'undefined') {
                        load_info.abort()
                    }
                    if (typeof load_message !== 'undefined') {
                        load_message.abort()
                    }
                    // load room info
                    load_info = $.ajax({
                        method: 'get',
                        url: "{{ route('get-room-info') }}",
                        dataType: "json",
                        data: {
                            id: room_id,
                        },
                        success: function(res) {
                            set_name_image_chat_info(res.name, res.imgs)
                            update_users_in_list_users_in_room(res.join_users)
                            if (res.call_id) {
                                @if ($user->type == 'system')
                                    $('#admin-stop-call').removeClass('d-none')
                                @endif
                                $('#start-call').addClass('d-none')
                            } else {
                                @if ($user->type == 'system')
                                    $('#admin-stop-call').addClass('d-none')
                                @endif
                                $('#start-call').removeClass('d-none')
                            }
                            if ($('.chat-info-imgs').hasClass('d-none')) {
                                $('#start-call-modal .modal-body').html(
                                    $('.chat-info-img')[0].outerHTML +
                                    $('.chat-info-name')[0].outerHTML +
                                    "<h5 class='text-muted status'>Đang kết nối...</h5>" +
                                    '<button class="btn bg-light position-absolute top-0 end-0 bg-transparent" data-bs-dismiss="modal"><i class="mdi mdi-window-minimize"></i></button>'
                                );
                            } else {
                                $('#start-call-modal .modal-body').html(
                                    $('.chat-info-imgs')[0].outerHTML +
                                    $('.chat-info-name')[0].outerHTML +
                                    "<h5 class='text-muted status'>Đang kết nối...</h5>" +
                                    '<button class="btn bg-light position-absolute top-0 end-0 bg-transparent" data-bs-dismiss="modal"><i class="mdi mdi-window-minimize"></i></button>'
                                );
                            }
                            console.log(res);
                            if (res.call_id) {
                                add_join_call_button(res.call_id, res.call_pin)
                            }
                            $('#room_chat_name').val('')
                            $('#room_chat_image').val('')
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
                            // $('.chat-info .pre-loader-error').removeClass('d-none')
                        }
                    });
                    // load message
                    load_message = $.ajax({
                        method: 'get',
                        url: "{{ route('get-messages') }}",
                        dataType: "json",
                        data: {
                            id: room_id,
                        },
                        success: function(res) {
                            if (res.length) {
                                last_load = res[res.length - 1].id
                            } else {
                                last_load = 0
                            }
                            console.log(res);
                            message_ajax_to_element(res, false)
                            $('.chat-conatiner .pre-loader').addClass('d-none')
                            $('.chat-conatiner .pre-loader-error').addClass('d-none')
                            scroll_to_bottom_message_container()
                            load_more = true
                        },
                        error: function() {
                            // $('.chat-conatiner .pre-loader-error').removeClass('d-none')
                        }
                    });
                }
            })

            // update room info
            $(".update-chat-room").on('click', function(param) {
                var form_data = new FormData()
                form_data.append("id", room_id);
                if ($('#room_chat_name').val()) {
                    form_data.append("room_name", $('#room_chat_name').val());
                }
                if ($('#room_chat_image')[0].files.length) {
                    form_data.append("image", $('#room_chat_image')[0].files[0]);
                }
                $.ajax({
                    method: 'post',
                    url: "{{ route('update-room-chat') }}",
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data: form_data,
                    success: function(res) {
                        console.log(res);
                        set_name_image_chat_room(res.name, [res.img], res.id)
                        if (res.id == room_id) {
                            set_name_image_chat_info(res.name, [res.img])
                        }
                        $('#room_chat_image').val('')
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

            // send message
            $('#chat-form').on('submit', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var message = $('#message').val()
                var random_message_id = Math.floor(Math.random() * 100000000000000)

                var form_data = new FormData()
                form_data.append("id", room_id);
                form_data.append("message", message);
                form_data.append("random_message_id", random_message_id);
                images.forEach(img => {
                    form_data.append("images[]", img);
                });

                add_my_send_message(message, new Date(), true, random_message_id)
                update_new_message_in_chat_room(message)
                scroll_to_bottom_message_container()

                $('#message').val('')
                preview_images = []
                images = []
                $('.files-container').addClass('d-none')
                $('.files-container .row div').remove()

                var send_new_message = $.ajax({
                    method: 'post',
                    url: "{{ route('send-message-to-user') }}",
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data: form_data,
                    success: function(res) {
                        $('.clearfix[data-random_message_id=' + res.random_message_id +
                                '] .sending')
                            .removeClass('mdi-checkbox-blank-circle-outline')
                            .addClass('mdi-check-circle')
                        $('.clearfix[data-random_message_id=' + res.random_message_id + ']')
                            .attr('data-id', res.message.id)
                        if (res && res.message_files && res.message_files.length) {
                            $('.clearfix[data-random_message_id=' + res.random_message_id +
                                '] .img-container').each(
                                function(index) {
                                    htm = '<a href="' +
                                        res.message_files[index].file + '" target="_blank">'
                                    htm += '<img src="' + res.message_files[index].file +
                                        '" class="rounded w-100 h-100 p-0 mt-2" style="object-fit: cover;">'
                                    htm += '</a>'
                                    $(this).html(htm)
                                }
                            )
                        }
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

            /**
             * @param {Int} c_room_id
             */
            function new_room(c_room_id) {
                $.ajax({
                    method: 'get',
                    url: "{{ route('get-room-info') }}",
                    dataType: "json",
                    data: {
                        id: c_room_id,
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
                            htm += '<span class="ms-2 float-end text-end">'
                            htm += '<span class="badge badge-danger room-status d-none">'
                            htm += '<i class="uil uil-comment-alt-redo"></i>'
                            htm += '</span>'
                            htm += '</span>'
                            htm += '<span class="new-message text-truncate"></span>'
                            htm += '</p>'
                            htm += '</div>'
                            htm += '</div>'
                            htm += '</a>'
                            $('#allChat .simplebar-content').prepend(htm);
                        } else {
                            $('.alert-join-room').addClass('d-none')
                            $('#chat-form').removeClass('d-none')
                        }
                        Echo_listen('chat.room.' + res.room_id)
                        set_name_image_chat_room(res.name, res.imgs, res.room_id)
                        if (res.room_id == room_id) {
                            set_name_image_chat_info(res.name, res.imgs)
                            update_users_in_list_users_in_room(res.join_users)
                            scroll_to_bottom_message_container()
                        }
                        update_room_status(res.is_workspace, res.has_session, res
                            .join_users, res.room_id)
                        if (res.last_message) {
                            if (res.last_message.user_id) {
                                update_new_message_in_chat_room_send_by_system(message)
                            } else {
                                update_new_message_in_chat_room(res.last_message.message, res
                                    .last_message.created_at, res.last_message.room_id)
                            }
                        }
                        if (res.last_message.room_id != room_id && !$(
                                '.chat-room[data-id=' + res.last_message.room_id +
                                '] .text-primary').length) {
                            var $new_message_span = $('.chat-room[data-id=' +
                                res.last_message.room_id +
                                '] .new-message')
                            $new_message_span.addClass('text-primary')
                            $new_message_span.prev().append(
                                '<i class="mdi mdi-checkbox-blank-circle text-primary"></i>'
                            )
                        }
                    },
                });
            }

            /**
             * @param {Boolean} is_workspace
             * @param {Boolean} has_session
             * @param {JSON} join_users
             * @param {Int} c_room_id
             */
            function update_room_status(is_workspace, has_session, join_users, c_room_id) {
                var room_status = $(".chat-room[data-id=" + c_room_id + "] .room-status")
                if (is_workspace) {
                    $(room_status).removeClass('d-none');
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
                    $(room_status).addClass('d-none');
                    $('.workspace-session').addClass('d-none')
                }
            }

            /**
             * @param {String} message
             * @param {String} date
             * @param {Int} c_room_id
             */
            function update_new_message_in_chat_room(message, date, c_room_id = null) {
                $(".chat-room[data-id=" + (c_room_id ?? room_id) + "] .new-message").html(message);
                if (date) {
                    $(".chat-room[data-id=" + (c_room_id ?? room_id) + "] .last-message-time").html(time_ago(
                        new Date(
                            date)));
                    $(".chat-room[data-id=" + (c_room_id ?? room_id) + "] .last-message-time").attr('data-time',
                        date);
                } else {
                    $(".chat-room[data-id=" + (c_room_id ?? room_id) + "] .last-message-time").html(time_ago(
                        new Date()));
                    $(".chat-room[data-id=" + (c_room_id ?? room_id) + "] .last-message-time").attr('data-time',
                        new Date());
                }
            }

            /**
             * @param {JSON} join_users
             */
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

            /**
             * @param {String} name
             * @param {Array} imgs
             * @param {Int} c_room_id
             */
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

            /**
             * @param {String} name
             * @param {Array} imgs
             */
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
            /**
             * @param {JSON} res
             * @param {Boolean} append
             */
            function message_ajax_to_element(res, append = true) {
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
                        add_message_send_by_system(message, append)
                    } else if (message.user_id == {{ $user->id }}) {
                        add_my_send_message(message, date, append)
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
                            append)
                    }
                });
            }

            /**
             * @param {Int} call_id
             * @param {String} call_pin
             */
            function add_join_call_button(call_id, call_pin) {
                htm = '<li class="clearfix text-center" data-call-id="' + call_id + '" data-pin="' + call_pin + '">'
                htm += '<button class="btn btn-success" id="join-call-now">'
                htm += '<i class="mdi mdi-phone"></i> Tham gia cuộc gọi'
                htm += '</button>'
                htm += '</li>'
                $('.conversation-list .simplebar-content').append(htm);
            }

            /**
             * @param {JSON} message
             * @param {Boolean} append
             */
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
                } else if (message.message.indexOf("start-call") == 0) {
                    system_message = 'Bắt đầu cuộc gọi'
                } else if (message.message.indexOf("joined-call") == 0) {
                    system_message = message.message.substring(11) + ' tham gia cuộc gọi'
                } else if (message.message.indexOf("left-call") == 0) {
                    system_message = message.message.substring(10) + ' rời khỏi cuộc gọi'
                } else if (message.message.indexOf("stop-call") == 0) {
                    system_message = 'Kết thúc cuộc gọi'
                }
                htm = '<li class = "text-center date-message">'
                htm += '<span class="badge badge-secondary-lighten">' + system_message + '</span>'
                htm += '</li>'
                if (append) {
                    $('.conversation-list .simplebar-content').append(htm);
                } else {
                    $('.conversation-list .simplebar-content').prepend(htm);
                }
            }

            /**
             * @param {JSON} message
             */
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
                } else if (message.message.indexOf("start-call") == 0) {
                    system_message = 'Bắt đầu cuộc gọi'
                } else if (message.message.indexOf("joined-call") == 0) {
                    system_message = message.message.substring(11) + ' tham gia cuộc gọi'
                } else if (message.message.indexOf("left-call") == 0) {
                    system_message = message.message.substring(10) + ' rời khỏi cuộc gọi'
                } else if (message.message.indexOf("stop-call") == 0) {
                    system_message = 'Kết thúc cuộc gọi'
                }

                $(".chat-room[data-id=" + (message.room_id) + "] .new-message").html(system_message);
                $(".chat-room[data-id=" + (message.room_id) + "] .last-message-time").html(time_ago(
                    new Date(
                        message.created_at)));
                $(".chat-room[data-id=" + (message.room_id) + "] .last-message-time").attr('data-time',
                    message.created_at);
            }

            /**
             * @param {JSON} message
             * @param {Date} date
             * @param {Boolean} append
             * @param {String} random_message_id
             */
            function add_my_send_message(message, date = new Date(), append = true, random_message_id = null) {
                var htm = '<li class="clearfix odd"'
                if (random_message_id) {
                    htm += ' data-random_message_id="' + random_message_id + '"'
                }
                if (message.id) {
                    htm += ' data-id="' + message.id + '"'
                }
                htm += '>'
                htm += '<div class="chat-avatar">'
                htm +=
                    '<img src="{{ asset($user->profile->img ?? 'resources/assets/images/users/avatar-1.jpg') }}" class="rounded" alt="{{ $user->name }}" />'
                htm += '<i>' + date.getHours() + ':' + date.getMinutes() + '</i>'
                htm += '</div>'
                htm += '<div class="conversation-text">'
                htm += '<div class="ctext-wrap">'
                htm += '<i class="text-capitalize">{{ $user->name }} '
                if (random_message_id) {
                    htm += '<i class="mdi mdi-checkbox-blank-circle-outline text-primary d-inline sending"></i>'
                }
                htm += '</i>'
                htm += '<p>'
                htm += message.message ?? message
                htm += '</p>'
                if (message.files && message.files.length) {
                    htm += images_element(message.files)
                } else if (preview_images.length) {
                    htm += preload_images_element(preview_images)
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

            /**
             * @param {String} name
             * @param {String} img
             * @param {JSON} message
             * @param {Date} date
             * @param {Boolean} append
             */
            function add_my_receive_message(name, img, message, date, append = true) {
                var htm = '<li class="clearfix"'

                if (message.id) {
                    htm += ' data-id="' + message.id + '"'
                }
                htm += '>'
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
                htm += images_element(message.files)
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

            /**
             * @param {JSON} preview_images
             * 
             * @return {String}
             */
            function preload_images_element(preview_images) {
                if (preview_images.length) {
                    var htm = '<div class="card mb-1 shadow-none border p-2">'
                    htm += '<div class="row g-1">'
                    preview_images.forEach(preview_image => {
                        htm +=
                            '<div class="col-12 position-relative m-0 p-0 img-container mt-2">'
                        htm += '<div class="spinner-border" role="status">'
                        htm += '<span class="visually-hidden">Loading...</span>'
                        htm += '</div>'
                        htm += '</div>'
                    });
                    htm += '</div>'
                    htm += '</div>'
                    return htm
                }
                return ''
            }

            /**
             * @param {JSON} files
             * 
             * @return {String}
             */
            function images_element(files) {
                if (files && files.length) {
                    var htm =
                        '<div class="card mb-1 shadow-none border p-2">'
                    htm += '<div class="row g-1">'
                    files.forEach(file => {
                        htm += '<a href="' +
                            file.file + '" target="_blank" class="mt-2">'
                        htm += '<img src="' + file.file +
                            '" class="rounded w-100 h-100 p-0" style="object-fit: cover;">'
                        htm += '</a>'
                    });
                    htm += '</div>'
                    htm += '</div>'
                    return htm
                }
                return ''
            }

            /**
             * @param {Date} date
             * 
             * @returns {String}
             */
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
                })
            }, 60000);

            // check internet conection
            window.addEventListener("offline", (e) => {
                $.toast({
                    text: "Không có kết nối internet",
                    heading: "Có lỗi xảy ra",
                    icon: 'danger',
                    position: 'bottom-left',
                    hideAfter: false,
                    loaderBg: 'rgba(0,0,0,0.2)',

                });

            });

            window.addEventListener("online", (e) => {
                $.toast().reset('all');
                $.toast({
                    text: "Thành công",
                    heading: "Đã kết nối lại",
                    icon: 'success',
                    position: 'bottom-left',
                    hideAfter: 3000,
                    loaderBg: 'rgba(0,0,0,0.2)',

                });
                $.ajax({
                    method: 'get',
                    dataType: "json",
                    url: "{{ route('get-miss-message') }}",
                    data: {},
                    success: function(res) {
                        var new_message_in_this_room = res.filter(function(message) {
                            if (!$('.chat-room[data-id=' + message.room_id + ']')
                                .length) {
                                new_room(message.room_id)
                            } else {
                                if (message.room_id != room_id && !$(
                                        '.chat-room[data-id=' + message.room_id +
                                        '] .text-primary').length) {
                                    var $new_message_span = $('.chat-room[data-id=' +
                                        message.room_id +
                                        '] .new-message')
                                    $new_message_span.addClass('text-primary')
                                    $new_message_span.prev().append(
                                        '<i class="mdi mdi-checkbox-blank-circle text-primary"></i>'
                                    )
                                }
                                if (message.user_id) {
                                    update_new_message_in_chat_room(message.message,
                                        message
                                        .created_at, message.room_id)
                                } else {
                                    update_new_message_in_chat_room_send_by_system(
                                        message)
                                    if (e.message.message.indexOf("kick-user") == 0) {
                                        $.ajax({
                                            method: 'get',
                                            url: "{{ route('get-room-info') }}",
                                            dataType: "json",
                                            data: {
                                                id: e.message.room_id,
                                            },
                                            success: function(res) {
                                                if (!res) {
                                                    $('.alert-join-room')
                                                        .removeClass(
                                                            'd-none')
                                                    $('#chat-form')
                                                        .addClass('d-none')
                                                    @if ($user->type != 'system')
                                                        window.Echo.leave(
                                                            chanel_name);
                                                    @endif
                                                }
                                            },
                                        });
                                    }
                                }
                            }
                            return message.room_id == room_id
                        })
                        message_ajax_to_element(new_message_in_this_room, true)
                        scroll_to_bottom_message_container()
                    },
                    error: function() {}
                });
            });


            // scroll to bottom
            function scroll_to_bottom_message_container() {
                $(".conversation-list .simplebar-content-wrapper").animate({
                    scrollTop: $(
                            '.conversation-list .simplebar-content-wrapper .simplebar-content')
                        .height()
                }, 1);
            }

            // clear message 
            function clear_message() {
                $('.conversation-list .simplebar-content').html('')
            }

            // start timer count up
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
            // event modal start call hide
            document.getElementById('start-call-modal').addEventListener('hidden.bs.modal', function(event) {
                if (is_calling) {
                    $('#mini-start-call').removeClass('d-none')
                } else {
                    $('#mini-start-call').addClass('d-none')
                }
            })
            // event modal start call show
            document.getElementById('start-call-modal').addEventListener('show.bs.modal', function(event) {
                $('#mini-start-call').addClass('d-none')
            })
            // event modal in call hide
            document.getElementById('in-call-modal').addEventListener('hidden.bs.modal', function(event) {
                if (is_incall) {
                    $('#mini-in-call').removeClass('d-none')
                } else {
                    $('#mini-in-call').addClass('d-none')
                }
            })
            // event modal in call show
            document.getElementById('in-call-modal').addEventListener('show.bs.modal', function(event) {
                $('#mini-in-call').addClass('d-none')
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#start-call').on('click', function() {
                room_calling_id = room_id
                window.is_ringing = false
                is_calling = true
                $('#start-call-modal .modal-body .status').html('Đang kết nối...')
                $('#in-call-modal .joined-users').html('')
                $('#start-call').addClass('d-none')
                @if ($user->type == 'system')
                    $('#admin-stop-call').removeClass('d-none')
                @endif

                $.ajax({
                    method: 'post',
                    url: "chat/start-call",
                    dataType: "json",
                    data: {
                        id: room_calling_id,
                    },
                    success: function(res) {
                        call_id = res.id
                        call_pin = res.pin
                        start_connect_call()
                        $('#start-call-modal .modal-body .status').html('Đang đổ chuông...')
                        $('.stop-call').removeAttr('disabled')
                        window.start_call_timeout = setTimeout(cancel_calling, 60000)
                    }
                })

            })
            $('#admin-stop-call').on('click', function() {
                $.ajax({
                    method: 'post',
                    url: "chat/end-call",
                    dataType: "json",
                    data: {
                        id: room_id,
                    },
                    success: function(res) {
                        call_id = res.id
                        call_pin = res.pin
                        start_connect_call()
                        $('#start-call-modal .modal-body .status').html('Đang đổ chuông...')
                        $('.stop-call').removeAttr('disabled')
                        window.start_call_timeout = setTimeout(cancel_calling, 60000)
                    }
                })
            })
            $('.conversation-list').on('click', '#join-call-now', function() {
                is_incall = true
                window.call_id = parseInt($(this).parent().attr('data-call-id'))
                window.call_pin = $(this).parent().attr('data-pin')
                in_call_modal.show()
                $('#in-call-modal .joined-users').html('')
                start_connect_call()
            })
            $('#accept-call').on('click', function() {
                is_incall = true
                window.is_ringing = false
                start_call_modal.hide()
                $('#mini-start-call').addClass('d-none')
                in_call_modal.show()
                $('#in-call-modal .joined-users').html('')
                start_connect_call()
            })
            $('.microphone').on('click', function() {
                muted_audio()
            });
            $('.stop-call').on('click', function() {
                window.is_calling = false
                window.is_ringing = false
                window.is_incall = false
                leave_audio_room()
            });
            $('#cancel-call').on('click', function() {
                window.is_calling = false
                window.is_ringing = false
                window.is_incall = false
            });

            function cancel_calling() {
                window.start_call_modal.hide()
                $('#mini-start-call').addClass('d-none')
                window.in_call_modal.hide()
                $('#mini-in-call').addClass('d-none')
                window.is_calling = false
                window.is_ringing = false
                window.is_incall = false
                leave_audio_room()
            }
        })
    </script>
    <script src="{{ asset('Modules/AvnChat/Resources/assets/js/audio.js') }}"></script>
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
