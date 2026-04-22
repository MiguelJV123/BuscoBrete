<?php
require_once __DIR__ . '/../models/Test.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Candidato.php';
require_once __DIR__ . '/../models/Empleador.php';
require_once __DIR__ . '/../models/Oferta.php';
require_once __DIR__ . '/../models/Postulacion.php';
require_once __DIR__ . '/../models/Ubicacion.php';

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
    private $testModel;
    private $userModel;
    private $candidatoModel;
    private $empleadorModel;
    private $ofertaModel;
    private $postulacionModel;
    private $ubicacionModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->testModel = new Test($db); //TESTEO

        $this->userModel = new Usuario($db);
        $this->ubicacionModel = new Ubicacion($db);
        $this->candidatoModel = new Candidato($db);
        $this->empleadorModel = new Empleador($db);
        $this->ofertaModel = new Oferta($db);
        $this->postulacionModel = new Postulacion($db);
    }

    public function index()
    {
        $nombres = $this->testModel->getAll();
        $ofertas = $this->ofertaModel->getAll();

        $model = strtolower($_GET['model'] ?? '');

        if ($model === '') {
            require_once __DIR__ . '/../views/home.php';
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

    public function getOfertas()
    {
        return $this->ofertaModel->getAll()->fetch_all(MYSQLI_ASSOC);
    }

    public function getUbicaciones()
    {
        return $this->ubicacionModel->getAll()->fetch_all(MYSQLI_ASSOC);
    }
}
