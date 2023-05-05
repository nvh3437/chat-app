import { data } from 'autoprefixer';
import '../../../../../resources/js/bootstrap';

import Peer from "simple-peer";

window.props = {
    turn_url: 'turn:13.215.254.198:3478',
    turn_username: 'adminsystem',
    turn_credential: 'adminsystem',
}

window.data = {
    my_stream: null,
    my_peer: null,
    peer_partner: [],
}

function getPermissions() {
    if (navigator.mediaDevices === undefined) {
        navigator.mediaDevices = {};
    }

    // Some browsers partially implement mediaDevices. We can't just assign an object
    // with getUserMedia as it would overwrite existing properties.
    // Here, we will just add the getUserMedia property if it's missing.
    if (navigator.mediaDevices.getUserMedia === undefined) {
        navigator.mediaDevices.getUserMedia = function (constraints) {
            // First get ahold of the legacy getUserMedia, if present
            const getUserMedia =
                navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

            // Some browsers just don't implement it - return a rejected promise with an error
            // to keep a consistent interface
            if (!getUserMedia) {
                return Promise.reject(
                    new Error("getUserMedia is not implemented in this browser")
                );
            }

            // Otherwise, wrap the call to the old navigator.getUserMedia with a Promise
            return new Promise((resolve, reject) => {
                getUserMedia.call(navigator, constraints, resolve, reject);
            });
        };
    }
    navigator.mediaDevices.getUserMedia =
        navigator.mediaDevices.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia;

    return new Promise((resolve, reject) => {
        navigator.mediaDevices
            .getUserMedia({ video: true, audio: true })
            .then(stream => {
                resolve(stream);
            })
            .catch(err => {
                reject(err);
                //   throw new Error(`Unable to fetch stream ${err}`);
            });
    });
}

function getMediaPermission() {
    return getPermissions()
        .then((stream) => {
            window.data.my_stream = stream;
            document.querySelector('#my-stream').srcObject = stream;
        })
        .catch((error) => {
            console.log(error);
        });
}
window.placeVideoCall = async function () {

    await getMediaPermission();
    window.data.my_peer = new Peer({
        initiator: true,
        trickle: false,
        stream: window.data.my_stream,
        config: {
            iceServers: [
                {
                    urls: props.turn_url,
                    username: props.turn_username,
                    credential: props.turn_credential,
                },
            ],
        },
    });
    window.data.my_peer.on("signal", (data) => {
        console.log('my_peer_signal');
        $.ajax({
            method: 'post',
            url: "chat/video/call",
            dataType: "json",
            data: {
                room_id: window.room_id,
                signal: data,
            },
            success: function (res) { }
        });
    });

    window.data.my_peer.on("stream", (stream) => {
        console.log("my peer stream");
        document.querySelector('#partner-stream-1').srcObject = stream;
    });

    window.data.my_peer.on("connect", () => {
        console.log("my peer connected");
    });

    window.data.my_peer.on("error", (err) => {
        console.log(err);
    });

    window.data.my_peer.on("close", () => {
        console.log("call closed caller");
    });
}

window.acceptCall = async function () {
    await getMediaPermission();
    window.data.my_peer = new Peer({
        initiator: false,
        trickle: false,
        stream: window.data.my_stream,
        config: {
            iceServers: [
                {
                    urls: props.turn_url,
                    username: props.turn_username,
                    credential: props.turn_credential,
                },
            ],
        },
    });
    window.data.my_peer.on("signal", (data) => {
        $.ajax({
            method: 'post',
            url: "chat/video/accept-call",
            dataType: "json",
            data: {
                room_id: call_room_id,
                signal: data,
            },
            success: function (res) { }
        });
    });

    window.data.my_peer.on("stream", (stream) => {
        console.log("my peer stream acceptCall");
        document.querySelector('#partner-stream-1').srcObject = stream;
    });

    window.data.my_peer.on("connect", () => {
        console.log("peer connected acceptCall");
    });

    window.data.my_peer.on("error", (err) => {
        console.log(err);
    });

    window.data.my_peer.on("close", () => {
        console.log("call closed accepter acceptCall");
    });
    window.data.my_peer.signal(window.incoming_call_signal);
}

window.createPeer = async function (signal) {
    peer = new Peer({
        initiator: false,
        trickle: false,
    });
    peer.on("signal", (data) => {
        console.log('new signal');
    });

    peer.on("stream", (stream) => {
        console.log("new stream");
    });

    peer.on("connect", () => {
        console.log("new connected");
    });

    peer.on("error", (err) => {
        console.log(err);
    });

    peer.on("close", () => {
        console.log("new closed");
    });
    peer.signal(signal);
}