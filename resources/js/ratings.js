function likeUp(id) {
    $.ajax({
        url: "/ratings/ajax",
        method: "get",
        dataType: "json",
        data: {
            id: id,
            up: true,
        },
    })
        .fail(function (jqXHR, textStatus, errorThrown) {
            location.reload();
        })
        .done(function (data) {
            stars(data.movie, data.rating);
        });
}
window.likeUp = likeUp;

function likeDown(id) {
    $.ajax({
        url: "/ratings/ajax",
        method: "get",
        dataType: "json",
        data: {
            id: id,
            down: true,
        },
    })
        .fail(function (jqXHR, textStatus, errorThrown) {
            location.reload();
        })
        .done(function (data) {
            stars(data.movie, data.rating);
        });
}
window.likeDown = likeDown;

function stars(id, rating) {
    console.log(rating.rating);
    let v = rating.rating.toString().split(".");
    let stars = rating.rating != 0 ? 5 - Math.ceil(rating.rating) : 5;

    $("#" + id)
        .find(".stars")
        .empty();

    if (rating.rating != 0) {
        for (let i = 0; i < v[0]; i++) {
            let star = $("<i/>", {
                class: "fa-solid fa-star fa-xl",
                style: "color: #FFD43B;",
            });

            $("#" + id)
                .find(".stars")
                .append(star);
        }
        if (typeof v[1] !== "undefined" && v[1]) {
            let star = $("<i/>", {
                class: "fa-solid fa-star-half-stroke fa-xl",
                style: "color: #FFD43B;",
            });

            $("#" + id)
                .find(".stars")
                .append(star);
        }
    }

    for (let i = 0; i < stars; i++) {
        let star = $("<i/>", {
            class: "fa-regular fa-star fa-xl",
            style: "color: #FFD43B;",
        });

        $("#" + id)
            .find(".stars")
            .append(star);
    }
}

window.stars = stars;
