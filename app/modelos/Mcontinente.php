<?php
class Mcontinente {
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

    public function mInsertarContinente($nombreContinente) {
        try {
            $SQL = "INSERT INTO continente (nombreCont) VALUES ('$nombreContinente')";
            $this->conexion->query($SQL);
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) { 
                return "Csu";
            } else {
                return false;
            }
        }
        return true;
    }

    public function mBorrarContinente($idCont) {
        $SQL = "DELETE FROM continente WHERE idContinente='$idCont'";
        return $this->conexion->query($SQL);
    }

    public function mModificarContinente($nombreC, $idCont) {
        try {
            $SQL = "UPDATE continente SET nombreCont = '$nombreC' WHERE idContinente = '$idCont'";
            $this->conexion->query($SQL);
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) { 
                return "Csu";
            } else {
                return false;
            }
        }
        return true; 
    }
}
?>
