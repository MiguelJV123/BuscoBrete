<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Oferta.php';
require_once __DIR__ . '/../models/Ubicacion.php';

class UserController
{
    private $userModel;
    private $ofertaModel;
    private $ubicacionModel;

    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();

        $this->userModel = new Usuario($db);
        $this->ofertaModel = new Oferta($db);
        $this->ubicacionModel = new Ubicacion($db);

    }

    public function showHome()
    {
        $ofertas = $this->ofertaModel->getAll();
        $ubicaciones = $this->ubicacionModel->getAll();
        require 'app/views/home.php';
    }

    public function showLogin()
    {
        require 'app/views/login.php';
    }

    public function showRegistro()
    {
        require 'app/views/registro.php';
    }

    public function showDashboardUsuario()
    {
        require 'app/views/dashboardUsuario.php';
    }

    public function login()
    {

        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $usuario = $this->userModel->login($correo);

        if ($usuario && password_verify($password, $usuario['passwordEnc'])) {
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['correo'] = $usuario['correo'];
            $_SESSION['rol'] = $usuario['rol'];

            echo json_encode(['response' => "00", 'rol' => $usuario['rol'], 'message' => "Login exitoso"]);
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
}