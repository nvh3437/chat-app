import '../../../../../resources/js/bootstrap';

var data = {
    isFocusMyself: true,
    callPlaced: false,
    callPartner: null,
    mutedAudio: false,
    mutedVideo: false,
    videoCallParams: {
        users: [],
        stream: null,
        receivingCall: false,
        caller: null,
        callerSignal: null,
        callAccepted: false,
        channel: null,
        peer1: null,
        peer2: null,
    },
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
            data.videoCallParams.stream = stream;
            // if (this.$refs.userVideo) {
            //     this.$refs.userVideo.srcObject = stream;
            // }
        })
        .catch((error) => {
            console.log(error);
        });
}

getMediaPermission()