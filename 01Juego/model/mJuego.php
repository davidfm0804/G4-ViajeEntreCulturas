<?php

class MJuego {

    private $tabla = 'puntuacion';
    private $conexion;
    private $seleccionada;

    public function conectar(){
        $objetoBD = new bbdd();
        $this->conexion = $objetoBD->conexion;
    }

    public function seleccionarContinentes() {
        $this->conectar();

        $sql = 'SELECT idContinente, nombreCont FROM continente';
        $resultado = $this->conexion->query($sql);

        return $resultado->fetch_all(MYSQLI_ASSOC);
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

    public function seleccionarPuntuaciones($idContinente) {
        $this->conectar();

        $sql = 'SELECT idPuntuacion, nombre, puntos, numFallos, tiempo FROM '.$this->tabla.' WHERE idContinente = ? ORDER BY puntos DESC, tiempo ASC, numFallos ASC LIMIT 10;';
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $idContinente);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerInfoPartida($idContinente){
        $this->conectar();
        $infoPartida = array();
        // Obtener los paises del continente
        $paises = $this->obtenerPaises($idContinente);
        $paises = json_decode($paises, true);
        // Obtener un item random por pais y unir la información
        foreach ($paises as $pais) {
            $item = $this->obtenerItems($pais['idPais']);
            $item = json_decode($item, true);
            // Unir Info Pais - Item y usar idPais como índice
            $infoPartida[$pais['idPais']] = array_merge($pais, $item[0]);
        }
        return json_encode($infoPartida);
    }

    private function obtenerPaises($idContinente){
        $this->conectar();
    
        $sql = 'SELECT idPais, nombrePais, coordX, coordY, bandera FROM pais WHERE idContinente = ? ORDER BY RAND() LIMIT 8';
        $stmt = $this->conexion->prepare($sql);
    
        $stmt->bind_param('i', $idContinente);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $pais = array();
        if ($resultado->num_rows > 0) {
            while($fila = $resultado->fetch_assoc()) {
                $pais[] = $fila;
            }
        }
        $stmt->close();
        return json_encode($pais); // Convertir el array a JSON y retornarlo
    }

    private function obtenerItems($idPais){
        $this->conectar();
    
        $sql = 'SELECT descripcion, imagen FROM item WHERE idPais = ? ORDER BY RAND() LIMIT 1';
        $stmt = $this->conexion->prepare($sql);
    
        $stmt->bind_param('i', $idPais);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $infoPais = array();
        if ($resultado->num_rows > 0) {
            $infoPais[] = $resultado->fetch_assoc();
        }else{
            $infoPais[] = array('descripcion' => 'No hay información disponible');
        }

        $stmt->close();
        return json_encode($infoPais); // Convertir el array a JSON y retornarlo
    }

    public function obtenerSeleccionada() {
        return $this->seleccionada;
    }
    
}
?>