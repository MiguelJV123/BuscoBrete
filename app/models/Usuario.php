<?php

/*
Modelo de usuarios para login y operaciones basicas del perfil.
*/
class Usuario
{
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function login($correo)
	{
		/*
		Busca un usuario por correo para proceso de autenticacion.
		*/
		$query = "SELECT * FROM usuarios WHERE correo = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("s", $correo);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function findByCorreo($correo)
	{
		return $this->login($correo);
	}

	public function getAll()
	{
		/*
		Saca todos los usuarios para revisar la lista completa.
		*/
		$sql = "SELECT * FROM usuarios ORDER BY idUsuario DESC";
		return $this->conn->query($sql);
	}

	public function findById($idUsuario)
	{
		/*
		Trae un usuario usando su id
		*/
		$query = "SELECT * FROM usuarios WHERE idUsuario = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idUsuario);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function create($correo, $passwordHash, $rol)
	{
		/*
		Crea un usuario nuevo en estado activo.
		*/
		$query = "INSERT INTO usuarios (correo, passwordEnc, rol, estado) VALUES (?, ?, ?, 'activo')";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("sss", $correo, $passwordHash, $rol);
		$stmt->execute();

		return $stmt->affected_rows > 0;
	}

	public function update($idUsuario, $correo, $passwordHash, $rol, $estado)
	{
		/*
		Actualiza los datos del usaurio
		*/
		$query = "UPDATE usuarios SET correo = ?, passwordEnc = ?, rol = ?, estado = ? WHERE idUsuario = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("ssssi", $correo, $passwordHash, $rol, $estado, $idUsuario);

		return $stmt->execute();
	}

	public function delete($idUsuario)
	{
		/*
		Borra el usuario por id.
		*/
		$query = "DELETE FROM usuarios WHERE idUsuario = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idUsuario);

		return $stmt->execute();
	}
}
