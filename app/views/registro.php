<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuscoBrete - Registro</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/styles.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- Inter font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body class="body-bckg">

    <!--Top Nav Bar  -->
    <?php require_once __DIR__ .'/templates/navbar.php';?>
    <!--Top Nav Bar  -->

    <main>
        <!-- PAGE HEADER -->
        <section class="py-5 text-center">
            <div class="container">
                <h2 class="auth-page-title">CREAR CUENTA</h2>
                <p class="auth-page-subtitle">Crea tu perfil y empieza a postularte</p>
            </div>
        </section>

        <!-- REGISTRO FORM -->
        <section class="container mb-5">
            <div class="row justify-content-center">
                <div class="auth-card">
                    <h5>Crear Cuenta</h5>

                    <div class="mb-3">
                        <label class="auth-label" for="nombreCompleto">Nombre Completo</label>
                        <input class="auth-input" type="text" id="nombreCompleto" placeholder="Nombre Apellido1 Apellido2">
                    </div>

                    <div class="mb-3">
                        <label class="auth-label" for="correo">Correo</label>
                        <input class="auth-input" type="email" id="correo" placeholder="correo@correo.com">
                    </div>

                    <div class="mb-3">
                        <label class="auth-label" for="contrasena">Contraseña</label>
                        <input class="auth-input" type="password" id="contrasena" placeholder="****************">
                    </div>

                    <div class="mb-3">
                        <label class="auth-label" for="confirmarContrasena">Confirmar contraseña</label>
                        <input class="auth-input" type="password" id="confirmarContrasena" placeholder="****************">
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="terminos">
                        <label class="form-check-label small" for="terminos">
                            Acepto <a href="#" class="text-primary text-decoration-none">términos y condiciones</a>
                        </label>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="ofertas">
                        <label class="form-check-label small" for="ofertas">Recibir ofertas por correo</label>
                    </div>

                    <button class="btn-auth" onclick="crearCuenta()">Crear Cuenta</button>

                    <div class="auth-divider">o</div>

                    <div class="auth-card-links">
                        <p class="mb-0">¿Ya tienes cuenta? <a href="<?= BASE_URL ?>/?page=login">Iniciar sesión</a></p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ .'/templates/footer.php';?>
    <!-- FOOTER -->

</body>
</html>