<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();
/*Aquí viene a caer todo por default al entrar al sitio web
Con este require de linea 5 es que se asigna el controlador que lo va a arrancar
*/
require_once __DIR__ . '/app/controllers/TestController.php';
require_once __DIR__ . '/app/controllers/buscadorController.php';
$mainController = new TestController();
$buscadorController = new buscadorController();

if(!defined('BASE_URL')) {
    define('BASE_URL', '/proyectoGit/BuscoBrete');
}
/*Entonces se crea el objeto de la ruta que se le dio y con
$controller->index(); se accede al metodo y este por default 
abre la vista que le decimos en el index
*/
$_SESSION['usuario'] = 'invitado';
$_SESSION['rol'] = 'invitado';

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        $ofertas = $buscadorController->getOfertas();
        $ubicaciones = $buscadorController->getUbicaciones();
        require 'app/views/home.php';
        break;
    case 'buscarEmpleos':
        $ofertas = $buscadorController->getOfertas();
        $empleadores = $buscadorController->getEmpleadores();
        $ubicaciones = $buscadorController->getUbicaciones();
        $provincias = $buscadorController->getProvincias();
        $categorias = $buscadorController->getCategorias();
        $categoriasDistinct = $buscadorController->getDistinctCategoria();
        require 'app/views/buscarEmpleos.php';
        break;
    case 'login':
        require 'app/views/login.php';
        break;
    case 'registro':
        require 'app/views/registro.php';
        break;
    case 'dashboardReclutador':
        if ($_SESSION['rol'] != 'reclutador') {
            $_GET['page'] = 'home';
            require 'index.php';
        } else {
            require 'app/views/dashboardReclutador.php';
        }
        break;
    case 'dashboardUsuario':
        require 'app/views/dashboardUsuario.php';
        break;
    case 'publicarOferta':
        require 'app/views/publicarOferta.php';
        break;
    case 'ofertaInfo':
        require 'app/views/ofertaInfo.php';
        break;
}







