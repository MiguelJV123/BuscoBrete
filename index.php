<?php
//session_destroy();
ob_start();

if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['rol'])) {
    $_SESSION['usuario'] = 'invitado';
    $_SESSION['rol'] = 'invitado';
}

/*
    if(!defined('BASE_URL'))
        define('BASE_URL', '/BuscoBrete');
*/
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
define('BASE_URL', $basePath === '/' ? '' : $basePath);

require_once __DIR__ . '/app/controllers/TestController.php';
require_once __DIR__ . '/app/controllers/buscadorController.php';
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/reclutadorController.php';

//var_dump($_SESSION);

$page = $_GET['page'] ?? 'home';


// ========== POST ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 

    ob_clean(); // Limpia cualquier salida previa para JSON limpio
    header('Content-Type: application/json');

    $option = $_POST['option'] ?? null;

    if (!$option) {
        http_response_code(400);
        echo json_encode(['error' => 'No se especificó opción']);
        exit;
    }

    switch ($option) {

        case 'login':
            (new UserController())->login();
            break;

        case 'logout':
            (new UserController())->logout();
            break;

        case 'publicarOferta':
            (new reclutadorController())->publicarOferta();
            break;

        case 'aplicarOferta':
            (new UserController())->aplicarOferta();
            break;

        case 'busqueda':
            (new buscadorController())->getBySearch();
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Opción no válida']);
            break;
    }

    exit;
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