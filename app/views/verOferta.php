<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuscoBrete - Detalle de oferta</title>
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

    <?php require_once __DIR__ . '/templates/navbar.php'; ?>

    <main class="py-5">
        <div class="container" style="max-width: 800px;">

            <?php if (!$oferta): ?>

                <div class="alert alert-warning">
                    No se encontró la oferta.
                    <a href="<?= BASE_URL ?>/?page=buscarEmpleos">Volver al buscador</a>
                </div>

            <?php else: ?>

                <!-- Titulo y empresa -->
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h2 class="fw-bold"><?= htmlspecialchars($oferta['titulo']) ?></h2>
                    <p class="text-secondary mb-0">
                        <?= ucwords($oferta['tipoEmpleo'] ?? '') ?>
                        &nbsp;|&nbsp;
                        ₡<?= number_format($oferta['salario'] ?? 0, 0, ',', '.') ?>
                    </p>
                </div>

                <!-- Descripcion -->
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold">Descripción</h5>
                    <p><?= nl2br(htmlspecialchars($oferta['descripcion'])) ?></p>
                </div>

                <!-- Requisitos -->
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold">Requisitos</h5>
                    <p><?= nl2br(htmlspecialchars($oferta['requisitos'] ?? 'No especificados.')) ?></p>
                </div>

                <!-- Botones (no puedo probar porque no tengo la base de datos integrada IMPORTANTE SER) -->
                <div class="d-flex gap-3">

                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'candidato'): ?>
                        <button id="btnAplicar" class="btn btn-primary"
                            data-id="<?= $oferta['idOferta'] ?>">
                            Aplicar
                        </button>
                    <?php elseif (!isset($_SESSION['idUsuario']) || $_SESSION['rol'] === 'invitado'): ?>
                        <a href="<?= BASE_URL ?>/?page=login" class="btn btn-primary">
                            Inicia sesión para aplicar
                        </a>
                    <?php endif; ?>

                    <a href="<?= BASE_URL ?>/?page=buscarEmpleos" class="btn btn-outline-secondary">
                        ← Volver
                    </a>

                </div>

                <!-- msg resultado -->
                <div id="msgAplicar" class="mt-3"></div>

            <?php endif; ?>

        </div>
    </main>

    <?php require_once __DIR__ . '/templates/footer.php'; ?>

    <!-- Script para aplicar a la oferta, aqui mismo, o toca hacer un js nuevo -->
    <script>
        var BASE_URL = "<?= BASE_URL ?>";

        var btn = document.getElementById('btnAplicar');
        if (btn) {
            btn.addEventListener('click', function() {
                var fd = new FormData();
                fd.append('option', 'aplicarOferta');
                fd.append('idOferta', this.dataset.id);

                fetch(BASE_URL + '/index.php', {
                        method: 'POST',
                        body: fd
                    })
                    .then(function(r) {
                        return r.json();
                    })
                    .then(function(data) {
                        var msg = document.getElementById('msgAplicar');
                        if (data.response === '00') {
                            msg.innerHTML = '<div class="alert alert-success">¡Postulación enviada!</div>';
                            btn.disabled = true;
                        } else {
                            msg.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                        }
                    });
            });
        }
    </script>

</body>

</html>