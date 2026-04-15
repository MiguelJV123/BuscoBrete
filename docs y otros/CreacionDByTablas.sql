-- SCRIPT DE LIMPIEZA, CREACION DE DB Y TABLAS

CREATE DATABASE IF NOT EXISTS appdb;

USE appdb;


-- ========================= TABLA USUARIOS =========================

CREATE TABLE usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR(150) UNIQUE NOT NULL,
    passwordEnc VARCHAR(255) NOT NULL,
    rol ENUM('candidato','empleador','admin') NOT NULL,
    estado ENUM('activo','inactivo','bloqueado') DEFAULT 'activo',
    fechaRegistro DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- ========================= TABLA CANDIDATOS =========================

CREATE TABLE candidatos (
    id_candidato INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    fechaRegistro DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
) ENGINE=InnoDB;


-- ========================= TABLA EMPLEADORES =========================

CREATE TABLE empleadores (
    idEmpleador INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    nombreEmpresa VARCHAR(150) NOT NULL,
    descripcionEmpresa TEXT,
    telefono VARCHAR(20),
    fechaRegistro DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
) ENGINE=InnoDB;


-- ========================= TABLA ADMINISTRADORES =========================

CREATE TABLE administradores (
    idAdmin INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    fechaRegistro DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
) ENGINE=InnoDB;


-- ========================= TABLA UBICACIONES =========================

CREATE TABLE ubicaciones (
    idUbicacion INT AUTO_INCREMENT PRIMARY KEY,
    provincia VARCHAR(100) NOT NULL,
    canton VARCHAR(100) NOT NULL
) ENGINE=InnoDB;


-- ========================= TABLA CATEGORIAS =========================

CREATE TABLE categorias (
    idCategoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
) ENGINE=InnoDB;



-- ========================= TABLA OFERTAS =========================

CREATE TABLE ofertas (
    idOferta INT AUTO_INCREMENT PRIMARY KEY,
    idEmpleador INT NOT NULL,
    idCategoria INT NOT NULL,
    idUbicacion INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    requisitos TEXT,
    salario DECIMAL(10,2),
    tipoEmpleo ENUM('tiempo completo','medio tiempo','temporal','remoto'),
    estado ENUM('activa','cerrada','pausada') DEFAULT 'activa',
    fechaPublicacion DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (idEmpleador) REFERENCES empleadores(idEmpleador),
    FOREIGN KEY (idCategoria) REFERENCES categorias(idCategoria),
    FOREIGN KEY (idUbicacion) REFERENCES ubicaciones(idUbicacion)
) ENGINE=InnoDB;


-- ========================= TABLA POSTULACIONES =========================

CREATE TABLE postulaciones (
    idPostulacion INT AUTO_INCREMENT PRIMARY KEY,
    idCandidato INT NOT NULL,
    idOferta INT NOT NULL,
    estado ENUM('pendiente','aceptada','rechazada') DEFAULT 'pendiente',
    fechaPostulacion DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (idCandidato) REFERENCES candidatos(id_candidato),
    FOREIGN KEY (idOferta) REFERENCES ofertas(idOferta)
	
) ENGINE=InnoDB;


-- ========================= POBLACION INICIAL =========================

-- Password hash para clave de prueba: 12345
INSERT INTO usuarios (correo, passwordEnc, rol, estado) VALUES
('admin@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'admin', 'activo'),
('barberia.barrio@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('cafeteria.esquina@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('ferreteria.valle@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('bar.local@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('panaderia.donpaco@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('minisuper.familiar@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('soda.tica@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('libreria.central@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('taller.mecanico@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('vivero.verde@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('pulperia.norte@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('zapateria.paso@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('fruteria.sol@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('lavacar.ruta@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('heladeria.bahia@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'empleador', 'activo'),
('candidato01@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato02@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato03@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato04@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato05@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato06@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato07@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato08@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato09@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato10@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato11@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato12@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato13@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato14@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato15@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato16@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato17@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato18@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato19@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato20@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato21@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato22@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato23@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato24@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato25@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato26@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato27@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato28@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato29@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo'),
('candidato30@buscobrete.com', '$2y$10$0wkl2VjqQFNw2X5e.f3Lj.fliI7Etwk8r7bNW.OkqtGi31E8M6nRC', 'candidato', 'activo');

INSERT INTO administradores (idUsuario, nombre)
SELECT idUsuario, 'Administrador General'
FROM usuarios
WHERE correo = 'admin@buscobrete.com';

INSERT INTO empleadores (idUsuario, nombre, nombreEmpresa, descripcionEmpresa, telefono)
SELECT u.idUsuario, e.nombre, e.nombreEmpresa, e.descripcionEmpresa, e.telefono
FROM usuarios u
JOIN (
    SELECT 'barberia.barrio@buscobrete.com' AS correo, 'Jorge Solis' AS nombre, 'Barberia del Barrio' AS nombreEmpresa, 'Barberia de comunidad con enfoque en atencion personalizada.' AS descripcionEmpresa, '8888-3001' AS telefono
    UNION ALL SELECT 'cafeteria.esquina@buscobrete.com', 'Paola Ramirez', 'Cafeteria La Esquina', 'Cafeteria local de barrio con productos artesanales.', '8888-3002'
    UNION ALL SELECT 'ferreteria.valle@buscobrete.com', 'Andres Mena', 'Ferreteria El Valle', 'Ferreteria pequena para construccion y hogar.', '8888-3003'
    UNION ALL SELECT 'bar.local@buscobrete.com', 'Diana Quesada', 'Bar Los Compas', 'Bar local con ambiente familiar y musica en vivo.', '8888-3004'
    UNION ALL SELECT 'panaderia.donpaco@buscobrete.com', 'Ramon Perez', 'Panaderia Don Paco', 'Panaderia artesanal con venta al detalle.', '8888-3005'
    UNION ALL SELECT 'minisuper.familiar@buscobrete.com', 'Sofia Campos', 'MiniSuper Familiar', 'Negocio local de abarrotes y articulos basicos.', '8888-3006'
    UNION ALL SELECT 'soda.tica@buscobrete.com', 'Kevin Mora', 'Soda Tica', 'Soda tradicional costarricense de comida casera.', '8888-3007'
    UNION ALL SELECT 'libreria.central@buscobrete.com', 'Laura Nunez', 'Libreria Central', 'Libreria local enfocada en textos escolares y oficina.', '8888-3008'
    UNION ALL SELECT 'taller.mecanico@buscobrete.com', 'Diego Arce', 'Taller Mecanico El Motor', 'Taller de mecanica rapida para vehiculos livianos.', '8888-3009'
    UNION ALL SELECT 'vivero.verde@buscobrete.com', 'Monica Urena', 'Vivero Verde Vida', 'Vivero de plantas ornamentales y servicio de jardineria.', '8888-3010'
    UNION ALL SELECT 'pulperia.norte@buscobrete.com', 'Carlos Salazar', 'Pulperia El Norte', 'Pulperia con productos de consumo diario.', '8888-3011'
    UNION ALL SELECT 'zapateria.paso@buscobrete.com', 'Irene Chaves', 'Zapateria El Paso', 'Zapateria local para calzado casual y escolar.', '8888-3012'
    UNION ALL SELECT 'fruteria.sol@buscobrete.com', 'Mario Cordero', 'Fruteria El Sol', 'Fruteria con productos frescos de productores locales.', '8888-3013'
    UNION ALL SELECT 'lavacar.ruta@buscobrete.com', 'Natalia Brenes', 'LavaCar Ruta 27', 'Lavado y detallado de vehiculos.', '8888-3014'
    UNION ALL SELECT 'heladeria.bahia@buscobrete.com', 'Pablo Vega', 'Heladeria Bahia', 'Heladeria artesanal con produccion local.', '8888-3015'
) e ON e.correo = u.correo;

INSERT INTO candidatos (idUsuario, nombre, apellidos, telefono)
SELECT u.idUsuario, c.nombre, c.apellidos, c.telefono
FROM usuarios u
JOIN (
    SELECT 'candidato01@buscobrete.com' AS correo, 'Ana' AS nombre, 'Soto' AS apellidos, '8888-2001' AS telefono
    UNION ALL SELECT 'candidato02@buscobrete.com', 'Luis', 'Araya', '8888-2002'
    UNION ALL SELECT 'candidato03@buscobrete.com', 'Maria', 'Lopez', '8888-2003'
    UNION ALL SELECT 'candidato04@buscobrete.com', 'Jose', 'Rojas', '8888-2004'
    UNION ALL SELECT 'candidato05@buscobrete.com', 'Daniela', 'Mora', '8888-2005'
    UNION ALL SELECT 'candidato06@buscobrete.com', 'Steven', 'Quesada', '8888-2006'
    UNION ALL SELECT 'candidato07@buscobrete.com', 'Valeria', 'Campos', '8888-2007'
    UNION ALL SELECT 'candidato08@buscobrete.com', 'Bryan', 'Chacon', '8888-2008'
    UNION ALL SELECT 'candidato09@buscobrete.com', 'Paula', 'Vargas', '8888-2009'
    UNION ALL SELECT 'candidato10@buscobrete.com', 'Javier', 'Nunez', '8888-2010'
    UNION ALL SELECT 'candidato11@buscobrete.com', 'Melissa', 'Arce', '8888-2011'
    UNION ALL SELECT 'candidato12@buscobrete.com', 'Andres', 'Brenes', '8888-2012'
    UNION ALL SELECT 'candidato13@buscobrete.com', 'Sofia', 'Cordero', '8888-2013'
    UNION ALL SELECT 'candidato14@buscobrete.com', 'Kevin', 'Salas', '8888-2014'
    UNION ALL SELECT 'candidato15@buscobrete.com', 'Lucia', 'Pineda', '8888-2015'
    UNION ALL SELECT 'candidato16@buscobrete.com', 'Mauricio', 'Ugalde', '8888-2016'
    UNION ALL SELECT 'candidato17@buscobrete.com', 'Natalia', 'Herrera', '8888-2017'
    UNION ALL SELECT 'candidato18@buscobrete.com', 'Alejandro', 'Mendez', '8888-2018'
    UNION ALL SELECT 'candidato19@buscobrete.com', 'Gabriela', 'Solis', '8888-2019'
    UNION ALL SELECT 'candidato20@buscobrete.com', 'Fernando', 'Jimenez', '8888-2020'
    UNION ALL SELECT 'candidato21@buscobrete.com', 'Camila', 'Vega', '8888-2021'
    UNION ALL SELECT 'candidato22@buscobrete.com', 'Esteban', 'Calderon', '8888-2022'
    UNION ALL SELECT 'candidato23@buscobrete.com', 'Monica', 'Alfaro', '8888-2023'
    UNION ALL SELECT 'candidato24@buscobrete.com', 'Pablo', 'Leiva', '8888-2024'
    UNION ALL SELECT 'candidato25@buscobrete.com', 'Diana', 'Aguilar', '8888-2025'
    UNION ALL SELECT 'candidato26@buscobrete.com', 'Oscar', 'Arias', '8888-2026'
    UNION ALL SELECT 'candidato27@buscobrete.com', 'Noelia', 'Rojas', '8888-2027'
    UNION ALL SELECT 'candidato28@buscobrete.com', 'Ricardo', 'Cruz', '8888-2028'
    UNION ALL SELECT 'candidato29@buscobrete.com', 'Tatiana', 'Mora', '8888-2029'
    UNION ALL SELECT 'candidato30@buscobrete.com', 'Adrian', 'Roman', '8888-2030'
) c ON c.correo = u.correo;

INSERT INTO categorias (nombre) VALUES
('Tecnologia'),
('Ventas'),
('Atencion al cliente'),
('Administracion'),
('Construccion'),
('Alimentos y Bebidas'),
('Belleza y Cuidado Personal'),
('Mecanica y Mantenimiento');

INSERT INTO ubicaciones (provincia, canton) VALUES
('San Jose', 'Central'),
('San Jose', 'Desamparados'),
('Alajuela', 'Central'),
('Alajuela', 'San Ramon'),
('Cartago', 'Central'),
('Cartago', 'Turrialba'),
('Heredia', 'Central'),
('Heredia', 'Belen'),
('Guanacaste', 'Liberia'),
('Guanacaste', 'Nicoya'),
('Puntarenas', 'Central'),
('Puntarenas', 'Esparza'),
('Limon', 'Central'),
('Limon', 'Pococi');

INSERT INTO ofertas (idEmpleador, idCategoria, idUbicacion, titulo, descripcion, requisitos, salario, tipoEmpleo, estado)
SELECT emp.idEmpleador, cat.idCategoria, ubi.idUbicacion,
       o.titulo, o.descripcion, o.requisitos, o.salario, o.tipoEmpleo, o.estado
FROM (
    SELECT 'Barberia del Barrio' AS nombreEmpresa, 'Belleza y Cuidado Personal' AS categoria, 'San Jose' AS provincia, 'Central' AS canton, 'Barbero Integral' AS titulo, 'Atencion de clientes para corte, barba y acabado.' AS descripcion, 'Experiencia minima de 1 ano en barberia.' AS requisitos, 480000.00 AS salario, 'tiempo completo' AS tipoEmpleo, 'activa' AS estado
    UNION ALL SELECT 'Cafeteria La Esquina', 'Alimentos y Bebidas', 'San Jose', 'Desamparados', 'Barista', 'Preparacion de bebidas calientes y frias, y atencion en barra.', 'Conocimiento basico en preparacion de cafe.', 430000.00, 'tiempo completo', 'activa'
    UNION ALL SELECT 'Ferreteria El Valle', 'Construccion', 'Alajuela', 'Central', 'Dependiente de Ferreteria', 'Apoyo en mostrador, inventario y despacho de materiales.', 'Conocimiento en productos de ferreteria.', 510000.00, 'tiempo completo', 'activa'
    UNION ALL SELECT 'Bar Los Compas', 'Atencion al cliente', 'Alajuela', 'San Ramon', 'Salonero para Bar', 'Servicio al cliente y apoyo en caja durante turnos nocturnos.', 'Disponibilidad de horarios nocturnos.', 420000.00, 'medio tiempo', 'activa'
    UNION ALL SELECT 'Panaderia Don Paco', 'Alimentos y Bebidas', 'Cartago', 'Central', 'Panadero', 'Elaboracion diaria de pan y control de hornos.', 'Experiencia en produccion artesanal.', 500000.00, 'tiempo completo', 'activa'
    UNION ALL SELECT 'MiniSuper Familiar', 'Ventas', 'Cartago', 'Turrialba', 'Cajero de MiniSuper', 'Cobro de productos y apoyo en acomodo de gondolas.', 'Manejo de caja y servicio al cliente.', 410000.00, 'tiempo completo', 'activa'
    UNION ALL SELECT 'Soda Tica', 'Alimentos y Bebidas', 'Heredia', 'Central', 'Cocinero de Soda', 'Preparacion de platos caseros y control de cocina.', 'Experiencia en cocina tradicional.', 520000.00, 'tiempo completo', 'activa'
    UNION ALL SELECT 'Libreria Central', 'Atencion al cliente', 'Heredia', 'Belen', 'Asistente de Libreria', 'Atencion en mostrador y control de inventario de libros.', 'Orden y buena comunicacion.', 430000.00, 'tiempo completo', 'activa'
    UNION ALL SELECT 'Taller Mecanico El Motor', 'Mecanica y Mantenimiento', 'Guanacaste', 'Liberia', 'Mecanico Automotriz', 'Mantenimiento preventivo y correctivo de vehiculos.', 'Tecnico medio en mecanica o experiencia comprobada.', 620000.00, 'tiempo completo', 'activa'
    UNION ALL SELECT 'Vivero Verde Vida', 'Atencion al cliente', 'Guanacaste', 'Nicoya', 'Ayudante de Vivero', 'Apoyo en cuidado de plantas, riego y acomodo de mercaderia.', 'Gusto por jardineria y trabajo fisico.', 400000.00, 'tiempo completo', 'activa'
    UNION ALL SELECT 'Pulperia El Norte', 'Ventas', 'Puntarenas', 'Central', 'Dependiente de Pulperia', 'Atencion al cliente y reposicion de productos.', 'Experiencia en comercio local.', 400000.00, 'tiempo completo', 'activa'
    UNION ALL SELECT 'Zapateria El Paso', 'Ventas', 'Puntarenas', 'Esparza', 'Vendedor de Zapateria', 'Atencion al publico y recomendacion de calzado.', 'Habilidad para ventas y trato cordial.', 430000.00, 'medio tiempo', 'activa'
    UNION ALL SELECT 'Fruteria El Sol', 'Atencion al cliente', 'Limon', 'Central', 'Encargado de Fruteria', 'Acomodo y rotacion de fruta fresca, atencion de clientes.', 'Conocimiento basico de inventario perecedero.', 420000.00, 'tiempo completo', 'activa'
    UNION ALL SELECT 'LavaCar Ruta 27', 'Mecanica y Mantenimiento', 'Limon', 'Pococi', 'Operario de LavaCar', 'Lavado, secado y detallado basico de vehiculos.', 'Deseable licencia B1 y experiencia previa.', 450000.00, 'tiempo completo', 'activa'
    UNION ALL SELECT 'Heladeria Bahia', 'Alimentos y Bebidas', 'San Jose', 'Central', 'Dependiente de Heladeria', 'Servicio en mostrador y preparacion de pedidos.', 'Buena actitud de servicio y trabajo en equipo.', 410000.00, 'medio tiempo', 'activa'
) o
JOIN empleadores emp ON emp.nombreEmpresa = o.nombreEmpresa
JOIN categorias cat ON cat.nombre = o.categoria
JOIN ubicaciones ubi ON ubi.provincia = o.provincia AND ubi.canton = o.canton;

INSERT INTO postulaciones (idCandidato, idOferta, estado)
SELECT
    c.id_candidato,
    ((c.id_candidato - 1) % 15) + 1 AS idOferta,
    CASE
        WHEN c.id_candidato % 5 = 0 THEN 'aceptada'
        WHEN c.id_candidato % 7 = 0 THEN 'rechazada'
        ELSE 'pendiente'
    END AS estado
FROM candidatos c
ORDER BY c.id_candidato;