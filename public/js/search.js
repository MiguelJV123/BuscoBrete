$(function () {
    let formSearchBar = $("#formSearchBar");

    formSearchBar.on("submit", function (event) {
        event.preventDefault();
        let keyword = $("#keyword");

        if (keyword.val() == "") {
            alert("No hay parametro de busqueda");
        } else {
            $.post(BASE_URL + "/index.php",
                {
                    keyword: keyword.val(),
                    option: "busqueda"
                },
                function (data, status) {

                });

        }



    })



})