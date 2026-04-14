<?php

ob_start();
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['rol'])) {
    $_SESSION['correo'] = 'invitado';
    $_SESSION['rol'] = 'invitado';
}
if(!defined('BASE_URL')) {
    define('BASE_URL', '/proyectoGit/BuscoBrete');
}

if (isset($_POST['option']) && $_POST['option'] === 'login') {
    ob_clean();
    header('Content-Type: application/json');

    $correo = isset($_POST['correo']) ? $_POST['correo'] :'';
    $password = isset($_POST['password']) ? $_POST['password'] :'';


    $_SESSION['usuario'] = $_POST['correo'];
    $_SESSION['rol'] = 'reclutador';
    echo json_encode(['response' => '00', 'rol' => $_SESSION['rol']]);
    exit;
}

require_once __DIR__ . '/app/controllers/TestController.php';
require_once __DIR__ . '/app/controllers/buscadorController.php';
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/reclutadorController.php';




$page = $_GET['page'] ?? 'home';



// ========== RUTAS FORMULARIO POST ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['option'] == "login") {
        $auth = new UserController();
        $auth->login();
        exit;
    }


if ($_POST['option'] == "logout") {
        $auth = new UserController();
        $auth->logout();
        exit;
    }
}


// ========== RUTAS DE VISTAS ==========
switch ($page) {

    case "home":
        $home = new UserController();
        $home->showHome();
        break;
    case "login":
        $auth = new UserController();
        $auth->showLogin();
        break;
    case "registro":
        $auth = new UserController();
        $auth->showRegistro();
        break;
    case "buscarEmpleos":
        $empleos = new buscadorController();
        $empleos->showBuscador();
        break;
    case "dashboardReclutador":
        $reclutador = new reclutadorController();
        $reclutador->showDashboardReclutador();
        break;
    case 'dashboardUsuario':
        $usuario = new UserController();
        $usuario->showDashboardUsuario();
        require 'app/views/dashboardUsuario.php';
        break;
    case "publicarOferta":
        $reclutador = new reclutadorController();
        $reclutador->showPublicarOferta();
        break;
    case 'ofertaInfo':
        $ofertaInfo = new buscadorController();
        $ofertaInfo->showOfertaInfo();
        require 'app/views/ofertaInfo.php';
        break;
    case 'logout':
        $auth = new UserController();
        $auth->logout();
        break;
            
   
}





