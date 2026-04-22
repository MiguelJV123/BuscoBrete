<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Empleo</title>

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
        <div class="container" style="max-width: 700px;">

            <h2 class="fw-bold text-center mb-4">Publicar oferta</h2>

            <!-- Mensaje de resultado -->
            <div id="msgPublicar" class="mb-3"></div>

            <div class="card border-0 shadow-sm p-4">

                <!-- Titulo -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Título del puesto *</label>
                    <input type="text" id="titulo" class="form-control"
                        placeholder="Ej: Cajero de Minisuper">
                </div>

                <!-- Descripcion -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Descripción *</label>
                    <textarea id="descripcion" class="form-control" rows="4"
                        placeholder="¿Qué hace el puesto?"></textarea>
                </div>

                <!-- Requisitos -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Requisitos</label>
                    <textarea id="requisitos" class="form-control" rows="3"
                        placeholder="Experiencia, habilidades..."></textarea>
                </div>

                <!-- Botones -->
                <div class="d-flex gap-3">
                    <button id="btnPublicar" class="btn btn-success px-4">
                        Publicar
                    </button>
                    <a href="<?= BASE_URL ?>/?page=dashboardReclutador"
                        class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                </div>

            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/templates/footer.php'; ?>


    <!-- Nuevamente, script aqui para no hace un js -->
    <script>
        var BASE_URL = "<?= BASE_URL ?>";

        document.getElementById('btnPublicar').addEventListener('click', function() {
            var titulo = document.getElementById('titulo').value.trim();
            var descripcion = document.getElementById('descripcion').value.trim();
            var requisitos = document.getElementById('requisitos').value.trim();

            if (!titulo || !descripcion) {
                alert('Título y descripción son obligatorios.'); // Cambiar esto a algo mejorado.
                return;
            }

            var fd = new FormData();
            fd.append('option', 'publicarOferta');
            fd.append('titulo', titulo);
            fd.append('descripcion', descripcion);
            fd.append('requisitos', requisitos);

            fetch(BASE_URL + '/index.php', {
                    method: 'POST',
                    body: fd
                })
                .then(function(r) {
                    return r.json();
                })
                .then(function(data) {
                    var msg = document.getElementById('msgPublicar');
                    if (data.response === '00') {
                        msg.innerHTML = '<div class="alert alert-success">¡Oferta publicada!</div>';
                        document.getElementById('titulo').value = '';
                        document.getElementById('descripcion').value = '';
                        document.getElementById('requisitos').value = '';
                    } else {
                        msg.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                    }
                });
        });
    </script>

</body>

</html>