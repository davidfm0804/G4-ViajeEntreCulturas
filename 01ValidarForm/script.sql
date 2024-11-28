
CREATE DATABASE ViajeEntreCulturas;

USE ViajeEntreCulturas;

CREATE TABLE pais (
	idPais int AUTO_INCREMENT PRIMARY KEY,
	nombrePais CHAR(10) NULL,
	coordX FLOAT(11,9) NOT NULL,
	coordY FLOAT(11,9) NOT NULL
);