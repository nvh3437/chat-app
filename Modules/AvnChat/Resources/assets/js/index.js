
var room_id = null;
var page = null;
var last_page = null;
var load_more = true;
var count_up = null;
var user_image = ''
var preview_images = [];
var images = [];

// send message
$('#chat-form').on('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();

    var message = $('#message').val()
    var random_message_id = Math.floor(Math.random() * 100000000000000)

    // make ajax data
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

    // clear message input
    $('#message').val('')
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
        success: function (res) {
            // update icon send success
            $('.clearfix[data-random_message_id=' + res.random_message_id + '] .sending')
                .removeClass('mdi-checkbox-blank-circle-outline')
                .addClass('mdi-check-circle')

            // update image to preloader
            if (res && res.message_files && res.message_files.length) {
                $('.clearfix[data-random_message_id=' + res.random_message_id + '] .img-container').each(
                    function (index) {
                        htm = '<a href="' +
                            res.message_files[index].file + '" target="_blank">'
                        htm += '<img src="' + res.message_files[index].file +
                            '" class="rounded w-100 h-100 p-0" style="object-fit: cover;">'
                        htm += '</a>'
                        $(this).html(htm)
                    }
                )
            }
        }
    });

})

// remove user
$('.list-users-in-room').on('click', '.remove-user', function () {
    var user_id = $(this).attr('data-id');
    $.ajax({
        method: 'post',
        url: "{{ route('kick-user-chat') }}",
        dataType: "json",
        data: {
            id: room_id,
            user_id: user_id
        },
        success: function (res) { }
    });
})

// init select2 get users add to chat
$('#add-users-select').select2({
    ajax: {
        url: "{{ route('get-customers') }}",
        dataType: 'json',
        data: function (params) {
            var query = {
                search: params.term,
                room_id: room_id,
            }
            return query;
        },
        processResults: function (data) {
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
$('.back-to-room-col').on('click', function () {
    $('.room-col').removeClass('d-none')
    $('.chat-col').addClass('d-none')
    $('.info-col').addClass('d-none')
})

// show room-info
$('.show-room-info').on('click', function () {
    $('.room-col').addClass('d-none')
    $('.chat-col').addClass('d-none')
    $('.info-col').removeClass('d-none')
})

// back to chat-col
$('.back-to-chat-col').on('click', function () {
    $('.room-col').addClass('d-none')
    $('.chat-col').removeClass('d-none')
    $('.info-col').addClass('d-none')
})

function add_my_send_message(message, date = new Date(), append = true, random_message_id = null) {
    var htm = '<li class="clearfix odd"'
    if (random_message_id) {
        htm += ' data-random_message_id="' + random_message_id + '"'
    }
    htm += '>'
    htm += '<div class="chat-avatar">'
    htm +=
        '<img src="{{ asset($user->profile->img ?? "resources/assets/images/users/avatar-1.jpg") }}" class="rounded"/>'
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
                '<div class="col-12 position-relative m-0 p-0 img-container">'
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

/**
 * 
 * @param {Boolean} is_workspace 
 * @param {Boolean} has_session 
 * @param {JSON} join_users 
 * @param {Int} c_room_id 
 * @param {String} c_user_type 
 */
function update_room_status(is_workspace, has_session, join_users, c_room_id, c_user_type) {
    var room_status = $(".chat-room[data-id=" + c_room_id + "] .room-status")
    var join_customer_users = join_users.filter(function (user) {
        return user.type == 'customer'
    })
    if (is_workspace) {
        $(room_status).parent().removeClass('d-none');
        if (has_session) {
            $('.workspace-session').removeClass('d-none')
            if (c_user_type == 'system') {
                $('.end-session').removeClass('d-none')
                $('.start-session').addClass('d-none')
            }
            $('.time-session').removeClass('d-none')
            $(room_status).removeAttr('class');
            $(room_status).addClass('badge badge-danger-lighten room-status');
        } else if (join_customer_users.length) {
            if (c_user_type == 'system') {
                $('.workspace-session').removeClass('d-none')
                $('.end-session').addClass('d-none')
                $('.time-session').addClass('d-none')
                $('.start-session').removeClass('d-none')
            }
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

/**
 *start timer count up
 * @param {Date} date 
 */
function timer_count_up(date) {
    var countDownDate = date.getTime();
    count_up = setInterval(function () {
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

// scroll bottom
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

// update time ago
setInterval(() => {
    $(".chat-room[data-id=" + room_id + "] .last-message-time").each(function () {
        if ($(this).attr('data-time')) {
            $(this).html(time_ago(new Date($(this).attr('data-time'))))
        }
    });
}, 60000);

/**
 * @return {String} timeago
 * @param {Date} date The date
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

// Select2 format select users add to chat
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

// Select2 format selected users add to chat
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