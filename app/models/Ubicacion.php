<?php

class Ubicacion
{
	private $conn;
	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function getAll()
	{
		/*
		Lista todas las ubicaciones.
		*/
		$sql = "SELECT * FROM ubicaciones";
		$result = $this->conn->query($sql);

		return $result;
	}

	public function getDistinctProvincias()
	{
		/*
		Lista todas las provincias
		*/
		$sql = "SELECT DISTINCT provincia FROM ubicaciones";
		$result = $this->conn->query($sql);

		return $result;
	}
}
