@extends('layouts.admin')
@section('title')
    Chat
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row mt-3">
            <!-- start chat users-->
            <div class="col-xxl-3 col-xl-6 order-xl-1">
                <div class="card">
                    <div class="card-body p-0">
                        <ul class="nav nav-tabs nav-bordered">
                            <li class="nav-item">
                                <a href="#allUsers" data-bs-toggle="tab" aria-expanded="false" class="nav-link active py-2">
                                    All
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#favUsers" data-bs-toggle="tab" aria-expanded="true" class="nav-link py-2">
                                    Favourties
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#friendUsers" data-bs-toggle="tab" aria-expanded="true" class="nav-link py-2">
                                    Friends
                                </a>
                            </li>
                        </ul> <!-- end nav-->
                        <div class="tab-content">
                            <div class="tab-pane show active p-3" id="newpost">

                                <!-- start search box -->
                                <div class="app-search">
                                    <form>
                                        <div class="mb-2 position-relative">
                                            <input type="text" class="form-control"
                                                placeholder="People, groups & messages..." />
                                            <span class="mdi mdi-magnify search-icon"></span>
                                        </div>
                                    </form>
                                </div>
                                <!-- end search box -->

                                <!-- users -->
                                <div class="row">
                                    <div class="col">
                                        <div data-simplebar style="max-height: 550px">
                                            @foreach ($rooms as $room)
                                                <a href="javascript:void(0);" class="text-body chat-room"
                                                    data-id="{{ $room->id }}" id="room-{{ $room->id }}">
                                                    <div class="d-flex align-items-start mt-1 p-2">
                                                        <img src="{{ asset('resources/assets/images/users/avatar-1.jpg') }}"
                                                            class="me-2 rounded-circle" height="48"
                                                            alt="Brandon Smith" />
                                                        <div class="w-100 overflow-hidden">
                                                            <h5 class="mt-0 mb-0 font-14">
                                                                <span class="float-end text-muted font-12">4:30am</span>
                                                                @if ($room->is_group)
                                                                    {{ $room->name }}
                                                                @else
                                                                    {{ $room->users->where('id', '!=', $user->id)->first()->name }}
                                                                @endif
                                                            </h5>
                                                            <p class="mt-1 mb-0 text-muted font-14">
                                                                <span class="w-25 float-end text-end"><span
                                                                        class="badge badge-danger-lighten">3</span></span>
                                                                <span class="w-75 new-message">How are you today?</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
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
                    <div class="card-body">
                        <ul class="conversation-list min-vh-75" data-simplebar style="max-height: 537px">
                            <li class="clearfix">
                                <div class="chat-avatar">
                                    <img src="{{ asset('resources/assets/images/users/avatar-1.jpg') }}" class="rounded"
                                        alt="Shreyu N" />
                                    <i>10:00</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i>{{ $users->first()->name }}</i>
                                        <p>
                                            Hello!
                                        </p>
                                    </div>
                                </div>
                                <div class="conversation-actions dropdown">
                                    <button class="btn btn-sm btn-link" data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class='uil uil-ellipsis-v'></i></button>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Copy Message</a>
                                        <a class="dropdown-item" href="#">Edit</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </li>
                            <li class="clearfix odd">
                                <div class="chat-avatar">
                                    <img src="assets/images/users/avatar-1.jpg" class="rounded" alt="dominic" />
                                    <i>10:01</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i>Dominic</i>
                                        <p>
                                            Hi, How are you? What about our next meeting?
                                        </p>
                                    </div>
                                </div>
                                <div class="conversation-actions dropdown">
                                    <button class="btn btn-sm btn-link" data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class='uil uil-ellipsis-v'></i></button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Copy Message</a>
                                        <a class="dropdown-item" href="#">Edit</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="row">
                            <div class="col">
                                <div class="mt-2 bg-light p-3 rounded">
                                    <form class="chat-form" name="chat-form" id="chat-form">
                                        <div class="row">
                                            <div class="col mb-2 mb-sm-0">
                                                <input type="text" class="form-control border-0"
                                                    placeholder="Enter your text" id="message" required="">
                                            </div>
                                            <div class="col-sm-auto">
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-light"><i
                                                            class="uil uil-paperclip"></i></a>
                                                    <a href="#" class="btn btn-light"> <i
                                                            class='uil uil-smile'></i>
                                                    </a>
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
                <div class="card">
                    <div class="card-body">
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
                            <img src="assets/images/users/avatar-5.jpg" alt="shreyu"
                                class="img-thumbnail avatar-lg rounded-circle" />
                            <h4>Shreyu N</h4>
                            <button class="btn btn-primary btn-sm mt-1"><i class='uil uil-envelope-add me-1'></i>Send
                                Email</button>
                            <p class="text-muted mt-2 font-14">Last Interacted: <strong>Few hours back</strong></p>
                        </div>

                        <div class="mt-3">
                            <hr class="" />

                            <p class="mt-4 mb-1"><strong><i class='uil uil-at'></i> Email:</strong></p>
                            <p>support@coderthemes.com</p>

                            <p class="mt-3 mb-1"><strong><i class='uil uil-phone'></i> Phone Number:</strong></p>
                            <p>+1 456 9595 9594</p>

                            <p class="mt-3 mb-1"><strong><i class='uil uil-location'></i> Location:</strong></p>
                            <p>California, USA</p>

                            <p class="mt-3 mb-1"><strong><i class='uil uil-globe'></i> Languages:</strong></p>
                            <p>English, German, Spanish</p>

                            <p class="mt-3 mb-2"><strong><i class='uil uil-users-alt'></i> Groups:</strong></p>
                            <p>
                                <span class="badge badge-success-lighten p-1 font-14">Work</span>
                                <span class="badge badge-primary-lighten p-1 font-14">Friends</span>
                            </p>
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
        $(document).ready(function() {
            var room_id = null;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            window.Echo.private('chat.user.{{ $user->id }}')
                .listen('.newMessage', (e) => {
                    console.log(e);
                    if (room_id == e.room_id) {
                        add_my_receive_message(e.name, e.img, e.message)
                    } else {
                        $("#room-" + e.room_id + " .new-message").html(e.message);
                    }
                });
            $('.chat-room').on('click', function() {
                $('.chat-conatiner').removeClass('d-none');
                room_id = $(this).data('id')
            })

            $('#chat-form').on('submit', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var message = $('#message').val();
                add_my_send_message(message)
                $('#message').val('')
                $.ajax({
                    method: 'post',
                    url: "{{ route('send-message-to-user') }}",
                    dataType: "json",
                    data: {
                        id: room_id,
                        message: message
                    },
                    success: function(res) {
                        console.log(res);
                    }
                });

            });

            function add_my_send_message(message) {
                var htm = '<li class="clearfix odd">'
                htm += '<div class="chat-avatar">'
                htm +=
                    '<img src="{{ asset($user->customer->img ?? 'resources/assets/images/users/avatar-1.jpg') }}" class="rounded" alt="{{ $user->name }}" />'
                htm += '<i>10:01</i>'
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
                $('.conversation-list .simplebar-content').append(htm);
            }

            function add_my_receive_message(name, img, message) {
                var htm = '<li class="clearfix">'
                htm += '<div class="chat-avatar">'
                htm += '<img src="' + (img) + '" class="rounded"'
                htm += 'alt="' + name + '" />'
                htm += '<i>10:00</i>'
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
                // $(htm).insertAfter('li.clearfix:last-child');
                $('.conversation-list .simplebar-content').append(htm);
            }
        });
    </script>
@endsection
@section('css')
@endsection
