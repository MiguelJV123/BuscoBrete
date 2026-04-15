<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Oferta.php';
require_once __DIR__ . '/../models/Empleador.php';

class reclutadorController
{
    private $userModel;
    private $ofertaModel;
    private $empleadorModel;    

    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();

        $this->userModel = new Usuario($db);
        $this->ofertaModel = new Oferta($db);
        $this->empleadorModel = new Empleador($db);

    }

    public function showDashboardReclutador()
    {
        require 'app/views/dashboardReclutador.php';
    }

    public function showPublicarOferta()
    {
        require 'app/views/publicarOferta.php';
    }

    public function publicarOferta() {


    
    }
}