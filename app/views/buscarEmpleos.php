<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuscoBrete - Buscar Empleos</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/styles.css">
    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
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
    <!-- JQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <!-- Script de busqueda -->
    <script src="<?= BASE_URL ?>/public/js/search.js"></script>
</head>

<body class="body-bckg">


    <!--Top Nav Bar  -->
    <?php require_once __DIR__ . '/templates/navbar.php'; ?>
    <!--Top Nav Bar  -->

    <main>
        <!-- BUSCADORR -->
        <section class="py-5 text-center">
            <div class="container">
                <h2 class="mb-2 text-center">Buscar empleos</h2>
                <p class="text-secondary text-center">
                    Explora oportunidades laborales en tecnología y negocios
                </p>
                <form id="formSearchBar">
                    <div class="row justify-content-center mt-4">

                        <!-- Barra busqueda mejorada -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-md-6">
                                <div class="input-group shadow-sm">
                                    <input
                                        class="form-control"
                                        name="keyword"
                                        id="keyword"
                                        placeholder="Busca por puesto, empresa o ubicación">
                                    <button class="btn btn-primary px-4">
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>

        <!-- RESULTADOS -->
        <section class="container mb-5">
            <div class="row g-5">
                <!-- FILTROS -->
                <div class="col-md-3 d-flex justify-content-center">
                    <div class="tarjeta-filtros p-3 text-center">
                        <h5 class="text-center mb-3">Filtros</h5>
                        <!--PROVINCIAS-->
                        <label class="small fw-bold">Provincia</label>
                        <select id="selectorProvincia" class="form-select mb-3">
                            <option value='' selected hidden>Seleccionar provincia</option>
                            <?php foreach ($provincias as $p) {
                                echo "<option value='" . $p['provincia'] . "'>" . ucwords($p['provincia']) . "</option>";
                            } ?>
                            <option value=''>Sin filtro</option>
                        </select>
                        <!--CATEGORIAS-->
                        <label class="small fw-bold">Categoria</label>
                        <select id="selectorCategoria" class="form-select mb-3">
                            <option value="" selected hidden>Seleccionar categoria</option>
                            <?php foreach ($categoriasDistinct as $cd) {
                                echo "<option value='" . $cd['nombre'] . "'>" . ucwords($cd['nombre']) . "</option>";
                            } ?>
                            <option value=''>Sin filtro</option>
                        </select>
                    </div>
                </div>
                </form>

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

                    <!-- tarjetas de ofertas -->
                    <?php foreach ($ofertas as $o) { ?>
                        <div class="tarjeta-trabajo p-4 mb-3">
                            <div class="row align-items-center text-center justify-content-center">
                                <div class="col-md-3 text-center">
                                    <h5><?php foreach ($empleadores as $e) {
                                            if ($e['idEmpleador'] == $o['idEmpleador']) {
                                                echo $e['nombreEmpresa'];
                                            }
                                        } ?></h5>
                                </div>

                                <!-- Importante centrarlo todo -->
                                <div class="col-md-6 text-center">
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

                                    <p class="text-secondary small mb-1">
                                        <?= htmlspecialchars($o['requisitos'] ?? '') ?>
                                    </p>
                                    <p class="text-secondary small mb-0">
                                        <?= ucwords($o['tipoEmpleo'] ?? '') ?>
                                        
                                        <!-- Al hacerlo así, los números se formatean correctamente -->
                                        <?php if ($o['salario']): ?>
                                            &nbsp;|&nbsp; ₡<?= number_format($o['salario'], 0, ',', '.') ?>
                                        <?php endif; ?>
                                    </p>

                                </div>
                                <div class="col-md-3 d-flex justify-content-center">
                                    <a href="<?= BASE_URL ?>/?page=verOferta&id=<?= $o['idOferta'] ?>"
                                        class="btn btn-primary px-4">
                                        Ver más
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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