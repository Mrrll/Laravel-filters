$(function () {
    let values = $("input[name=tags]").val();
    $("input[name=tags]").val("");
    if (values != "" && values != undefined) {
        values = values.split(",");
        values.forEach((element) => {
            tags(null, element);
        });
    }
    let movie_id = $("#list_tags").data("movie");
    if (movie_id != "" && movie_id != undefined) {
        $.ajax({
            url: "/tags/ajax",
            method: "get",
            dataType: "json",
            data: {
                id: movie_id,
                select: true,
            },
        }).done(function (data) {
            data.forEach((element) => {
                tags(null, element.id);
            });
        });
    }
});

function tags(e, id = null) {
    console.log("hola");
    id = id != null ? id : e.target.value;
    $.ajax({
        url: "/tags/ajax",
        method: "get",
        dataType: "json",
        data: {
            id: id,
        },
    }).done(function (data) {
        console.log(data);
        let value = $("input[name=tags]").val();
        let list_tags = $("#list_tags");

        let badge = $("<span/>", {
            id: data.id,
            class: "badge bg-secondary me-1",
            html: data.name,
        });
        let btn_close = $("<button/>", {
            class: "btn btn-close btn-xs btn-close-white ms-1",
            onClick: "deleteTag(event)",
        });

        badge.append(btn_close);
        if (list_tags.find("#" + data.id).length < 1) {
            list_tags.append(badge);
            value = value != "" ? value + "," + data.id : data.id;
        }
        $("input[name=tags]").val(value);
    });
}
window.tags = tags;

function deleteTag(e) {
    let id = $(e.target).parent()[0].id;
    let value = $("input[name=tags]").val();
    let patron = new RegExp(`[${id}]`, "g");
    let new_value = value.replace(patron, "");
    new_value = new_value.replace(",,", ",");
    new_value = new_value.replace(/^[,]|[,]$/, "");
    $("input[name=tags]").val(new_value);
    $(e.target).parent().remove();
}
window.deleteTag = deleteTag;

function tagsEdit(tags) {
    console.log(tags);
}
