<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuscoBrete - Buscar Empleos</title>
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


        <!-- Boton para publicar ofertas, se ve teeerrrible :D -->
        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'empleador'): ?>
            <div class="text-end mb-3">
                <a href="<?= BASE_URL ?>/?page=publicarOferta" class="btn btn-success">
                    + Publicar oferta
                </a>
            </div>
        <?php endif; ?>

        <!-- BUSCADORR -->
        <section class="py-5 text-center">
            <div class="container">
                <h2 class="mb-2 text-center">Buscar empleos</h2>
                <p class="text-secondary text-center">
                    Explora oportunidades laborales en tecnología y negocios
                </p>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-7">
                        <div class="buscador input-group">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input class="form-control border-0" placeholder="Busca por puesto, empresa o ubicación">
                            <button class="btn btn-primary">
                                Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- RESULTADOS -->
        <section class="container mb-5">
            <div class="row g-5">
                <!-- FILTROS -->
                <div class="col-md-3">
                    <div class="tarjeta-filtros p-3">
                        <h5 class="text-center mb-3">Filtros</h5>
                        <!--PROVINCIAS-->
                        <label class="small fw-bold">Provincia</label>
                        <select class="form-select mb-3">
                            <option value="" disabled selected hidden>Seleccionar provincia</option>
                            <?php foreach ($provincias as $p) {
                                echo "<option value='" . $p['provincia'] . "'>" . ucwords($p['provincia']) . "</option>";
                            } ?>
                        </select>
                        <!--TIPO DE EMPLEO-->
                        <label class="small fw-bold">Tipo de empleo</label>
                        <select class="form-select mb-3">
                            <option value="" disabled selected hidden>Seleccionar tipo de empleo</option>
                            <option value="internship">WORK IN PROGRESS</option>
                            <option value="freelance">WORK IN PROGRESS</option>
                            <option value="full-time">WORK IN PROGRESS</option>
                        </select>
                        <!--CATEGORIAS-->
                        <label class="small fw-bold">Categoria</label>
                        <select class="form-select mb-3">
                            <option value="" disabled selected hidden>Seleccionar categoria</option>
                            <?php foreach ($categoriasDistinct as $cd) {
                                echo "<option value='" . $cd['nombre'] . "'>" . ucwords($cd['nombre']) . "</option>";
                            } ?>
                        </select>
                        <!--MODALIDAD-->
                        <label class="small fw-bold">Modalidad</label>
                        <select class="form-select">
                            <option value="" disabled selected hidden>Seleccionar modalidad</option>
                            <option value="presencial">WORK IN PROGRESS</option>
                            <option value="hibrido">WORK IN PROGRESS</option>
                            <option value="virtual">WORK IN PROGRESS</option>
                        </select>
                    </div>
                </div>


                <!-- RESULTADOS EMPLEOS -->
                <div class="col-md-9">
                    <div class="d-flex justify-content-between mb-3">
                        <h5>Resultados (<?= count($ofertas) ?>)</h5>
                        <select class="form-select w-auto">
                            <option value="" disabled selected hidden>Ordenar por</option>
                            <option>WORK IN PROGRESS</option>
                            <option>WORK IN PROGRESS</option>
                        </select>
                    </div>
                    <!-- Los resultados se modificaran con informacion desde la DB -->
                    <!-- tarjeta 1 -->
                    <?php foreach ($ofertas as $o) { ?>
                        <div class="tarjeta-trabajo p-4 mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center">
                                    <h5><?php foreach ($empleadores as $e) {
                                            if ($e['idEmpleador'] == $o['idEmpleador']) {
                                                echo $e['nombreEmpresa'];
                                            }
                                        } ?></h5>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold">
                                        <?= $o['titulo'] ?>
                                    </h6>
                                    <p class="text-primary mb-1">
                                        <? foreach ($ubicaciones as $u) {
                                            if ($u['idUbicacion'] == $o['idUbicacion']) {
                                                echo $u['provincia'] . ', ' . $u['canton'];
                                            }
                                        } ?>
                                    </p>
                                    <p class="text-secondary small">
                                        <?= $o['requisitos'] ?>
                                    </p>
                                    <p class="text-secondary small">
                                        <? foreach ($categorias as $c) {
                                            if ($c['idCategoria'] == $o['idCategoria']) {
                                                echo $c['nombre'];
                                            }
                                        } ?> <? echo ' | ' . ucwords($o['tipoEmpleo']) . ' | ₡' . $o['salario'] ?>
                                    </p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <a href="<?= BASE_URL ?>/?page=verOferta&id=<?= $o['idOferta'] ?>"
                                        class="btn btn-primary btn-sm d-block mb-2">
                                        Ver más
                                    </a>
                                    <br>
                                    <button class="btn btn-light btn-sm" id="btnGuardar">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div><?php } ?>
                    <!-- ¿Las otras tarjetas no son necestarias? No se porque se dejaron si se tiene un for each-->
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