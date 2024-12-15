<?php
class Mranking {
    private $conexion;

    public function __construct() {
        $objetoBD = new bbdd(); //Conectamos a la base de datos. Creamos objeto $objetoBD
        $this->conexion = $objetoBD->conexion; //Llamamos al metodo que realiza la conexion a la BBDD
    }

    public function mMostrarContinentes() {
        $SQL = "SELECT * FROM continente";
        return $this->conexion->query($SQL);
    }
    public function mMostrarPuntuacion($idContinente){
        $SQL = "SELECT * FROM puntuacion WHERE idContinente='$idContinente' ORDER BY puntos DESC";
        return $this->conexion->query($SQL);
    }
    public function mBorrarPuntuacion($idContinente){
        $SQL = "DELETE FROM puntuacion WHERE idContinente='$idContinente'";
        return $this->conexion->query($SQL);
    }
}
?>