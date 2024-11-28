-- Crear la base de datos
CREATE DATABASE viajeentreculturas;

USE viajeentreculturas;

-- Crear la tabla PAISES
CREATE TABLE paises (
    codPais INT AUTO_INCREMENT PRIMARY KEY,
    nombrePais VARCHAR(100) NOT NULL,
    bandera VARCHAR(255),
    coordX FLOAT(11,9),
    coordY FLOAT(11,9)
);

-- Crear la tabla ITEMS
CREATE TABLE ITEMS (
	idItem INT PRIMARY KEY,
	descripcion VARCHAR(255),
	imagen VARCHAR(255), -- URL o ruta de la imagen
	codPais INT NOT NULL,
	idCultura INT NOT NULL,
	FOREIGN KEY (codPais) REFERENCES PAISES(codPais)
);

-- Crear la tabla CULTURAS
CREATE TABLE CULTURAS (
	codPais INT NOT NULL,
	idCultura INT NOT NULL,
	idItem INT,
	PRIMARY KEY (codPais, idCultura),
	FOREIGN KEY (codPais) REFERENCES PAISES(codPais),
	FOREIGN KEY (idItem) REFERENCES ITEMS(idItem)
);

-- Crear la tabla PUNTUACIONES
CREATE TABLE PUNTUACIONES (
	idPuntuacion INT PRIMARY KEY,
	nombre VARCHAR(100) NOT NULL,
	puntos INT,
	numFallos INT,
	tiempo TIME
);