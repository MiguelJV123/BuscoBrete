<?php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Candidato.php';
require_once __DIR__ . '/../models/Empleador.php';
require_once __DIR__ . '/../models/Oferta.php';
require_once __DIR__ . '/../models/Postulacion.php';

/*
URLS PARA PROBAR LOS MODELOS:
http://localhost:8080/BuscoBrete/index.php?model=user
http://localhost:8080/BuscoBrete/index.php?model=candidato
http://localhost:8080/BuscoBrete/index.php?model=empleador
http://localhost:8080/BuscoBrete/index.php?model=oferta
http://localhost:8080/BuscoBrete/index.php?model=postulacion
*/ 

class TestController
{
    private $userModel;
    private $candidatoModel;
    private $empleadorModel;
    private $ofertaModel;
    private $postulacionModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->userModel = new Usuario($db);
        $this->candidatoModel = new Candidato($db);
        $this->empleadorModel = new Empleador($db);
        $this->ofertaModel = new Oferta($db);
        $this->postulacionModel = new Postulacion($db);
    }

    public function index()
    {
        $model = strtolower($_GET['model'] ?? '');

        if ($model === '') {
            require_once __DIR__ . '/../views/sandbox.php';
            return;
        }

        header('Content-Type: application/json; charset=utf-8');

        switch ($model) {
            case 'user':
                echo json_encode($this->userModel->getAll()->fetch_all(MYSQLI_ASSOC), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                break;

            case 'candidato':
                echo json_encode($this->candidatoModel->getAll()->fetch_all(MYSQLI_ASSOC), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                break;

            case 'empleador':
                echo json_encode($this->empleadorModel->getAll()->fetch_all(MYSQLI_ASSOC), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                break;

            case 'oferta':
                echo json_encode($this->ofertaModel->getAll()->fetch_all(MYSQLI_ASSOC), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                break;

            case 'postulacion':
                echo json_encode($this->postulacionModel->getAll()->fetch_all(MYSQLI_ASSOC), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                break;

            default:
                echo json_encode(['error' => 'Modelo no soportado'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                break;
        }
    }
}