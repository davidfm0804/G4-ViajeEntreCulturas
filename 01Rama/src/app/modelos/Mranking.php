<?php
class Mranking {
    private $conexion;

    public function __construct() {
        require_once 'configdb.php';
        $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
        $this->conexion->set_charset("utf8");

        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
        // Activar modo de excepciones
        $this->conexion->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
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