<?php
class mRanking {
    private $tabla = 'puntuacion';
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

    public function mMostrarContinentes() {
        $SQL = "SELECT * FROM continente";
        return $this->conexion->query($SQL);
    }
    public function mMostrarPuntuacion($idContinente){
        $SQL = "SELECT * FROM puntuacion WHERE idContinente='$idContinente' ORDER BY puntos DESC";
        return $this->conexion->query($SQL);
    }
    public function mBorrarPuntuacion(){
        $this->conectar();
        $idContinente=$_POST['idContinente'];
        $SQL = "DELETE FROM puntuacion WHERE idContinente='$idContinente'";
        return $this->conexion->query($SQL);
    }
    public function mListadoRanking(){
        $this->conectar();
        $idContinente=$_GET['idContinente'];
        $sql = 'SELECT * FROM '.$this->tabla.' WHERE idContinente= '.$idContinente.' ORDER BY puntos DESC';
        $resultado = $this->conexion->query($sql); 
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>