<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Oferta.php';
require_once __DIR__ . '/../models/Empleador.php';
require_once __DIR__ . '/../models/Postulacion.php';
require_once __DIR__ . '/../models/Candidato.php';

class reclutadorController
{
    private $empleadorModel;
    private $postulacionModel;
    private $ofertaModel;

    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();

        $this->empleadorModel = new Empleador($db);
        $this->postulacionModel = new Postulacion($db);
        $this->ofertaModel = new Oferta($db);
    }

    public function showDashboardReclutador()
    {
        // Verificar que el usuario es un empleador
        if (!isset($_SESSION['idUsuario']) || $_SESSION['rol'] !== 'empleador') {
            header('Location: ' . BASE_URL . '/?page=login');
            exit;
        }

        $empleador = $this->empleadorModel->getByUsuario($_SESSION['idUsuario']);
        $idEmpleador = $empleador['idEmpleador'] ?? 0;

        $postulacionesXEmpleador = $this->postulacionModel->getPostulacionesByEmpleador($idEmpleador);
        $ofertasXEmpleador = $this->empleadorModel->getOfertasByEmpleador($idEmpleador);

        require 'app/views/dashboardReclutador.php';
    }

    public function showPublicarOferta()
    {
        // Verificar que el usuario es un empleador
        if (!isset($_SESSION['idUsuario']) || $_SESSION['rol'] !== 'empleador') {
            header('Location: ' . BASE_URL . '/?page=login');
            exit;
        }

        require 'app/views/publicarOferta.php';
    }

    public function publicarOferta()
    {
        if (!isset($_SESSION['idUsuario']) || $_SESSION['rol'] !== 'empleador') {
            echo json_encode(['response' => '01', 'message' => 'No autorizado']);
            return;
        }

        $titulo      = trim($_POST['titulo']      ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $requisitos  = trim($_POST['requisitos']  ?? '');

        if (!$titulo || !$descripcion) {
            echo json_encode(['response' => '01', 'message' => 'Título y descripción son obligatorios']);
            return;
        }

        // Obtener idEmpleador desde la sesión
        $empleador = $this->empleadorModel->getByUsuario($_SESSION['idUsuario']);
        if (!$empleador) {
            echo json_encode(['response' => '01', 'message' => 'No se encontró tu perfil de empleador']);
            return;
        }
        $idEmpleador = $empleador['idEmpleador'];

        $resultado = $this->ofertaModel->createSimple($idEmpleador, $titulo, $descripcion, 0, $requisitos);

        if ($resultado) {
            echo json_encode(['response' => '00', 'message' => 'Oferta publicada correctamente']);
        } else {
            echo json_encode(['response' => '01', 'message' => 'Error al publicar la oferta']);
        }
    }
}
