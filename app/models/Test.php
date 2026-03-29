<?php

class Test 
{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){
        $sql = "SELECT * FROM testingTable";
        $result = $this->conn->query($sql);

        return $result;
    }
}