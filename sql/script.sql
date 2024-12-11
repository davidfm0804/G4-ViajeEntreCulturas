CREATE DATABASE viajeentreculturas_prueba;
USE viajeentreculturas_prueba;

/*-- Tabla Continente --*/
CREATE TABLE IF NOT EXISTS continente(
	idContinente SMALLINT AUTO_INCREMENT,
	nombreCont VARCHAR(100) NOT NULL, -- Europa
	CONSTRAINT pk_continente PRIMARY KEY (idContinente),
	CONSTRAINT uq_nombCont UNIQUE (nombreCont)
);

/*-- Tabla Pais --*/
CREATE TABLE IF NOT EXISTS pais(
	idPais INT AUTO_INCREMENT,
	nombrePais VARCHAR(100) NOT NULL, -- España
	bandera VARCHAR(255) NOT NULL, -- ./img/banderas/spain.jpg
	coordX FLOAT(11,9) NOT NULL, -- 40.463667
	coordY FLOAT(11,9) NOT NULL, -- 3.74922
	idContinente SMALLINT NOT NULL,
	CONSTRAINT pk_pais PRIMARY KEY (idPais),
    CONSTRAINT uq_nombrePais UNIQUE (nombrePais),
    CONSTRAINT uq_bandera UNIQUE (bandera),
	CONSTRAINT fk_paisContinente FOREIGN KEY (idContinente) REFERENCES continente(idContinente) ON DELETE CASCADE ON UPDATE CASCADE
);

/*-- Tabla Categoria --*/
CREATE TABLE IF NOT EXISTS categoria(
	idCategoria SMALLINT AUTO_INCREMENT,
	nombreCat VARCHAR(100) NOT NULL, -- Gastronomía
	CONSTRAINT pk_categoria PRIMARY KEY (idCategoria),
	CONSTRAINT uq_nombCat UNIQUE (nombreCat)
);

/*-- Tabla Item --*/
CREATE TABLE IF NOT EXISTS item(
	idItem INT AUTO_INCREMENT,
	descripcion VARCHAR(500) NOT NULL, -- Una de las comidas más típicas de España es la paella...
	imagen VARCHAR(255) NOT NULL, -- ./img/items/paella.jpg
	idPais INT NOT NULL,
	idCategoria SMALLINT NOT NULL,
	CONSTRAINT pk_item PRIMARY KEY (idItem),
	CONSTRAINT fk_itemPais FOREIGN KEY (idPais) REFERENCES pais(idPais) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_itemCategoria FOREIGN KEY (idCategoria) REFERENCES categoria(idCategoria) ON DELETE CASCADE ON UPDATE CASCADE
);

/*-- Tabla Puntuacion --*/
CREATE TABLE IF NOT EXISTS puntuacion(
	idPuntuacion INT AUTO_INCREMENT,
	nombre VARCHAR(100) NOT NULL, -- Loli
	puntos INT NOT NULL CHECK (puntos >= 0), -- 100
	numFallos INT NOT NULL CHECK (numFallos >= 0), -- 1
	tiempo TIME NOT NULL,	-- 00:01:30
    idContinente SMALLINT NOT NULL,
	CONSTRAINT pk_puntuacion PRIMARY KEY (idPuntuacion),
    CONSTRAINT fk_puntuacionContinente FOREIGN KEY (idContinente) REFERENCES continente(idContinente) ON DELETE CASCADE ON UPDATE CASCADE
);

/*-- Tabla Valoracion --*/
CREATE TABLE IF NOT EXISTS valoracion(
	idValoracion INT AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
	descripVal VARCHAR(500) NOT NULL,	
	CONSTRAINT pk_valoracion PRIMARY KEY (idValoracion)
);