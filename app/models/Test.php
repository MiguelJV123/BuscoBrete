<?php

class Test
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $sql = "SELECT id_candidato AS id, CONCAT(nombre, ' ', apellidos) AS nombre FROM candidatos ORDER BY id_candidato";
        $result = $this->conn->query($sql);

        return $result;
    }
}
