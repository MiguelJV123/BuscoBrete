<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Usuario</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/styles.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>

<body style="background-color: #eef2f5;">

    <?php require_once __DIR__ . '/templates/navbar.php'; ?>

    <main class="py-5">
        <div class="container" style="max-width: 1000px;">

            <h2 class="text-center mb-3">Panel del Usuario</h2>
            <p class="text-center text-muted mb-5">
                Gestiona tus postulaciones y revisa su estado
            </p>

            <div class="text-center mb-4">
                <a href="<?= BASE_URL ?>/?page=buscarEmpleos" class="btn btn-primary">
                    Buscar empleos
                </a>
            </div>
            <?php
            $total = 0;
            $aceptadas = 0;
            $pendientes = 0;
            $rechazadas = 0;
            $data = [];

            if ($postulaciones) {
                while ($p = $postulaciones->fetch_assoc()) {
                    $data[] = $p;
                    $total++;

                    if ($p['estado'] == 'aceptada') $aceptadas++;
                    if ($p['estado'] == 'pendiente') $pendientes++;
                    if ($p['estado'] == 'rechazada') $rechazadas++;
                }
            }
            ?>

            <!-- CARDS -->
            <div class="row text-center mb-5 g-3">

                <div class="col-md-3">
                    <div class="card p-3 shadow-sm border-0">
                        <h4 class="text-primary"><?= $total ?></h4>
                        <p class="mb-0">Total</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card p-3 shadow-sm border-0">
                        <h4 class="text-success"><?= $aceptadas ?></h4>
                        <p class="mb-0">Aceptadas</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card p-3 shadow-sm border-0">
                        <h4 class="text-warning"><?= $pendientes ?></h4>
                        <p class="mb-0">Pendientes</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card p-3 shadow-sm border-0">
                        <h4 class="text-danger"><?= $rechazadas ?></h4>
                        <p class="mb-0">Rechazadas</p>
                    </div>
                </div>

            </div>

            <!-- TABLA -->
            <div class="card shadow-sm p-4 border-0">

                <h5 class="mb-4">Mis postulaciones</h5>

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Puesto</th>
                            <th>Empresa</th>
                            <th>Ubicación</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $p): ?>

                                <tr>

                                    <td class="fw-semibold"><?= $p['titulo'] ?></td>

                                    <td class="text-muted"><?= $p['nombreEmpresa'] ?></td>

                                    <td class="text-muted">
                                        <?= $p['canton'] ?>, <?= $p['provincia'] ?>
                                    </td>

                                    <td>
                                        <?php if ($p['estado'] == 'pendiente'): ?>
                                            <span class="badge bg-warning text-dark">Pendiente</span>
                                        <?php elseif ($p['estado'] == 'aceptada'): ?>
                                            <span class="badge bg-success">Aceptada</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Rechazada</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?= date("d/m/Y", strtotime($p['fechaPostulacion'])) ?></td>

                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>

                                </tr>

                            <?php endforeach; ?>
                        <?php else: ?>

                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    No tienes postulaciones aún
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </main>

    <?php require_once __DIR__ . '/templates/footer.php'; ?>

</body>

</html>