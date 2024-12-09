<?php
class Mpais {
    private $conexion;

    public function __construct() {
        require_once 'configDb.php';
        $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
        $this->conexion->set_charset("utf8");

        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public function mAltaPais($nombrePais, $bandera, $coordX, $coordY) {
        $SQL = "INSERT INTO paises (nombrePais, bandera, coordX, coordY) 
                VALUES ('$nombrePais', '$bandera', '$coordX', '$coordY')";
        
        return $this->conexion->query($SQL);
    }

    public function mObtenerPaises() {
        $SQL = "SELECT * FROM paises";
        return $this->conexion->query($SQL);
    }

    public function mObtenerPaisPorNombre($nombrePais) {
        $SQL = "SELECT * FROM paises WHERE nombrePais LIKE '%$nombrePais%'";
        return $this->conexion->query($SQL);
    }

    public function mModificarPais($nombrePais, $nuevoNombrePais, $bandera, $coordX, $coordY) {
        $SQL = "UPDATE paises 
                SET nombrePais = '$nuevoNombrePais', bandera = '$bandera', coordX = '$coordX', coordY = '$coordY' 
                WHERE nombrePais = '$nombrePais'";
    
        return $this->conexion->query($SQL);
    }
    

    public function mBorrarPais($nombrePais) {
        $SQL = "DELETE FROM paises WHERE nombrePais = '$nombrePais'";

        return $this->conexion->query($SQL);
    }
}
?>
