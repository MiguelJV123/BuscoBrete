<?php

/*
Modelo de ofertas laborales: consultas, filtros y CRUD principal.
*/
class Oferta
{
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function getAll()
	{
		/*
		Lista todas las ofertas de la mas reciente a la mas antigua.
		*/
		$sql = "SELECT * FROM ofertas ORDER BY idOferta DESC";
		$result = $this->conn->query($sql);

		return $result;
	}

	public function getById($id)
	{
		/*
		Obtiene una oferta especifica por su id.
		*/
		$query = "SELECT * FROM ofertas WHERE idOferta = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();

		return $result->fetch_assoc();
	}

	public function create($idEmpleador, $idCategoria, $idUbicacion, $titulo, $descripcion, $requisitos, $salario, $tipoEmpleo, $estado)
	{
		/*
		Crea una oferta nueva con todos sus datos base.
		*/
		$query = "INSERT INTO ofertas (idEmpleador, idCategoria, idUbicacion, titulo, descripcion, requisitos, salario, tipoEmpleo, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("iiisssdss", $idEmpleador, $idCategoria, $idUbicacion, $titulo, $descripcion, $requisitos, $salario, $tipoEmpleo, $estado);

		return $stmt->execute();
	}

	public function update($idOferta, $idCategoria, $idUbicacion, $titulo, $descripcion, $requisitos, $salario, $tipoEmpleo, $estado)
	{
		/*
		Actualiza los datos editables de una oferta existente.
		*/
		$query = "UPDATE ofertas SET idCategoria = ?, idUbicacion = ?, titulo = ?, descripcion = ?, requisitos = ?, salario = ?, tipoEmpleo = ?, estado = ? WHERE idOferta = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("iisssdssi", $idCategoria, $idUbicacion, $titulo, $descripcion, $requisitos, $salario, $tipoEmpleo, $estado, $idOferta);

		return $stmt->execute();
	}

	public function delete($id)
	{
		/*
		Elimina una oferta por id.
		*/
		$query = "DELETE FROM ofertas WHERE idOferta = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $id);

		return $stmt->execute();
	}

	public function searchByKeyword($texto)
	{
		/*
		Filtra ofertas por titulo o descripcion usando LIKE.
		*/
		$textoBusqueda = "%" . $texto . "%";
		$query = "SELECT * FROM ofertas WHERE titulo LIKE ? OR descripcion LIKE ? ORDER BY idOferta DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("ss", $textoBusqueda, $textoBusqueda);
		$stmt->execute();

		return $stmt->get_result();
	}

	public function searchByUbicacion($idUbicacion)
	{
		/*
		Filtra ofertas por la ubicacion seleccionada.
		*/
		$query = "SELECT * FROM ofertas WHERE idUbicacion = ? ORDER BY idOferta DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idUbicacion);
		$stmt->execute();

		return $stmt->get_result();
	}
}