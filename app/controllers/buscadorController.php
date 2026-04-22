<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Ubicacion.php';
require_once __DIR__ . '/../models/Oferta.php';
require_once __DIR__ . '/../models/Empleador.php';
require_once __DIR__ . '/../models/Categoria.php';

// TODO: Falta integrar con BD

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

    public function showBuscador()
    {
        $ofertas = $this->ofertaModel->getAll()->fetch_all(MYSQLI_ASSOC);
        $ubicaciones = $this->ubicacionModel->getAll();
        $provincias = $this->ubicacionModel->getDistinctProvincias();
        $empleadores = $this->empleadorModel->getAll();
        $categorias = $this->categoriaModel->getAll();
        $categoriasDistinct = $this->categoriaModel->getDistinctCategoria();

        require 'app/views/buscarEmpleos.php';
    }

    public function verOferta()
    {
        $idOferta = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $oferta = null;

        if ($idOferta > 0) {
            // Busca la oferta por id en la BD
            $oferta = $this->ofertaModel->getById($idOferta);
            // TODO: cuando la BD esté integrada, cambiar getById() por
            // TODO: un método con JOIN que traiga también empresa y ubicación
        }

        // $oferta llega a la vista (null si no se escontro)
        require 'app/views/verOferta.php';
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

    public function getBySearch(){
        $keyword = $_POST['keyword'] ?? '';
    
        if($keyword != ''){
            return $this->ofertaModel->getBySearch($keyword);
        }

    }
}
