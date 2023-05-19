// room_selected_id;
class RoomContainer {
    container;

    constructor() {
        this.container = $("#room-container");
    }

    /**
     *
     * @param {Number} room_id
     * @return {Room}
     * get room
     */
    getRoom(room_id) {
        return new Room(room_id);
    }

    /**
     *
     * @param {Number} room_id
     * create new room
     */
    newRoom(room_id) {
        var container = this.container;
        $.ajax({
            method: "get",
            url: "chat/get-room-info",
            dataType: "json",
            data: {
                id: room_id,
            },
            success: function (res) {
                if (!$(".chat-room[data-id=" + res.room_id + "]").length) {
                    var htm =
                        '<a href="javascript:void(0);" class="text-body chat-room" data-id="' +
                        res.room_id +
                        '">';
                    htm +=
                        '<div class="d-flex align-items-start mt-1 p-2 chat-room-badge">';
                    htm += '<div class="me-2 flex-shrink-0 chat-room-img">';
                    if (res.imgs.length <= 1) {
                        var img =
                            res.imgs[0] ??
                            "resources/assets/images/users/avatar-1.jpg";
                        htm +=
                            '<img src="' +
                            img +
                            '" class="rounded-circle img-thumbnail p-0" style="object-fit: cover; height:48px; width:48px;" />';
                    } else {
                        htm +=
                            '<div class="position-relative" style="width: 48px; height: 48px;">';
                        res.imgs.forEach((img, index) => {
                            var img =
                                img ??
                                "resources/assets/images/users/avatar-1.jpg";
                            htm +=
                                '<img src="' +
                                img +
                                '" class="rounded-circle img-thumbnail position-absolute p-0 ' +
                                (index % 2 == 0
                                    ? "top-0 start-0"
                                    : "bottom-0 end-0") +
                                '" style="object-fit: cover; height:36px; width:36px;" />';
                        });
                        htm += "</div>";
                    }
                    htm += "</div>";
                    htm += '<div class="w-100 overflow-hidden">';
                    htm += '<h5 class="mt-0 mb-0 font-14">';
                    htm +=
                        '<span class="float-end text-muted font-12 last-message-time" data-time=""></span>';
                    htm += '<span class="room-name">' + res.name + "</span>";
                    htm += "</h5>";
                    htm += '<p class="mt-1 mb-0 text-muted font-14">';
                    htm += '<span class="ms-2 float-end text-end">';
                    htm +=
                        '<span class="badge badge-danger room-status d-none">';
                    htm += '<i class="uil uil-comment-alt-redo"></i>';
                    htm += "</span>";
                    htm += "</span>";
                    htm += '<span class="new-message text-truncate"></span>';
                    htm += "</p>";
                    htm += "</div>";
                    htm += "</div>";
                    htm += "</a>";
                    container.find(".simplebar-content").prepend(htm);
                }
                var room = new Room(res.room_id);
                room.updateRoomStatus(
                    res.is_workspace,
                    res.has_session,
                    res.customers.length
                );
                if (res.last_message) {
                    room.addNewMessage(res.last_message);
                }
            },
        });
    }
}
class Room {
    room;

    /**
     *
     * @param {Number} room_id
     */
    constructor(room_id) {
        this.room = $("#room-container .chat-room[data-id=" + room_id + "]");
    }

    /**
     *
     * @param {Array} imgs
     * update chat room image
     */
    updateImg(imgs) {
        if (imgs.length == 1) {
            htm =
                '<img src="' +
                (imgs[0] ?? "resources/assets/images/users/avatar-1.jpg") +
                '" class="rounded-circle img-thumbnail p-0" style="object-fit: cover; height:48px; width:48px;"/>';
        } else {
            htm +=
                '<div class="position-relative" style="width: 48px; height: 48px;">';
            imgs.forEach((img, index) => {
                htm +=
                    '<img src="' +
                    (img ?? "resources/assets/images/users/avatar-1.jpg") +
                    '" class="rounded-circle img-thumbnail position-absolute p-0 ' +
                    (index % 2 == 0 ? "top-0 start-0" : "bottom-0 end-0") +
                    '" style="object-fit: cover; height:36px; width:36px;" />';
            });
            htm += "</div>";
        }
        this.room.find(".chat-room-img").html(htm);
    }

    /**
     *
     * @param {String} name
     * update chat room name
     */
    updateRoomName(name) {
        this.room.find(".room-name").html(name);
    }

    /**
     *
     * @param {String} created_at
     * update last message time
     */
    updateLastMessageTime(created_at) {
        var time_element = this.room.find(".last-message-time");
        time_element.html(time_ago(new Date(created_at)));
        time_element.attr("data-time", created_at);
    }

    /**
     *
     * @param {MessageJson} message
     * add new message
     */
    addNewMessage(message) {
        // update time
        this.updateLastMessageTime(message.created_at);

        // add color
        var new_message_element = this.room.find(".new-message");
        if (!new_message_element.hasClass("text-primary")) {
            new_message_element
                .prev()
                .append(
                    '<i class="mdi mdi-checkbox-blank-circle text-primary"></i>'
                );
        }
        new_message_element.addClass("text-primary");
        // add message
        if (message.user_id) {
            new_message_element.html(message.message);
        } else {
            var system_message = "";
            if (message.message.indexOf("add-user") == 0) {
                system_message =
                    "Đã thêm " +
                    message.message.substring(
                        message.message.indexOf(" "),
                        message.message.length
                    );
            } else if (message.message.indexOf("kick-user") == 0) {
                system_message =
                    "Đã xóa " +
                    message.message.substring(
                        message.message.indexOf(" "),
                        message.message.length
                    );
            } else if (message.message.indexOf("start-session") == 0) {
                system_message = "Bắt đầu phiên làm việc";
            } else if (message.message.indexOf("end-session") == 0) {
                system_message = "Kết thúc phiên làm việc";
            } else if (message.message.indexOf("start-call") == 0) {
                system_message = "Bắt đầu cuộc gọi";
            } else if (message.message.indexOf("joined-call") == 0) {
                system_message =
                    message.message.substring(11) + " tham gia cuộc gọi";
            } else if (message.message.indexOf("left-call") == 0) {
                system_message =
                    message.message.substring(10) + " rời khỏi cuộc gọi";
            } else if (message.message.indexOf("stop-call") == 0) {
                system_message = "Kết thúc cuộc gọi";
            }
            new_message_element.html(system_message);
        }
    }

    /**
     *
     * @param {Boolean} is_workspace
     * @param {Boolean} has_session
     * @param {Boolean} has_customers
     * update room status
     */
    updateRoomStatus(
        is_workspace = false,
        has_session = false,
        has_customers = false
    ) {
        var room_status_element = this.room.find(".room-status");
        if (is_workspace) {
            $(room_status_element).removeClass("d-none");
            if (has_session) {
                $(room_status_element).removeAttr("class");
                $(room_status_element).addClass(
                    "badge badge-danger-lighten room-status"
                );
            } else if (has_customers) {
                $(room_status_element).removeAttr("class");
                $(room_status_element).addClass(
                    "badge badge-warning-lighten room-status"
                );
            } else {
                $(room_status_element).removeAttr("class");
                $(room_status_element).addClass(
                    "badge badge-success-lighten room-status"
                );
            }
        } else {
            $(room_status).addClass("d-none");
        }
    }

    /**
     * mark as read
     */
    readMessage() {
        this.room.find("i.text-primary").remove();
        this.room.find(".text-primary").removeClass("text-primary");
    }
}
class ChatContainer {
    container;
    last_load;
    load_more;
    input_message;
    images;
    preview_images;
    constructor() {
        this.container = $("#chat-container");
        this.last_load = null;
        this.load_more = true;
        this.input_message = $("#message");
        this.files_container = $(".files-container");
        this.images = [];
        this.preview_images = [];
        $(document).ready(function () {
            window.chat_container.eventLoadMore();
            window.chat_container.eventFileInput();
            window.chat_container.eventSendMessage();
        });
    }

    /**
     *
     * @param {String} message
     * @param {Number} random_message_id
     * @return {JQueryObject}
     */
    newMessage(message, random_message_id) {
        var date = new Date();
        var htm = '<li class="clearfix odd"';
        htm += ' data-random_message_id="' + random_message_id + '">';
        htm += '<div class="chat-avatar">';
        htm += '<img src="' + window.user.img + '" class="rounded"/>';
        htm +=
            "<i>" +
            ("0" + date.getHours()).slice(-2) +
            ":" +
            ("0" + date.getMinutes()).slice(-2) +
            "</i>";
        htm += "</div>";
        htm += '<div class="conversation-text">';
        htm += '<div class="ctext-wrap">';
        htm += '<i class="text-capitalize">' + window.user.name + " ";
        htm +=
            '<i class="mdi mdi-checkbox-blank-circle-outline text-primary d-inline sending"></i>';
        htm += "</i>";
        htm += "<p>";
        htm += message;
        htm += "</p>";
        if (window.chat_container.preview_images.length) {
            htm += '<div class="card mb-1 shadow-none border p-2">';
            htm += '<div class="row g-1">';
            window.chat_container.preview_images.forEach((preview_image) => {
                htm +=
                    '<div class="col-12 position-relative m-0 p-0 img-container mt-2">';
                htm += '<div class="spinner-border" role="status">';
                htm += '<span class="visually-hidden">Loading...</span>';
                htm += "</div>";
                htm += "</div>";
            });
            htm += "</div>";
            htm += "</div>";
        }
        htm += "</div>";
        htm += "</div>";
        htm += "</li>";
        $(".conversation-list .simplebar-content").append(htm);
        return $(".clearfix[data-random_message_id=" + random_message_id + "]");
    }

    addListMessages(messages, append = true) {
        var now = new Date();
        messages.forEach((message) => {
            var htm = "";
            var date = new Date(message.created_at);
            if (
                date.getFullYear() != now.getFullYear() ||
                date.getMonth() != now.getMonth() ||
                date.getDate() != now.getDate()
            ) {
                htm = '<li class = "text-center date-message">';
                htm +=
                    '<span class="badge badge-success-lighten">' +
                    now.getDate() +
                    "/" +
                    now.getMonth() +
                    "/" +
                    now.getFullYear() +
                    "</span>";
                htm += "</li>";
                $(".conversation-list .simplebar-content").prepend(htm);
                now = date;
            }
            window.chat_container.addReceiveMessage(message, append);
        });
    }

    /**
     *
     * @param {MessageJson} message
     * @param {Boolean} append
     * add new received message
     */
    addReceiveMessage(message, append = true) {
        if (message.user) {
            var htm = '<li class="clearfix';
            if (message.user.id == window.user.id) {
                htm += " odd";
            }
            htm += '"';
            if (message.id) {
                htm += ' data-id="' + message.id + '"';
            }
            htm += ">";
            htm += '<div class="chat-avatar">';
            var avatar = "resources/assets/images/users/avatar-1.jpg";
            if (message.user.profile && message.user.profile.img) {
                avatar = message.user.profile.img;
            }
            htm += '<img src="' + avatar + '" class="rounded"/>';
            var date = new Date(message.created_at);
            htm +=
                "<i>" +
                ("0" + date.getHours()).slice(-2) +
                ":" +
                ("0" + date.getMinutes()).slice(-2) +
                "</i>";
            htm += "</div>";
            htm += '<div class="conversation-text">';
            htm += '<div class="ctext-wrap">';
            htm += "<i class='text-capitalize'>" + message.user.name + "</i>";
            htm += "<p>";
            htm += message.message;
            htm += "</p>";
            if (message.files && message.files.length) {
                htm += '<div class="card mb-1 shadow-none border p-2">';
                htm += '<div class="row g-1">';
                message.files.forEach((file) => {
                    htm +=
                        '<a href="' +
                        file.file +
                        '" target="_blank" class="mt-2">';
                    htm +=
                        '<img src="' +
                        file.file +
                        '" class="rounded w-100 h-100 p-0" style="object-fit: cover;">';
                    htm += "</a>";
                });
                htm += "</div>";
                htm += "</div>";
            }
            htm += "</div>";
            htm += "</div>";
            htm += "</li>";
        } else {
            var system_message = "";
            if (message.message.indexOf("add-user") == 0) {
                system_message =
                    "Đã thêm " +
                    message.message.substring(
                        message.message.indexOf(" "),
                        message.message.length
                    );
            } else if (message.message.indexOf("kick-user") == 0) {
                system_message =
                    "Đã xóa " +
                    message.message.substring(
                        message.message.indexOf(" "),
                        message.message.length
                    );
            } else if (message.message.indexOf("start-session") == 0) {
                system_message = "Bắt đầu phiên làm việc";
            } else if (message.message.indexOf("end-session") == 0) {
                system_message = "Kết thúc phiên làm việc";
            } else if (message.message.indexOf("start-call") == 0) {
                system_message = "Bắt đầu cuộc gọi";
            } else if (message.message.indexOf("joined-call") == 0) {
                system_message =
                    message.message.substring(11) + " tham gia cuộc gọi";
            } else if (message.message.indexOf("left-call") == 0) {
                system_message =
                    message.message.substring(10) + " rời khỏi cuộc gọi";
            } else if (message.message.indexOf("stop-call") == 0) {
                system_message = "Kết thúc cuộc gọi";
            }
            htm = '<li class = "text-center date-message">';
            htm +=
                '<span class="badge badge-secondary-lighten">' +
                system_message +
                "</span>";
            htm += "</li>";
        }
        if (append) {
            $(".conversation-list .simplebar-content").append(htm);
        } else {
            $(".conversation-list .simplebar-content").prepend(htm);
        }
    }

    /**
     * scroll to bottom chat container
     */
    scrollBottom() {
        $(".conversation-list .simplebar-content-wrapper").animate(
            {
                scrollTop: $(
                    ".conversation-list .simplebar-content-wrapper .simplebar-content"
                ).height(),
            },
            1
        );
    }

    /**
     * clear message
     */
    clearMessage() {
        $(".conversation-list .simplebar-content").html("");
    }

    /**
     * init file input event
     */
    eventFileInput() {
        // check file upload
        $("label[for=files]").on("click", function (e) {
            if (window.chat_container.images.length >= 4) {
                e.preventDefault();
                e.stopPropagation();
                $.NotificationApp.send(
                    "Thất bại",
                    "Tối đa 4 tệp",
                    "bottom-right",
                    "rgba(0,0,0,0.2)",
                    "error"
                );
            }
        });

        // file upload show pre upload
        $("#files").change(function (e) {
            e.preventDefault();
            if (this.files) {
                $(".files-container").removeClass("d-none");
                var htm = "";
                var filesAmount = this.files.length;
                for (i = 0; i < filesAmount; i++) {
                    if (window.chat_container.images.length >= 4) {
                        $.NotificationApp.send(
                            "Thất bại",
                            "Tối đa 4 tệp",
                            "bottom-right",
                            "rgba(0,0,0,0.2)",
                            "error"
                        );
                        break;
                    }
                    window.chat_container.images[images.length] = this.files[i];
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        window.chat_container.preview_images[
                            window.chat_container.preview_images.length
                        ] = event.target.result;
                        htm =
                            '<div class="avatar-sm position-relative img-thumbnail mx-1">';
                        htm +=
                            '<img src="' +
                            event.target.result +
                            '" class="rounded w-100 h-100" style="object-fit: cover;">';
                        htm +=
                            '<a class="remove-image" href="javascript: void(0);" style="display: inline;">&#215;</a>';
                        htm += "</div>";
                        $(".files-container .row").append(htm);
                    };
                    reader.readAsDataURL(file);
                }
                $("#files").val("");
            }
        });

        // remove file upload
        $(".files-container").on("click", ".remove-image", function () {
            var index = window.chat_container.preview_images.indexOf(
                $(this).parent().find("img").attr("src")
            );
            if (index > -1) {
                // only splice array when item is found
                window.chat_container.preview_images.splice(index, 1); // 2nd parameter means remove one item only
                window.chat_container.images.splice(index, 1); // 2nd parameter means remove one item only
                $(this).parent().remove();
            }
            if (!window.chat_container.preview_images.length) {
                $(".files-container").addClass("d-none");
            }
        });
    }

    /**
     * init load more message event
     */
    eventLoadMore() {
        // load more mesage
        $("#chat-container .simplebar-content-wrapper").scroll(function () {
            if ($(this).scrollTop() == 0) {
                if (
                    window.chat_container.load_more &&
                    window.chat_container.last_load
                ) {
                    window.chat_container.load_more = false;
                    var before_height = $(
                        ".conversation-list .simplebar-content"
                    ).height();
                    $(".conversation-list .simplebar-content").prepend(
                        '<button class="btn btn-primary w-100 pre-message-loading mb-1" type="button" disabled>' +
                            '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>' +
                            "Đang tải..." +
                            "</button>"
                    );
                    $.ajax({
                        method: "get",
                        url: "chat/load-messages",
                        dataType: "json",
                        data: {
                            last_load: window.chat_container.last_load,
                            id: window.room_id,
                        },
                        success: function (res) {
                            if (res.length) {
                                window.chat_container.last_load =
                                    res[res.length - 1].id ?? 0;
                            } else {
                                window.chat_container.last_load = 0;
                            }
                            window.chat_container.addListMessages(res, false);
                            $(
                                ".conversation-list .simplebar-content-wrapper"
                            ).scrollTop(
                                $(
                                    ".conversation-list .simplebar-content"
                                ).height() - before_height
                            );
                            $(
                                ".conversation-list .simplebar-content .pre-message-loading"
                            ).remove();
                        },
                        error: function () {
                            $(".chat-conatiner .pre-loader-error").removeClass(
                                "d-none"
                            );
                        },
                    });
                    window.chat_container.load_more = true;
                }
            }
        });
    }

    /**
     * init send message event
     */
    eventSendMessage() {
        $("#chat-form").on("submit", function (e) {
            e.preventDefault();
            var message = window.chat_container.input_message.val();
            var random_message_id = Math.floor(Math.random() * 100000000000000);
            var form_data = new FormData();
            form_data.append("id", window.room_id);
            form_data.append("message", message);
            form_data.append("random_message_id", random_message_id);
            window.chat_container.images.forEach((img) => {
                form_data.append("images[]", img);
            });

            var new_message = window.chat_container.newMessage(
                message,
                random_message_id
            );
            window.room_container.getRoom(window.room_id).addNewMessage({
                message: message,
                user_id: window.user.id,
            });
            window.chat_container.scrollBottom();
            window.chat_container.input_message.val("");
            window.chat_container.preview_images = [];
            window.chat_container.images = [];
            window.chat_container.files_container.addClass("d-none");
            window.chat_container.files_container.find(".row div").remove();
            $.ajax({
                method: "post",
                url: "chat/send-message",
                dataType: "json",
                processData: false,
                contentType: false,
                data: form_data,
                success: function (res) {
                    new_message
                        .find(".sending")
                        .removeClass("mdi-checkbox-blank-circle-outline")
                        .addClass("mdi-check-circle");
                    new_message.attr("data-id", res.message.id);
                    if (res && res.message_files && res.message_files.length) {
                        new_message
                            .find(".img-container")
                            .each(function (index) {
                                htm =
                                    '<a href="' +
                                    res.message_files[index].file +
                                    '" target="_blank">';
                                htm +=
                                    '<img src="' +
                                    res.message_files[index].file +
                                    '" class="rounded w-100 h-100 p-0 mt-2" style="object-fit: cover;">';
                                htm += "</a>";
                                $(this).html(htm);
                            });
                    }
                },
                error: function (e) {
                    if (!navigator.onLine) {
                        var request = this;
                        setTimeout(function () {
                            $.ajax(request);
                        }, 3000);
                    }
                },
            });
        });
    }
}

/**
 * @param {Date} date
 * @return {String}
 * return time ago
 */
function time_ago(date) {
    var now = new Date();
    time_elapsed = Math.floor((now.getTime() - date.getTime()) / 1000);
    var seconds = time_elapsed;
    var minutes = Math.floor(time_elapsed / 60);
    var hours = Math.floor(time_elapsed / 3600);
    var days = Math.floor(time_elapsed / 86400);
    var weeks = Math.floor(time_elapsed / 604800);
    var months = Math.floor(time_elapsed / 2600640);
    var years = Math.floor(time_elapsed / 31207680);
    // Seconds
    if (seconds <= 60) {
        return "Bây giờ";
    }
    //Minutes
    else if (minutes <= 60) {
        return minutes + " phút trước";
    }
    //Hours
    else if (hours <= 24) {
        return hours + " giờ trước";
    }
    //Days
    else if (days <= 7) {
        return days + " ngày trước";
    }
    //Weeks
    else if (weeks <= 4.3) {
        return weeks + " tuần trước";
    }
    //Months
    else if (months <= 12) {
        return months + " tháng trước";
    }
    //Years
    else {
        return years + " năm trước";
    }
}

window.room_container = new RoomContainer();
window.chat_container = new ChatContainer();
