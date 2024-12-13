<?php

class MJuego {

    private $tabla = 'puntuacion';
    private $conexion;

    public function conectar(){
        $objetoBD = new bbdd();
        $this->conexion = $objetoBD->conexion;
    }

    // Insertar Puntuacion
    public function insertarPuntuacion($nombre, $puntos, $numFallos, $tiempo, $idContinente) {
        $this->conectar();

        $sql = 'INSERT INTO '.$this->tabla.' (nombre, puntos, numFallos, tiempo, idContinente) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param('siiii', $nombre, $puntos, $numFallos, $tiempo, $idContinente);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function seleccionarPuntuaciones() {
        $this->conectar();

        $sql = 'SELECT idPuntuacion, nombre, puntos, numFallos, tiempo  FROM '.$this->tabla.' WHERE idContinente = ? ORDER BY puntos DESC, tiempo ASC, numFallos ASC';
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $_GET['idContinente']);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function seleccionarBanderas(){
        $this->conectar();

        $sql = 'SELECT idBandera, nombreBandera, imagen FROM bandera WHERE idContinente = ?';
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $_GET['idContinente']);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    
}
?>