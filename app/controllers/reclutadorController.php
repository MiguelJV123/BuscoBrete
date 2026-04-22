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
    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();

        $this->empleadorModel = new Empleador($db);
        $this->postulacionModel = new Postulacion($db);
    }

    public function showDashboardReclutador()
    {
        $postulacionesXEmpleador = $this->postulacionModel->getPostulacionesByEmpleador($_SESSION['idUsuario']);
        $ofertasXEmpleador = $this->empleadorModel->getOfertasByEmpleador($_SESSION['idUsuario']);
        require 'app/views/dashboardReclutador.php';
    }

    // Para mostrar sin post !IMPORTANTE!
    public function showPublicarOferta()
    {
        require 'app/views/publicarOferta.php';
    }

    public function publicarOferta()
    {
        // Verificar que sea empleador
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'empleador') {
            echo json_encode(['response' => '01', 'message' => 'No autorizado']);
            return;
        }

        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $requisitos = trim($_POST['requisitos'] ?? '');

        // Si no tiene titulo o descrip cion, no se puede publicar
        // Validar campos obligatorios (asegurarse de que el frontend envie titulo y descripcion)
        if (!$titulo || !$descripcion) {
            echo json_encode(['response' => '01', 'message' => 'Faltan campos obligatorios']);
            return;
        }

        // TODO: obtener idEmpleador desde la sesión

        // TODO: insertar en BD

        // Por ahora devuelve 00 sin tocar la BD
        echo json_encode(['response' => '00', 'message' => 'Oferta recibida correctamente']);
    }
}
