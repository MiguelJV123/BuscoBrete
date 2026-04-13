<?php

class Categoria
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        /*
        Lista todas las categorias.
        */
        $sql = "SELECT * FROM categorias";
        $result = $this->conn->query($sql);

        return $result;
    }

    public function getDistinctCategoria()
    {
        /*
        Lista todas las categorias distintas
        */
        $sql = "SELECT DISTINCT nombre FROM categorias";
        $result = $this->conn->query($sql);

        return $result;
    }
}