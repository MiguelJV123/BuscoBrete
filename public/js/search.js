$(function () {
    let formSearchBar = $("#formSearchBar");
    formSearchBar.on("submit", function (event) {
        event.preventDefault();

        let keyword = $("#keyword").val();
        let provincia = $("#selectorProvincia").length ? $("#selectorProvincia").val() : "";
        let categoria = $("#selectorCategoria").length ? $("#selectorCategoria").val() : "";

        window.location = BASE_URL + "/?page=buscarEmpleos&keyword="
            + encodeURIComponent(keyword) + "&provincia="
            + encodeURIComponent(provincia) + "&categoria="
            + encodeURIComponent(categoria);
    });
});