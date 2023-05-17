$(document).ready(function () {
    window.opaqueId = "user-" + window.user_id;
    window.mixertest = null;
    window.webrtcUp = false;
    window.stereo = false;
    window.remoteStream = null;
    window.audio_muted = false;
    // Initialize the library (all console debuggers enabled)
    Janus.init({
        debug: "all",
        callback: function () {
            // Use a button to start the demo
            window.start_connect_call = function () {
                // Make sure the browser supports WebRTC
                if (!Janus.isWebrtcSupported()) {
                    bootbox.alert("No WebRTC support... ");
                    return;
                }
                $("#start-call-modal .modal-body .status").html(
                    "Đang kết nối..."
                );
                // Create session
                janus = new Janus({
                    server: server,
                    iceServers: iceServers,
                    // Should the Janus API require authentication, you can specify either the API secret or user token here too
                    //		token: "mytoken",
                    //	or
                    //		apisecret: "serversecret",
                    success: function () {
                        // Attach to AudioBridge plugin
                        janus.attach({
                            plugin: "janus.plugin.audiobridge",
                            opaqueId: opaqueId,
                            success: function (pluginHandle) {
                                mixertest = pluginHandle;
                                var join_audio_bridge = {
                                    request: "join",
                                    room: call_id,
                                    id: user_id,
                                    quality: 10,
                                    pin:
                                        typeof call_pin == "string"
                                            ? call_pin
                                            : call_pin.toString(),
                                };
                                mixertest.send({ message: join_audio_bridge });
                                // Prepare the username registration
                            },
                            error: function (error) {
                                Janus.error(
                                    "  -- Error attaching plugin...",
                                    error
                                );
                                bootbox.alert(
                                    "Error attaching plugin... " + error
                                );
                            },
                            onmessage: function (msg, jsep) {
                                let event = msg["audiobridge"];
                                Janus.debug("Event: " + event);
                                if (event) {
                                    if (event === "joined") {
                                        $(".microphone").removeAttr("disabled");
                                        $(".stop-call").removeAttr("disabled");
                                        // Successfully joined, negotiate WebRTC now
                                        if (msg["id"]) {
                                            if (!webrtcUp) {
                                                webrtcUp = true;
                                                // Publish our stream
                                                mixertest.createOffer({
                                                    // We only want bidirectional audio
                                                    tracks: [
                                                        {
                                                            type: "audio",
                                                            capture: true,
                                                            recv: true,
                                                        },
                                                    ],
                                                    customizeSdp: function (
                                                        jsep
                                                    ) {
                                                        if (
                                                            stereo &&
                                                            jsep.sdp.indexOf(
                                                                "stereo=1"
                                                            ) == -1
                                                        ) {
                                                            // Make sure that our offer contains stereo too
                                                            jsep.sdp =
                                                                jsep.sdp.replace(
                                                                    "useinbandfec=1",
                                                                    "useinbandfec=1;stereo=1"
                                                                );
                                                        }
                                                    },
                                                    success: function (jsep) {
                                                        Janus.debug(
                                                            "Got SDP!",
                                                            jsep
                                                        );
                                                        let publish = {
                                                            request:
                                                                "configure",
                                                            muted: false,
                                                        };
                                                        mixertest.send({
                                                            message: publish,
                                                            jsep: jsep,
                                                        });
                                                    },
                                                    error: function (error) {
                                                        Janus.error(
                                                            "WebRTC error:",
                                                            error
                                                        );
                                                        bootbox.alert(
                                                            "WebRTC error... " +
                                                                error.message
                                                        );
                                                    },
                                                });
                                            }
                                        }
                                        // Any room participant?
                                        if (msg["participants"]) {
                                            let list_users =
                                                msg["participants"];
                                            var id_users = [];
                                            var mutes = [];
                                            list_users.forEach((user) => {
                                                if (
                                                    $(
                                                        "#joined-user-" +
                                                            user["id"]
                                                    ).length === 0
                                                ) {
                                                    id_users.push(user["id"]);
                                                    mutes.push(user["muted"]);
                                                } else {
                                                    if (user["muted"]) {
                                                        $(
                                                            "#joined-user-" +
                                                                user["id"] +
                                                                " .micro-status"
                                                        )
                                                            .removeClass(
                                                                "mdi-microphone"
                                                            )
                                                            .addClass(
                                                                "mdi-microphone-off"
                                                            );
                                                    } else {
                                                        $(
                                                            "#joined-user-" +
                                                                user["id"] +
                                                                " .micro-status"
                                                        )
                                                            .removeClass(
                                                                "mdi-microphone-off"
                                                            )
                                                            .addClass(
                                                                "mdi-microphone"
                                                            );
                                                    }
                                                }
                                            });
                                            if (id_users.length) {
                                                $.ajax({
                                                    method: "post",
                                                    url: "user/get-users",
                                                    dataType: "json",
                                                    data: {
                                                        users: id_users,
                                                    },
                                                    success: function (
                                                        response
                                                    ) {
                                                        var htm = "";
                                                        response.forEach(
                                                            (user, index) => {
                                                                htm +=
                                                                    '<div class="avatar-lg m-1 position-relative" id="joined-user-' +
                                                                    user["id"] +
                                                                    '">';
                                                                htm +=
                                                                    '<img src="' +
                                                                    user[
                                                                        "avatar"
                                                                    ] +
                                                                    '" alt="" class="img-thumbnail avatar-lg rounded-circle disable" style="object-fit: cover">';
                                                                htm +=
                                                                    '<div class="position-absolute bottom-0 text-center text-nowrap w-100 text-truncate bg-secondary text-white">';
                                                                if (
                                                                    mutes[index]
                                                                ) {
                                                                    htm +=
                                                                        '<i class="micro-status mdi mdi-microphone-off"></i> ';
                                                                } else {
                                                                    htm +=
                                                                        '<i class="micro-status mdi mdi-microphone"></i> ';
                                                                }
                                                                htm +=
                                                                    user[
                                                                        "name"
                                                                    ];
                                                                htm += "</div>";
                                                                htm += "</div>";
                                                            }
                                                        );
                                                        $(
                                                            "#in-call-modal .joined-users"
                                                        ).append(htm);
                                                        $(
                                                            "#in-call-modal .modal-body .status"
                                                        ).html("Đã kết nối...");
                                                    },
                                                });
                                            }
                                        }
                                    } else if (event === "event") {
                                        if (msg["participants"]) {
                                            if (
                                                call_id == msg["room"] &&
                                                is_calling
                                            ) {
                                                is_calling = false;
                                                is_incall = true;
                                                clearTimeout(
                                                    start_call_timeout
                                                );
                                                window.start_call_modal.hide();
                                                $("#mini-start-call").addClass(
                                                    "d-none"
                                                );
                                                window.in_call_modal.show();
                                            }
                                            let list_users =
                                                msg["participants"];
                                            list_users.forEach((user) => {
                                                if (
                                                    $(
                                                        "#joined-user-" +
                                                            user["id"]
                                                    ).length !== 0
                                                ) {
                                                    if (user["muted"]) {
                                                        $(
                                                            "#joined-user-" +
                                                                user["id"] +
                                                                " .micro-status"
                                                        )
                                                            .removeClass(
                                                                "mdi-microphone"
                                                            )
                                                            .addClass(
                                                                "mdi-microphone-off"
                                                            );
                                                    } else {
                                                        $(
                                                            "#joined-user-" +
                                                                user["id"] +
                                                                " .micro-status"
                                                        )
                                                            .removeClass(
                                                                "mdi-microphone-off"
                                                            )
                                                            .addClass(
                                                                "mdi-microphone"
                                                            );
                                                    }
                                                }
                                            });
                                        }
                                        // Any new feed to attach to?
                                        if (msg["leaving"]) {
                                            // One of the participants has gone away?
                                            let leaving = msg["leaving"];
                                            $(
                                                "#joined-user-" + leaving
                                            ).remove();
                                        }
                                    }
                                }
                                if (jsep) {
                                    Janus.debug(
                                        "Handling SDP as well...",
                                        jsep
                                    );
                                    mixertest.handleRemoteJsep({ jsep: jsep });
                                }
                            },
                            onremotetrack: function (track, mid, on, metadata) {
                                if (remoteStream || track.kind !== "audio")
                                    return;
                                if (!on) {
                                    // Track removed, get rid of the stream and the rendering
                                    remoteStream = null;
                                    $("#roomaudio").remove();
                                    return;
                                }
                                remoteStream = new MediaStream([track]);
                                $("#room").removeClass("hide").show();
                                if ($("#roomaudio").length === 0) {
                                    $("#mixedaudio").append(
                                        '<audio class="rounded centered" id="roomaudio" width="100%" height="100%" autoplay/>'
                                    );
                                }
                                Janus.attachMediaStream(
                                    $("#roomaudio").get(0),
                                    remoteStream
                                );
                            },
                            oncleanup: function () {
                                webrtcUp = false;
                                remoteStream = null;
                                if (is_calling || is_incall) {
                                    window.is_calling = false;
                                    window.is_incall = false;
                                    window.start_call_modal.hide();
                                    window.in_call_modal.hide();
                                    window.stop_call_modal.show();
                                    $(
                                        "#mini-in-call, #mini-start-call"
                                    ).addClass("d-none");
                                }
                            },
                        });
                    },
                    error: function (error) {
                        Janus.error(error);
                        bootbox.alert(error, function () {
                            window.location.reload();
                        });
                    },
                    destroyed: function () {
                        window.location.reload();
                    },
                });
            };
        },
    });

    // create audio room
    window.leave_audio_room = function () {
        var leave_audio_bridge = { request: "leave" };
        mixertest.send({
            message: leave_audio_bridge,
            success: function () {
                mixertest.hangup();
            },
        });
    };

    // create audio room
    window.muted_audio = function () {
        audio_muted = !audio_muted;
        var configure_audio_bridge = {
            request: "configure",
            muted: audio_muted,
        };
        if (audio_muted) {
            $(".microphone").html('<i class="mdi mdi-microphone-off"></i>');
        } else {
            $(".microphone").html('<i class="mdi mdi-microphone"></i>');
        }
        mixertest.send({ message: configure_audio_bridge });
    };
});
