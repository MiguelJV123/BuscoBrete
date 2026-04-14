<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuscoBrete - Home</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/styles.css">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <!-- Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- Inter font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
</head>

<body class="body-bckg">



    <!--Top Nav Bar  -->
<?php require_once __DIR__ . '/templates/navbar.php'; ?>
    <!--Top Nav Bar  -->

    <main>
        <!-- top banner -->
        <section class="topBanner">
            <div class="container">
                <h1 class="fw-bold display-5 mb-3 text-center shado">
                    Encuentra tu próximo empleo <br> hoy
                </h1>
                <p class="mb-4 text-center">
                    Explora miles de oportunidades en tecnología, negocios y más
                </p>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="input-group shadow">
                            <input class="form-control form-control-lg text-center"
                                placeholder="Busca por puesto, empresa o ubicación">
                            <button class="btn btn-primary">
                                Buscar
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- OFERTAS DESTACADAS -->
        <section class="destacadas">
            <div class="container text-center">
                <p class="text-primary fw-bold small text-center">
                    PARA TI
                </p>
                <h2 class="fw-bold mb-2 text-center">
                    Ofertas Destacadas
                </h2>
                <p class="text-muted mb-5 text-center">
                    Explora oportunidades recomendadas según tu perfil.
                </p>

                
                <div class="row g-4">
                    <?
                    $i = 0;
                    foreach ($ofertas as $o) {
                        if ($i >= 4)
                            break;
                        ?>
                        <!-- tarjeta -->
                        <div class="col-md-3">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="fw-bold">
                                        <?= $o['titulo'] ?>
                                    </h5>
                                    <p class="text-muted">
                                        <? foreach ($ubicaciones as $u) {
                                            if ($u['idUbicacion'] == $o['idUbicacion']) {
                                                echo $u['provincia'] . ', ' . $u['canton'];
                                            }
                                        } ?>
                                    </p>
                                    <p class="text-secondary">
                                        <?= $o['requisitos'] ?>
                                    </p>
                                    <button class="btn btn-primary btn-sm">
                                        Ver más
                                    </button>
                                </div>
                            </div>
                        </div>
                        <? $i++;
                    } ?>

                </div>
            </div>
        </section>

        <!-- ofrecer la cuenta -->
        <section class="ofrecerCuenta">
            <div class="container">
                <h2 class="display-6 fw-bold mb-3 text-center">
                    Crea tu cuenta y empieza a <br> postularte hoy
                </h2>
                <p class="mb-4 text-center">
                    Guarda ofertas, postúlate rápido y recibe recomendaciones.
                </p>
                <div class="d-flex flex-column justify-content-center gap-3 ">
                    <ul class="d-flex flex-column align-items-center list-unstyled center">
                        <li>
                            <a href="<?= BASE_URL ?>/?page=registro"><button class="btn btn-primary mb-2">
                                    Crear cuenta gratis</button></a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/?page=buscarEmpleos"><button class="btn btn-light mb-2">
                                    Ver ofertas</button></a>
                        </li>
                        <button class="btn btn-primary">
                            <a class="nav-link" href="index.php?page=logout">Cerrar Sesion</a>    
                        </button> 
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . '/templates/footer.php'; ?>
    <!-- FOOTER -->


</body>

</html>