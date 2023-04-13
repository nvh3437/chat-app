import '../../../../../resources/js/bootstrap';
$(document).ready(function () {

    $(document).on('click', '#send_message', function (e) {
        e.preventDefault();

        let user = $('#user').val();
        let message = $('#message').val();

        if (user == '' || message == '') {
            alert('Please enter both user and message')
            return false;
        }

        $.ajax({
            method: 'post',
            url: 'http://localhost:8080/japan-chat-app/api/avnchat/send-message',
            data: { user: user, message: message },
            success: function (res) {
                //
            }
        });

    });
});

window.Echo.channel('chat')
    .listen('.message', (e) => {
        $('#messages').append('<p><strong>' + e.user + '</strong>' + ': ' + e.message + '</p>');
        $('#message').val('');
    });