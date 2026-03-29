<?php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Test.php';

class TestController
{

    private $model;

    

    public function __construct()
    {

        $database = new Database();
        $db = $database->connect();

        $this->model = new Test($db);
        $this->sayHi();
    }

    public function index()
    {
        echo "Controller funcionando con DB";
        $nombres = $this->model->getAll();

        require_once __DIR__ . '/../views/sandbox.php';
    }

    public function showTest()
    {
        require '../views/sandbox.php';
    }
    
public function sayHi()
    {
        echo "<h1 style='color:white'>Hola mundo</h1>";
    }
    
}
