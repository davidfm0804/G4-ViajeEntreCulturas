<?php

class mContinente {
    private $tabla = 'continente';
    private $conexion;

    public function __construct() {
        require_once CONFIG.'configDbProd.php';
        $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
        $this->conexion->set_charset("utf8");

        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
        // Activar modo de excepciones
        $this->conexion->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
    }

    public function conectar(){
        $objetoBD = new bbdd(); //Conectamos a la base de datos. Creamos objeto $objetoBD
        $this->conexion = $objetoBD->conexion; //Llamamos al metodo que realiza la conexion a la BBDD
    }

    public function mListadoContinentes(){
        $this->tabla = 'continente';
        $this->conectar();
        $sql = 'SELECT * FROM '.$this->tabla;
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function mMostrarContinentes() {
        $SQL = "SELECT * FROM continente";
        return $this->conexion->query($SQL);
    }

    public function mInsertarContinente() {
        $nombreCont = $_POST['nombreContinente'];

        try {
            $SQL = "INSERT INTO ".$this->tabla." (nombreCont) VALUES ('".$nombreCont."')";
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

    public function mBorrarContinente($idContinente) {
            $this->conectar();
            $idContinente = (int)$idContinente;
            $sql = "DELETE FROM ".$this->tabla." WHERE idContinente = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bind_param("i", $idContinente);
            if ($consulta->execute()) {
                return true;
            } else {
                return false;
            }
            $consulta->close();
        }

    public function mModificarContinente($nombreC, $idCont) {
        try {
            $SQL = "UPDATE continente SET nombreCont = '$nombreC' WHERE idContinente = ?";
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
