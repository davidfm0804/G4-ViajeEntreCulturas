<?php
class mCategoria {
    private $conexion;

    public function __construct() {
        require_once CONFIG.'configDbLocal.php';
        $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
        $this->conexion->set_charset("utf8");

        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public function mAltaCategoria($nombreCat) {
        $SQL = "INSERT INTO categoria (nombreCat) 
                VALUES ('$nombreCat')";
        
        return $this->conexion->query($SQL);
    }

}
?>
