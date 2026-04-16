<?php

/*
Este modelo se encarga del CRUD de empleadores.
*/
class Empleador
{
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function getAll()
	{
		/*
		Saca todos los empleadores para mostrarlos en listado.
		*/
		$sql = "SELECT * FROM empleadores ORDER BY idEmpleador DESC";
		return $this->conn->query($sql);
	}

	public function getById($idEmpleador)
	{
		/*
		Recupera un empleador exacto por id.
		*/
		$query = "SELECT * FROM empleadores WHERE idEmpleador = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idEmpleador);
		$stmt->execute();

		return $stmt->get_result()->fetch_assoc();
	}

	public function getByUsuario($idUsuario)
	{
		/*
		Muy util para mapear usuario -> perfil de empleador.
		*/
		$query = "SELECT * FROM empleadores WHERE idUsuario = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idUsuario);
		$stmt->execute();

		return $stmt->get_result()->fetch_assoc();
	}

	public function create($idUsuario, $nombre, $nombreEmpresa, $descripcionEmpresa, $telefono)
	{
		/*
		Crea el perfil de empleador para el usuario indicado.
		*/
		$query = "INSERT INTO empleadores (idUsuario, nombre, nombreEmpresa, descripcionEmpresa, telefono) VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("issss", $idUsuario, $nombre, $nombreEmpresa, $descripcionEmpresa, $telefono);

		return $stmt->execute();
	}

	public function update($idEmpleador, $nombre, $nombreEmpresa, $descripcionEmpresa, $telefono)
	{
		/*
		Actualiza los datos que el empleador puede editar.
		*/
		$query = "UPDATE empleadores SET nombre = ?, nombreEmpresa = ?, descripcionEmpresa = ?, telefono = ? WHERE idEmpleador = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("ssssi", $nombre, $nombreEmpresa, $descripcionEmpresa, $telefono, $idEmpleador);

		return $stmt->execute();
	}

	public function delete($idEmpleador)
	{
		/*
		Elimina el registro del empleador por id.
		*/
		$query = "DELETE FROM empleadores WHERE idEmpleador = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idEmpleador);

		return $stmt->execute();
	}

	public function getOfertasByEmpleador($idEmpleador)
{
    $stmt = $this->conn->prepare("
        SELECT 
            o.idOferta,
            o.titulo,
            o.descripcion,
            o.requisitos,
            o.salario,
            o.tipoEmpleo,
            o.estado,
            o.fechaPublicacion,
            c.nombre AS categoria,
            u.provincia,
            u.canton
        FROM ofertas o
        INNER JOIN categorias c ON o.idCategoria = c.idCategoria
        INNER JOIN ubicaciones u ON o.idUbicacion = u.idUbicacion
        WHERE o.idEmpleador = ?
        ORDER BY o.fechaPublicacion DESC
    ");
    $stmt->bind_param("i", $idEmpleador);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
}
