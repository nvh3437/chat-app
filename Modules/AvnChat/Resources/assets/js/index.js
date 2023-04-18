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
