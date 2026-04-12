<?php

/*
Aqui vive la logica basica de postulaciones.
*/
class Postulacion
{
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function getAll()
	{
		/*
		Devuelve todas las postulaciones ordenadas de nuevas a viejas.
		*/
		$sql = "SELECT * FROM postulaciones ORDER BY idPostulacion DESC";
		return $this->conn->query($sql);
	}

	public function getById($idPostulacion)
	{
		/*
		Busca una postulacion puntual por su id.
		*/
		$query = "SELECT * FROM postulaciones WHERE idPostulacion = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idPostulacion);
		$stmt->execute();

		return $stmt->get_result()->fetch_assoc();
	}

	public function getByCandidato($idCandidato)
	{
		/*
		Lista todo lo que ha postulado un candidato.
		*/
		$query = "SELECT * FROM postulaciones WHERE idCandidato = ? ORDER BY idPostulacion DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idCandidato);
		$stmt->execute();

		return $stmt->get_result();
	}

	public function getByOferta($idOferta)
	{
		/*
		Trae los candidatos que aplicaron a una oferta.
		*/
		$query = "SELECT * FROM postulaciones WHERE idOferta = ? ORDER BY idPostulacion DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idOferta);
		$stmt->execute();

		return $stmt->get_result();
	}

	public function create($idCandidato, $idOferta, $estado = 'pendiente')
	{
		/*
		Registra una postulacion nueva con estado por defecto pendiente.
		*/
		$query = "INSERT INTO postulaciones (idCandidato, idOferta, estado) VALUES (?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("iis", $idCandidato, $idOferta, $estado);

		return $stmt->execute();
	}

	public function updateEstado($idPostulacion, $estado)
	{
		/*
		Solo cambia el estado de la postulacion (pendiente, aceptada o rechazada).
		*/
		$query = "UPDATE postulaciones SET estado = ? WHERE idPostulacion = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("si", $estado, $idPostulacion);

		return $stmt->execute();
	}

	public function delete($idPostulacion)
	{
		/*
		Elimina la postulacion cuando ya no se necesita.
		*/
		$query = "DELETE FROM postulaciones WHERE idPostulacion = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idPostulacion);

		return $stmt->execute();
	}
}
