<?php

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

	public function getPostulacionesByEmpleador($idEmpleador)
{
    $stmt = $this->conn->prepare("
        SELECT 
            p.idPostulacion,
            p.estado AS estadoPostulacion,
            p.fechaPostulacion,
            o.titulo AS oferta,
            o.salario,
            c.nombre AS nombreCandidato,
            c.apellidos AS apellidosCandidato,
            c.telefono,
            u.correo
        FROM postulaciones p
        INNER JOIN ofertas o ON p.idOferta = o.idOferta
        INNER JOIN candidatos c ON p.idCandidato = c.id_candidato
        INNER JOIN usuarios u ON c.idUsuario = u.idUsuario
        WHERE o.idEmpleador = ?
        ORDER BY p.fechaPostulacion DESC
    ");
    $stmt->bind_param("i", $idEmpleador);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
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

	public function getByCandidatoFull($idCandidato)
	{
		$query = "
			SELECT 
				p.idPostulacion,
				p.estado,
				p.fechaPostulacion,
				o.titulo,
				emp.nombreEmpresa AS nombreEmpresa,
				u.provincia AS provincia,
				u.canton AS canton
			FROM postulaciones p
			INNER JOIN ofertas o ON p.idOferta = o.idOferta
			INNER JOIN empleadores emp ON o.idEmpleador = emp.idEmpleador
			INNER JOIN ubicaciones u ON o.idUbicacion = u.idUbicacion
			WHERE p.idCandidato = ?
			ORDER BY p.fechaPostulacion DESC
		";

		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idCandidato);
		$stmt->execute();

		return $stmt->get_result();
	}


}
