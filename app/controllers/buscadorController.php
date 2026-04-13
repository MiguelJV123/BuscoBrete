<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Ubicacion.php';
require_once __DIR__ . '/../models/Oferta.php';
require_once __DIR__ . '/../models/Empleador.php';
require_once __DIR__ . '/../models/Categoria.php';

class buscadorController
{
    private $ubicacionModel;
    private $ofertaModel;
    private $empleadorModel;
    private $categoriaModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->ofertaModel = new Oferta($db);
        $this->ubicacionModel = new Ubicacion($db);
        $this->empleadorModel = new Empleador($db);
        $this->categoriaModel = new Categoria($db);
    }

    public function index()
    {
        
    }
        public function getOfertas()
    {
        return $this->ofertaModel->getAll()->fetch_all(MYSQLI_ASSOC);
    }

    public function getUbicaciones()
    {
        return $this->ubicacionModel->getAll()->fetch_all(MYSQLI_ASSOC);
    }

    public function getProvincias()
    {
        return $this->ubicacionModel->getDistinctProvincias()->fetch_all(MYSQLI_ASSOC);
    }

    public function getEmpleadores()
    {
        return $this->empleadorModel->getAll()->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategorias()
    {
        return $this->categoriaModel->getAll()->fetch_all(MYSQLI_ASSOC);
    }

        public function getDistinctCategoria()
    {
        return $this->categoriaModel->getDistinctCategoria()->fetch_all(MYSQLI_ASSOC);
    }
}
