$(function () {
    $(".toast").toast("show");
});

$(".toast").on("shown.bs.toast", function () {
    let dt = new Date();
    let time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    $(this).children(".toast-header").children("#date_toasts").html(time);

    let progress_bar = {
        "animation-name": "progress_toast",
        "animation-fill-mode": "forwards",
        "animation-duration": $(this).data("bs-delay") + "ms",
        "animation-timing-function": "ease-out",
        "animation-iteration-count": "1",
    };

    if ($(this).data("bs-autohide")) {
        $(this).children(".progress").children("div").css(progress_bar);
    }
});

$("#close_toats").on("click", function () {
    $(this).closest(".toast").addClass("close-toast");
    setTimeout(() => {
        $(this).closest(".toast").toast("hide");
    }, 2500);
});

$(".toast").on("hidden.bs.toast", function () {
    $(this).addClass("close-toast");
});
