<?php
class mPais {
    private $tabla = 'pais';
    private $conexion;

    public function __construct() {
        require_once CONFIG.'configDbLocal.php';
        $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
        $this->conexion->set_charset("utf8");

        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public function conectar(){
        $objetoBD = new bbdd(); //Conectamos a la base de datos. Creamos objeto $objetoBD
        $this->conexion = $objetoBD->conexion; //Llamamos al metodo que realiza la conexion a la BBDD
    }

    public function mListadoPaises(){
        $this->conectar();
        $idContinente = $_GET['id'];
        $sql = 'SELECT idPais, nombrePais, bandera FROM '.$this->tabla.' WHERE idContinente = '.$idContinente;
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function mFormAltaPais(){
        $this->conectar();
        $idContinente = $_GET['id'];
        $nombreCont = $GET['nombreCont'];
        $sql = 'SELECT * FROM categoria';
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC);
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
