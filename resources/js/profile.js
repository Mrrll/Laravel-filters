function DeleteAvatar() {
    $.ajax({
        url: "/profile/ajax",
        method: "get",
        dataType: "json",
        data: {
            deleteavatar: $("#profile_id").val(),
        },
    }).done(function (data) {
        location.reload();
    });
}
window.DeleteAvatar = DeleteAvatar;
