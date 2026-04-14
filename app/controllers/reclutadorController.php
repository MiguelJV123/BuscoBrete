<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';

class reclutadorController
{
    private $userModel;

    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();

        $this->userModel = new Usuario($db);

    }

    public function showDashboardReclutador()
    {
        require 'app/views/dashboardReclutador.php';
    }

    public function showPublicarOferta()
    {
        require 'app/views/publicarOferta.php';
    }
}