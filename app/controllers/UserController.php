<?php

require_once __DIR__ . '/../models/Postulacion.php';
require_once __DIR__ . '/../../config/database.php';

class UserController {

    public function dashboard() {

        $database = new Database();
        $db = $database->connect();

        $postulacionModel = new Postulacion($db);

        // temporal (cuando haya login real cambia)
        $idCandidato = 1;

        $postulaciones = $postulacionModel->getByCandidatoFull($idCandidato);

        require __DIR__ . '/../views/dashboardUsuario.php';
    }
}