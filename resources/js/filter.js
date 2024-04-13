$(".filter").on("change", function () {
    let data = {};
    let search = $("#search_filters").val();
    data["search"] = search != "" ? search : null;
    data["tags"] = [];
    if (this.name === "gender") {
        data[this.name] = this.value;

        $("input[name=tag]").each(function () {
            if ($(this).is(":checked")) {
                data["tags"].push(this.value);
            }
        });

        if ($("#checkstar").is(":checked")) {
            data["stars"] = $("input[name=filter_star]").val();
        }
    }
    if (this.name === "filter_star") {
        $("input[name=gender]").each(function () {
            if ($(this).is(":checked")) {
                data[this.name] = this.value;
            }
        });

        $("input[name=tag]").each(function () {
            if ($(this).is(":checked")) {
                data["tags"].push(this.value);
            }
        });
        data["stars"] = this.value;
    }
    if (this.name === "tag") {
        $("input[name=gender]").each(function () {
            if ($(this).is(":checked")) {
                data[this.name] = this.value;
            }
        });

        $("input[name=tag]").each(function () {
            if ($(this).is(":checked")) {
                data["tags"].push(this.value);
            }
        });

        if ($("#checkstar").is(":checked")) {
            data["stars"] = $("input[name=filter_star]").val();
        }
    }

    if (data["tags"].length == 0) {
        data["tags"] = null;
    }

    $.ajax({
        url: "/filters/ajax",
        method: "get",
        dataType: "json",
        data: {
            search: data["search"],
            gender: data["gender"],
            tags: data["tags"],
            stars: data["stars"],
        },
    }).done(function (data) {
        $(".content-movies").empty();
        $(".content-movies").append(data);
        let count_links = $("#count_links").val();
        let total_links = $("#total_links").val();
        $("#info_links").empty();
        $("#info_links").append(
            "Movies " + count_links + " of " + total_links
        );
    });
});

function FilterStars(e) {
    let rating = {
        rating: $(e.target).val(),
    };
    stars("rangeStars", rating);
}

window.FilterStars = FilterStars;

$("#btn_star").on("click", function () {
    $("#checkstar").is(":checked")
        ? $("#checkstar").prop("checked", false)
        : $("#checkstar").prop("checked", true);
});

$(function () {
    if (!$("#collapseStars").is(":visible")) {
        $("#checkstar").prop("checked", false);
        $("input[name=filter_star]").val("");
    }
});

function getData(page) {
    let data = {};
    let search = $("#search_filters").val();
    data["search"] = search != "" ? search : null;
    data["tags"] = [];

    $("input[name=gender]").each(function () {
        if ($(this).is(":checked")) {
            data[this.name] = this.value;
        }
    });

    $("input[name=tag]").each(function () {
        if ($(this).is(":checked")) {
            data["tags"].push(this.value);
        }
    });

    if ($("#checkstar").is(":checked")) {
        data["stars"] = $("input[name=filter_star]").val();
    }

    $.ajax({
        url: page,
        method: "get",
        dataType: "json",
        data: {
            search: data["search"],
            gender: data["gender"],
            tags: data["tags"],
            stars: data["stars"],
        },
   }).done(function (data) {
        $(".content-movies").empty();
        $(".content-movies").append(data);

        let count_links =
            $("#hasMorePages_links").val() == ""
                ? $("#total_links").val()
                : $("#count_links").val();
        let total_links = $("#total_links").val();
        let previousPageUrl_links = $("#previousPageUrl_links")
            .val()
            .split("=");

        let m_links = $("#hasMorePages_links").val() == "" ? 0 : 3;

        previousPageUrl_links =
            previousPageUrl_links.length <= 1
                ? previousPageUrl_links
                : previousPageUrl_links[1];

        previousPageUrl_links =
            parseInt(previousPageUrl_links * m_links) +
            parseInt(count_links);
        $("#info_links").empty();
        $("#info_links").append(
            "Movies " + previousPageUrl_links + " of " + total_links
        );
    });
}

$(document).on("click", ".pagination a", function (e) {

    if (/filters/.test($(this).attr("href"))) {
        $("li").removeClass("active");
        $(this).parent("li").addClass("active");
        e.preventDefault();

        var page = $(this).attr("href");

        getData(page);
    }
});
