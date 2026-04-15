<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Oferta.php';
require_once __DIR__ . '/../models/Ubicacion.php';
require_once __DIR__ . '/../models/Postulacion.php';
require_once __DIR__ . '/../models/Candidato.php';

class UserController
{
    private $userModel;
    private $ofertaModel;
    private $ubicacionModel;
    private $postulacionModel;
    private $candidatoModel;

    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();

        $this->userModel = new Usuario($db);
        $this->ofertaModel = new Oferta($db);
        $this->ubicacionModel = new Ubicacion($db);
        $this->postulacionModel = new Postulacion($db);
        $this->candidatoModel = new Candidato($db);
    }

    public function showHome()
    {
        $ofertas = $this->ofertaModel->getAll();
        $ubicaciones = $this->ubicacionModel->getAll();
        require 'app/views/home.php';
    }

    public function showDashboardUsuario()
    {

        // Verifica que el usuario esté loggeado
        if (!isset($_SESSION['idUsuario'])) {
            header('Location: ' . BASE_URL . '/?page=login'); // If not, redirige login
            exit;
        }

        $candidato = $this->candidatoModel->getByUsuario($_SESSION['idUsuario']);
        $idCandidato = $candidato['id_candidato'] ?? 0;

        $postulaciones = $this->postulacionModel->getByCandidatoFull($idCandidato);

        require 'app/views/dashboardUsuario.php';
    }

    public function showLogin()
    {
        require 'app/views/login.php';
    }

    public function showRegistro()
    {
        require 'app/views/registro.php';
    }

    public function login()
    {

        $correo = $_POST['correo'] ?? '';
        $password = $_POST['password'] ?? '';

        $usuario = $this->userModel->findByCorreo($correo);

        if ($usuario && password_verify($password, $usuario['passwordEnc'])) {
            session_regenerate_id(true);
            $_SESSION['usuario'] = $usuario['correo'];
            $_SESSION['rol'] = $usuario['rol'];
            $_SESSION['idUsuario'] = $usuario['idUsuario'];
        //Creo que aquí va candidatoMopdel para obtener el id del candidato y guardarlo en seson

            echo json_encode(['response' => '00', 'rol' => $_SESSION['rol']]);
        } else {
            echo json_encode(['response' => "01", 'message' => "Error de autentificacion"]);            
        }

    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/?page=home');
        exit;
    }

    public function aplicarOferta() {



    }

}