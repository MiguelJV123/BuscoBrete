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
                    if (data.response == "00") {
                        if (data.rol == 'empleador') {
                            window.location = BASE_URL + "/?page=dashboardReclutador";
                        } else if (data.rol == 'candidato') {
                            window.location = BASE_URL + "/?page=home";                            
                        }else{alert(data.message)}
                    }
                });
        }
    })
    console.log(window.location);
})