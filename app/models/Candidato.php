<?php

/*
Este modelo maneja todo lo basico del perfil de candidatos.
*/
class Candidato
{
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function getAll()
	{
		/*
		listar todos los candidatos
		*/
		$sql = "SELECT * FROM candidatos ORDER BY id_candidato DESC";
		return $this->conn->query($sql);
	}

	public function getById($idCandidato)
	{
		/*
		Busca un candidato puntual por su id.
		*/
		$query = "SELECT * FROM candidatos WHERE id_candidato = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idCandidato);
		$stmt->execute();

		return $stmt->get_result()->fetch_assoc();
	}

	public function getByUsuario($idUsuario)
	{
		/*
		para buscar candidato por Id de usuario
		*/
		$query = "SELECT * FROM candidatos WHERE idUsuario = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idUsuario);
		$stmt->execute();

		return $stmt->get_result()->fetch_assoc();
	}

	public function create($idUsuario, $nombre, $apellidos, $telefono)
	{
		/*
		Guarda un candidato amarrado a un usuario existente.
		*/
		$query = "INSERT INTO candidatos (idUsuario, nombre, apellidos, telefono) VALUES (?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("isss", $idUsuario, $nombre, $apellidos, $telefono);

		return $stmt->execute();
	}

	public function update($idCandidato, $nombre, $apellidos, $telefono)
	{
		/*
		Actualiza los datos principales del candidato.
		*/
		$query = "UPDATE candidatos SET nombre = ?, apellidos = ?, telefono = ? WHERE id_candidato = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("sssi", $nombre, $apellidos, $telefono, $idCandidato);

		return $stmt->execute();
	}

	public function delete($idCandidato)
	{
		/*
		Borra el candidato por id. Ojo que esto no borra el usuario, solo el perfil de candidato.
         */
		$query = "DELETE FROM candidatos WHERE id_candidato = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idCandidato);

		return $stmt->execute();
	}
}
