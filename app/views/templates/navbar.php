<?php
// PAG actual para marcar link activo
$paginaActual = $_GET['page'] ?? 'home';
?>

<!-- INVITADO -->
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
                        <!-- Esto lo que hace es marcar el link como activo si estamos en la página de inicio -->
                        <a href="<?= BASE_URL ?>/?page=home" class="nav-link <?= $paginaActual == 'home' ? 'active' : '' ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <!-- Activo si estamos en la pag correcta -->
                        <a href="<?= BASE_URL ?>/?page=buscarEmpleos" class="nav-link <?= $paginaActual == 'buscarEmpleos' ? 'active' : '' ?>">Buscar empleos</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=login" class="nav-link">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=registro" class="btn btn-primary">Registrarse</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CANDIDATO -->
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
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=home" class="nav-link <?= $paginaActual == 'home' ? 'active' : '' ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=buscarEmpleos" class="nav-link <?= $paginaActual == 'buscarEmpleos' ? 'active' : '' ?>">Buscar empleos</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=dashboardUsuario" class="nav-link <?= $paginaActual == 'dashboardUsuario' ? 'active' : '' ?>">Mi panel</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="d-flex align-items-center gap-2 px-2 nav-link dropdown-toggle"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <!-- Avatar simple CON sesión iniciada, gracias a bootstrap <3 -->
                            <div class="bb-avatar"></div>

                            <!-- Nombre del usuario (activo) -->
                            <span class="fw-semibold">
                                <?php echo $_SESSION['usuario']; ?>
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="<?= BASE_URL ?>/?page=dashboardUsuario">
                                    Mi perfil
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="<?= BASE_URL ?>/index.php">
                                    <input type="hidden" name="option" value="logout">
                                    <button type="submit"
                                        class="dropdown-item text-danger w-100 text-start border-0 bg-transparent px-4">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- EMPLEADOR -->
<?php elseif ($_SESSION['rol'] == 'empleador'): ?>
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
                        <a href="<?= BASE_URL ?>/?page=home" class="nav-link <?= $paginaActual == 'home' ? 'active' : '' ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=buscarEmpleos" class="nav-link <?= $paginaActual == 'buscarEmpleos' ? 'active' : '' ?>">Buscar empleos</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=dashboardReclutador" class="nav-link <?= $paginaActual == 'dashboardReclutador' ? 'active' : '' ?>">Panel reclutador</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/?page=publicarOferta" class="btn btn-success">+ Publicar oferta</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="d-flex align-items-center gap-2 px-2 nav-link dropdown-toggle"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <!-- Avatar simple CON sesión iniciada, gracias a bootstrap <3 -->
                            <div class="bb-avatar"></div>

                            <!-- Nombre del usuario (activo) -->
                            <span class="fw-semibold">
                                <?php echo $_SESSION['usuario']; ?>
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="<?= BASE_URL ?>/?page=dashboardReclutador">
                                    Panel reclutador
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= BASE_URL ?>/?page=publicarOferta">
                                    Publicar oferta de empleo
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Cambiar a post el cerrar sesion para prevenir "CSRF"  -->
                            <li>
                                <form method="POST" action="<?= BASE_URL ?>/index.php">
                                    <input type="hidden" name="option" value="logout">
                                    <button type="submit"
                                        class="dropdown-item text-danger w-100 text-start border-0 bg-transparent px-4">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<?php endif; ?>