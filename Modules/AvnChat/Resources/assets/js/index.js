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
        time_element.html(window.time_ago(new Date(created_at)));
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

