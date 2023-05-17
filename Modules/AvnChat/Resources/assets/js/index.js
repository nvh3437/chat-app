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
     */
    getRoom(room_id) {
        return new Room(room_id);
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
     */
    addNewMessage(message) {
        var new_message_element = this.room.find(".new-message");
        if (!new_message_element.hasClass(text - primary)) {
            new_message_element
                .prev()
                .append(
                    '<i class="mdi mdi-checkbox-blank-circle text-primary"></i>'
                );
        }
        new_message_element.addClass("text-primary");

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
