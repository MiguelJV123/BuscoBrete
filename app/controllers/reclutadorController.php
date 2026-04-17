<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Oferta.php';
require_once __DIR__ . '/../models/Empleador.php';
require_once __DIR__ . '/../models/Postulacion.php';
require_once __DIR__ . '/../models/Candidato.php';

class reclutadorController
{
    private $userModel;
    private $ofertaModel;
    private $empleadorModel;    
    private $postulacionModel;
    private $candidatoModel;
    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();

        $this->userModel = new Usuario($db);
        $this->ofertaModel = new Oferta($db);
        $this->empleadorModel = new Empleador($db);
        $this->postulacionModel = new Postulacion($db);
        $this->candidatoModel = new Candidato($db);

    }

    public function showDashboardReclutador()
    {
        $postulacionesXEmpleador = $this->postulacionModel->getPostulacionesByEmpleador($_SESSION['idUsuario']);
        $ofertasXEmpleador = $this->empleadorModel->getOfertasByEmpleador($_SESSION['idUsuario']);
        require 'app/views/dashboardReclutador.php';
        
    }

    public function showPublicarOferta()
    {
        require 'app/views/publicarOferta.php';
    }

    public function publicarOferta() {


    
    }
}