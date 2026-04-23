<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuscoBrete - Iniciar Sesión</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/styles.css">
    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
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
    <!-- JQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <!-- Script de autenticacion -->
    <script src="<?= BASE_URL ?>/public/js/auth.js"></script>
</head>

<body class="body-bckg">

    <!--Top Nav Bar  -->
    <?php require_once __DIR__ . '/templates/navbar.php'; ?>
    <!--Top Nav Bar  -->

    <main>
        <!-- PAGE HEADER -->
        <section class="py-5 text-center">
            <div class="container">
                <h2 class="auth-page-title">INICIAR SESIÓN</h2>
                <p class="auth-page-subtitle">Guarda empleos y postúlate más rápido</p>
            </div>
        </section>

        <!-- LOGIN FORM -->
        <section class="container mb-5">
            <div class="row justify-content-center">
                <div class="auth-card">
                    <h5>Iniciar sesión</h5>
                    <form id="formLogin">
                        <div class="mb-3">
                            <label class="auth-label" for="correo">Correo</label>
                            <input class="auth-input form-control mb-2" type="email" name="correo" id="correo" placeholder="correo@correo.com">
                        </div>
                        <div class="mb-3">
                            <label class="auth-label" for="contrasena">Contraseña</label>
                            <input type="password" class="form-control mb-2" name="password" id="password" placeholder="****************">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" id="recordarme">
                                <label class="form-check-label small" for="recordarme">Recordarme</label>
                            </div>
                            <a href="#" class="small text-primary text-decoration-none">¿Olvidaste tu contraseña?</a>
                        </div>

                        <button class="btn-auth" type="submit">Iniciar Sesión</button>
                    </form>
                    <div class="auth-divider">o</div>

                    <div class="auth-card-links">
                        <p class="mb-1">¿No tienes cuenta? <a href="<?= BASE_URL ?>/?page=registro">Registrarse</a></p>
                        <p class="mb-0">¿Eres empleador? <a href="<?= BASE_URL ?>/?page=dashboardReclutador">Publicar ofertas</a></p>
                        <p>Boton temporal para acceder al panel</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . '/templates/footer.php'; ?>
    <!-- FOOTER -->

</body>

</html>