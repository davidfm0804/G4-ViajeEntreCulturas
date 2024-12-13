<?php

class MJuego {

    private $tabla = 'puntuacion';
    private $conexion;

    public function conectar(){
        $objetoBD = new bbdd();
        $this->conexion = $objetoBD->conexion;
    }

    // Insert Puntuacion
    public function insertPuntuacion($nombre, $puntos, $numFallos, $tiempo, $idContinente) {
        $this->conectar();

        $sql = 'INSERT INTO '.$this->tabla.' (nombre, puntos, numFallos, tiempo, idContinente) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param('siiii', $nombre, $puntos, $numFallos, $tiempo, $idContinente);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function selectPuntuaciones() {
        $this->conectar();

        $sql = 'SELECT idPuntuacion, nombre, puntos, numFallos, tiempo  FROM '.$this->tabla.' WHERE idContinente = ? ORDER BY puntuacion, tiempo, numFallos ASC';
        $this->conexion->prepare($sql);
        $this->conexion->bind_param('i', $_GET['idContinente']);
        $resultado = $this->conexion->execute();

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function selectBanderas(){
        $this->conectar();

        $sql = 'SELECT idBandera, nombreBandera, imagen FROM bandera WHERE idContinente = ?';
        $this->conexion->prepare($sql);
        $this->conexion->bind_param('i', $_GET['idContinente']);
        $resultado = $this->conexion->execute();

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    
}
?>