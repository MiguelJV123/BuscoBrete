$(function () {
    $("#registroForm").on("submit", function (event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let apellido = $("#apellido").val();
        let correo = $("#correo").val();
        let contrasena = $("#contrasena").val();
        let confirmarContrasena = $("#confirmarContrasena").val();
        let terminos = $("#terminos").is(":checked");

        if (nombre === "" || apellido === "" || correo === "" || contrasena === "" || confirmarContrasena === "") {
            alert("Debe completar todos los campos");
            return;
        }

        if (contrasena !== confirmarContrasena) {
            alert("Las contraseñas no coinciden");
            return;
        }

        if (!terminos) {
            alert("Debe aceptar los términos y condiciones");
            return;
        }

        $.post(BASE_URL + "/index.php",
            {
                nombre: nombre,
                apellido: apellido,
                correo: correo,
                contrasena: contrasena,
                option: "registro"
            },
            function (data) {
                if (data.response == "00") {
                    alert("Cuenta creada exitosamente");
                    window.location = BASE_URL + "/?page=login";
                } else {
                    alert(data.message);
                }
            });
    });
});