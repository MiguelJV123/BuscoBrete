<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuscoBrete - Dashboard de Reclutador</title>
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

    <!-- MAIN -->
    <main>
        <div class="container py-4 d-flex flex-column gap-35">

            <!-- HERO -->
            <section class="text-center d-flex flex-column align-items-center py-4">
                <h1 class="bb-hero-title mb-2">Dashboard del Reclutador</h1>
                <p class="bb-hero-subtitle mb-0">Resumen y gestión de tus procesos de contratación</p>
            </section>

            <div class="d-flex gap-2 justify-content-center mb-4">
                <a href="<?= BASE_URL ?>/?page=publicarOferta" class="btn btn-success">
                    + Publicar nueva oferta de empleo
                </a>
                <a href="<?= BASE_URL ?>/?page=buscarEmpleos" class="btn btn-outline-secondary">
                    Ver buscador de empleos
                </a>
            </div>

            <!-- STATS -->
            <section class="d-flex justify-content-center">
                <div class="d-flex flex-wrap justify-content-center gap-80">
                    <div class="bb-stat-card d-flex flex-column gap-1">
                        <div class="bb-number"><?= count($ofertasXEmpleador) ?></div>
                        <div class="bb-label">Ofertas</div>
                        <div class="bb-small">Publicadas</div>
                    </div>
                    <div class="bb-stat-card d-flex flex-column gap-1">
                        <div class="bb-number"><?= count($postulacionesXEmpleador) ?></div>
                        <div class="bb-label">Postulaciones</div>
                        <div class="bb-small">Recibidas</div>
                    </div>
                    <div class="bb-stat-card d-flex flex-column gap-1">
                        <div class="bb-number">7</div>
                        <div class="bb-label">Entrevistas</div>
                        <div class="bb-small">Pendientes</div>
                    </div>
                    <div class="bb-stat-card d-flex flex-column gap-1">
                        <div class="bb-number">3</div>
                        <div class="bb-label">Mensajes</div>
                        <div class="bb-small">Alertas</div>
                    </div>
                </div>
            </section>

            <!-- GESTIÓN DE OFERTAS -->
            <section class="d-flex flex-column align-items-center text-center">
                <h2 class="fs-5 fw-bold mb-1" style="color:#1F2937;">Gestión de Ofertas</h2>
                <p class="small fw-bold mb-3" style="color:#475569;">Administra y supervisa las vacantes
                    publicadas</p>

                <div class="bb-card w-100 d-flex flex-column align-items-center p-3" style="max-width:1000px;">
                    <!-- Table Header -->
                    <div class="bb-table-header w-100 px-3 py-2 d-none d-md-flex"
                        style="border-radius: 12px 12px 0 0;">
                        <div class="d-flex w-100">
                            <div class="flex-grow-1 ">Puesto</div>
                            <div class="flex-grow-1">Ubicación</div>
                            <div class="flex-grow-1">Estado</div>
                            <div class="flex-grow-1">Postulaciones</div>
                            <div style="width:0px" class="flex-grow-1">Acción</div>
                        </div>
                    </div>

                    <!-- A posterior se cargaran desde la db -->
                    <div class="w-100">
                        <!-- fila 1 -->
                        <? foreach ($ofertasXEmpleador as $o) { ?>
                            <div class="bb-row d-flex align-items-center px-3 py-2">
                                <div class="flex-grow-1"><? echo $o['titulo']; ?></div>
                                <div class="flex-grow-1"><? echo $o['provincia']; ?></div>
                                <div class="flex-grow-1">
                                    <? if ($o['estado'] == 'activa') {
                                        echo '<span class="bb-badge bb-badge--green">Activo</span>';
                                    } elseif ($o['estado'] == 'cerrada') {
                                        echo '<span class="bb-badge bb-badge--red">Cerrado</span>';
                                    } elseif ($o['estado'] == 'pausada') {
                                        echo '<span class="bb-badge bb-badge--red">Pausado</span>';
                                    }

                                    ?>
                                </div>
                                <div class="flex-grow-1"><?  ?></div>
                                <div style="width:100px">
                                    <button class="bb-btn-chip w-100">Ver</button>
                                </div>
                            </div>
                        <? } ?>



                        <!-- Ver todas -->
                        <div class="mt-3">
                            <button class="bb-btn-primary">
                                Ver todas las ofertas &rarr;
                            </button>
                        </div>
                    </div>
            </section>

            <!-- POSTULACIONES RECIENTES -->
            <section class="d-flex flex-column align-items-center text-center">
                <h2 class="fs-5 fw-bold mb-1" style="color:#1F2937;">Postulaciones recientes</h2>
                <p class="small fw-bold mb-3" style="color:#475569;">Candidatos que aplicaron recientemente a
                    tus ofertas</p>

                <div class="bb-card w-100 d-flex flex-column align-items-center p-3" style="max-width:1000px;">
                    <!-- Table Header -->
                    <div class="bb-table-header w-100 px-3 py-2 d-none d-md-flex"
                        style="border-radius: 12px 12px 0 0;">
                        <div class="d-flex w-100">
                            <div class="flex-grow-1 text-center">Candidato</div>
                            <div class="flex-grow-1 text-center">Puesto Aplicado</div>
                            <div class="flex-grow-1 text-center">Fecha</div>
                            <div class="flex-grow-1 text-center">Acción</div>
                        </div>
                    </div>

                    <!-- filas seran cargadas de la db -->
                    <div class="w-100">
                        <!-- fila 1 -->

                        <?
                        foreach ($postulacionesXEmpleador as $p) {
                        ?>
                            <div class="bb-row d-flex align-items-center px-3 py-2">
                                <div class="flex-grow-1 text-center"><? echo $p['nombreCandidato'] . ' ' . $p['apellidosCandidato'] ?></div>
                                <div class="flex-grow-1 text-center"><? echo $p['oferta'] ?></div>
                                <div class="flex-grow-1 text-center"><? echo $p['fechaPostulacion'] ?></div>
                                <div class="flex-grow-1 d-flex justify-content-center">
                                    <button class="bb-btn-chip" style="min-width:93px;">Ver</button>
                                </div>
                            </div>
                        <? } ?>
                    </div>



                </div>
            </section>

            <!-- NOTIFICACIONES RECIENTES -->
            <section class="d-flex flex-column align-items-center text-center">
                <h2 class="fs-6 fw-bold mb-1" style="color:#000;">Notificaciones recientes</h2>
                <p class="small fw-bold mb-3" style="color:#475569;">Alertas y movimientos relevantes de tu
                    panel</p>

                <div class="bb-card w-100 d-flex flex-column align-items-center p-3" style="max-width:764px;">
                    <!-- Activity Item -->
                    <div class="bb-activity-item w-100 d-flex align-items-center gap-3 px-3 py-2">
                        <div class="text-primary"
                            style="width:30px;height:30px; display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-bell-fill"></i>
                        </div>
                        <div class="flex-grow-1 text-start">Nueva postulación en “Diseñador UI”.</div>
                        <div class="bb-activity-time">hace 5 min</div>
                    </div>

                    <div class="bb-activity-item w-100 d-flex align-items-center gap-3 px-3 py-2">
                        <div class="text-primary"
                            style="width:30px;height:30px; display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="flex-grow-1 text-start">3 candidatos añadidos a “En revisión”.</div>
                        <div class="bb-activity-time">hace 1 h</div>
                    </div>

                    <div class="bb-activity-item w-100 d-flex align-items-center gap-3 px-3 py-2">
                        <div class="text-primary"
                            style="width:30px;height:30px; display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="flex-grow-1 text-start">Tienes 2 mensajes pendientes.</div>
                        <div class="bb-activity-time">hoy</div>
                    </div>

                    <div class="bb-activity-item w-100 d-flex align-items-center gap-3 px-3 py-2">
                        <div class="text-primary"
                            style="width:30px;height:30px; display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-calendar-event-fill"></i>
                        </div>
                        <div class="flex-grow-1 text-start">Nueva entrevista programada para mañana.</div>
                        <div class="bb-activity-time">ayer</div>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . '/templates/footer.php'; ?>
    <!-- FOOTER -->
</body>

</html>