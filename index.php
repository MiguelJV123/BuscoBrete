<?php
//session_destroy();
ob_start();
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['rol'])) {
    $_SESSION['usuario'] = 'invitado';
    $_SESSION['rol'] = 'invitado';
}


if(!defined('BASE_URL'))
    define('BASE_URL', '/proyectoGit/BuscoBrete');

require_once __DIR__ . '/app/controllers/TestController.php';
require_once __DIR__ . '/app/controllers/buscadorController.php';
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/reclutadorController.php';

//var_dump($_SESSION);
//prueba de branching

$page = $_GET['page'] ?? 'home';


// ========== POST ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['option'])) {
        if ($_POST['option'] === 'login') {
            ob_clean();
            header('Content-Type: application/json');
            $auth = new UserController();
            $auth->login();
            exit;
        }
        if ($_POST['option'] === 'logout') {
            $auth = new UserController();
            $auth->logout();
            exit;
        }
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
        $postulaciones = new UserController();
        $postulaciones->showDashboardUsuario();        
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





