<?php if ($_SESSION['rol'] == 'invitado'): ?>
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container-fluid px-4">
            <a href="<?= BASE_URL ?>/?page=home" class="navbar-brand fw-bold fs-4">
                <span class="brand-busco">Busco</span><span class="brand-brete">Brete</span>
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="menu">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=home" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=buscarEmpleos" class="nav-link">Buscar empleos</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=login" class="nav-link">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=registro"><button class="btn btn-primary">Registrarse</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php elseif ($_SESSION['rol'] == 'candidato'): ?>
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container-fluid px-4">
            <a href="<?= BASE_URL ?>/?page=home" class="navbar-brand fw-bold fs-4">
                <span class="brand-busco">Busco</span><span class="brand-brete">Brete</span>
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="menu">
                <ul class="navbar-nav align-items-center gap-3">
                    <li>
                    <a href="<?= BASE_URL ?>/?page=home" class="nav-link <?php if ($_GET['page'] == 'home') {
                          echo 'active';
                      } ?>">Inicio</a>
                    </li>
                    <li>
                    <a href="<?= BASE_URL ?>/?page=buscarEmpleos" class="nav-link <?php if ($_GET['page'] == 'buscarEmpleos') {
                          echo 'active';
                      } ?>">Buscar empleos</a>
                    </li>

                    <li>
                    <a href="<?= BASE_URL ?>/?page=dashboardUsuario" class="nav-link <?php if ($_GET['page'] == 'dashboardUsuario') {
                          echo 'active';
                      } ?>">Panel de usuario</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary">
                            <a class="nav-item text-white text-decoration-none" href="index.php?page=logout">Cerrar
                                Sesion</a>
                        </button>
                    </li>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle shadow-sm bb-hi-btn" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="bb-avatar mx-auto"></div>
                            <?php echo $_SESSION['usuario'] ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Publicar ofertas</a>
                            <a class="dropdown-item" href="#">Información personal</a>
                            <a class="dropdown-item" href="#">Configuración</a>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
<?php elseif ($_SESSION['rol'] == 'empleador'): ?>
    <!--// RECLUTADOR -->
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container-fluid px-4">
            <a href="<?= BASE_URL ?>/?page=home" class="navbar-brand fw-bold fs-4">
                <span class="brand-busco">Busco</span><span class="brand-brete">Brete</span>
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="menu">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=home" class="nav-link <?php if ($_GET['page'] == 'home') {
                              echo 'active';
                          } ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=buscarEmpleos" class="nav-link <?php if ($_GET['page'] == 'buscarEmpleos') {
                              echo 'active';
                          } ?>">Publicar
                            empleos</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=dashboardReclutador" class="nav-link <?php if ($_GET['page'] == 'dashboardReclutador') {
                              echo 'active';
                          } ?>">Panel de
                            reclutador</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary">
                            <a class="nav-item text-white text-decoration-none" href="index.php?page=logout">Cerrar
                                Sesion</a>
                        </button>
                    </li>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle shadow-sm bb-hi-btn" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="bb-avatar mx-auto"></div>
                            <?php echo $_SESSION['usuario'] ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Publicar ofertas</a>
                            <a class="dropdown-item" href="#">Información personal</a>
                            <a class="dropdown-item" href="#">Configuración</a>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
<?php endif; ?>