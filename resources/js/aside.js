function showFilter() {
    $("#aside").toggleClass("d-none");
    $("#form_search").toggleClass("d-none");
}

window.showFilter = showFilter;

$(".btn-collapse").on("click", function () {
    $(this).toggleClass("active");
});
