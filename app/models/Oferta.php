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
		Lista todas las ofertas.
		*/
		$sql = "SELECT * FROM ofertas ORDER BY RAND()";
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

	public function create(
		$idEmpleador,
		$idCategoria,
		$idUbicacion,
		$titulo,
		$descripcion,
		$requisitos,
		$salario,
		$tipoEmpleo,
		$estado
	) {
		/*
		Crea una oferta nueva con todos sus datos base.
		*/
		$query = "INSERT INTO ofertas
		(idEmpleador, idCategoria, idUbicacion, titulo, descripcion, requisitos, salario, tipoEmpleo, estado)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
		$stmt->bind_param(
			"iiisssdss",
			$idEmpleador,
			$idCategoria,
			$idUbicacion,
			$titulo,
			$descripcion,
			$requisitos,
			$salario,
			$tipoEmpleo,
			$estado
		);

		return $stmt->execute();
	}

	public function update(
		$idOferta,
		$idCategoria,
		$idUbicacion,
		$titulo,
		$descripcion,
		$requisitos,
		$salario,
		$tipoEmpleo,
		$estado
	) {
		/*
		Actualiza los datos editables de una oferta existente.
		*/
		$query = "UPDATE ofertas
		SET 
			idCategoria = ?,
			idUbicacion = ?,
			titulo = ?,
			descripcion = ?,
			requisitos = ?,
			salario = ?,
			tipoEmpleo = ?,
			estado = ?
		WHERE idOferta = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bind_param(
			"iisssdssi",
			$idCategoria,
			$idUbicacion,
			$titulo,
			$descripcion,
			$requisitos,
			$salario,
			$tipoEmpleo,
			$estado,
			$idOferta
		);

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

public function searchByKeyword($keyword, $provincia = '', $categoria = '')
{
    $textoBusqueda = "%" . $keyword . "%";
    
    $query = "SELECT o.*, u.provincia, u.canton, e.nombreEmpresa, c.nombre AS categoria
              FROM ofertas o 
              INNER JOIN empleadores e ON o.idEmpleador = e.idEmpleador 
              INNER JOIN ubicaciones u ON o.idUbicacion = u.idUbicacion
              INNER JOIN categorias c ON o.idCategoria = c.idCategoria
              WHERE (o.titulo LIKE ? OR o.descripcion LIKE ? OR e.nombreEmpresa LIKE ?)";

    if ($provincia !== '') {
        $query .= " AND u.provincia = ?";
    }

    if ($categoria !== '') {
        $query .= " AND c.nombre = ?";
    }

    $query .= " ORDER BY o.idOferta DESC";

    $stmt = $this->conn->prepare($query);

    $params = [$textoBusqueda, $textoBusqueda, $textoBusqueda];
    $types = "sss";

    if ($provincia !== '') {
        $types .= "s";
        $params[] = $provincia;
    }

    if ($categoria !== '') {
        $types .= "s";
        $params[] = $categoria;
    }

    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
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

	public function createSimple($idEmpleador, $titulo, $descripcion, $salario)
	{
		$idCategoria = 1;
		$idUbicacion = 1;
		$tipoEmpleo = 'Tiempo completo';
		$estado = 'activa';

		$query = "INSERT INTO ofertas 
        (idEmpleador, idCategoria, idUbicacion, titulo, descripcion, salario, tipoEmpleo, estado) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
		$stmt->bind_param(
			"iiisssdss",
			$idEmpleador,
			$idCategoria,
			$idUbicacion,
			$titulo,
			$descripcion,
			$salario,
			$tipoEmpleo,
			$estado
		);

		return $stmt->execute();
	}

	public function getBySearch($keyword)
	{
		$busqueda = "%" . $keyword . "%";
		$stmt = $this->conn->prepare("
        SELECT 
            o.idOferta,
            o.titulo,
            o.salario,
            o.tipoEmpleo,
            o.estado,
            e.nombre AS nombreEmpleador,
            e.nombreEmpresa,
            u.provincia,
            u.canton
        FROM ofertas o
        INNER JOIN empleadores e ON o.idEmpleador = e.idEmpleador
        INNER JOIN ubicaciones u ON o.idUbicacion = u.idUbicacion
        WHERE o.titulo LIKE ?
           OR e.nombre LIKE ?
           OR e.nombreEmpresa LIKE ?
        ORDER BY o.fechaPublicacion DESC
    ");
		$stmt->bind_param("sss", $busqueda, $busqueda, $busqueda);
		$stmt->execute();
		return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	}

	public function getOfertaConEmpresa($idOferta)
	{
		$query = "SELECT o.*, e.nombreEmpresa
				FROM ofertas o
				INNER JOIN empleadores e ON o.idEmpleador = e.idEmpleador
				WHERE o.idOferta = ?
				LIMIT 1";

		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $idOferta);
		$stmt->execute();

		return $stmt->get_result()->fetch_assoc();
	}
}
