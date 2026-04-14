$(function () {
    let formLogin = $("#formLogin");

    formLogin.on("submit", function (event) {
        event.preventDefault();
        let correo = $("#correo");
        let password = $("#password");

        if (correo.val() === "" || password.val() === "") {
            alert("Debe completar todos los campos");
        } else {
            $.post(BASE_URL + "/index.php",
                {
                    correo: correo.val(),
                    password: password.val(),
                    option: "login"
                },
                function (data, status) {
                    console.log(data);
                    if (data.response == "00") {
                        if (data.rol == 'empleador') {
                            window.location = BASE_URL + "/?page=dashboardReclutador";
                        } else {
                            window.location = BASE_URL + "/?page=home";
                            
                        }
                    }alert(data.message)
                });
        }
    })
    console.log(window.location);
})