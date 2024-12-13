<?php
class mItem {
    private $tabla = 'item';
    private $conexion;

    public function __construct() {
        require_once CONFIG.'configDbLocal.php';
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

    public function mListadoPaises(){
        $this->conectar();
        $idContinente = $_GET['id'];
        $this->tabla = 'pais';
        $sql = 'SELECT idPais, nombrePais, bandera FROM '.$this->tabla.' WHERE idContinente = '.$idContinente;
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function mFormModItems(){
        $this->conectar();
        $id = $_GET['idPais'];
        $sql = "SELECT nombrePais, bandera, coordX, coordY FROM ".$this->tabla." WHERE idPais = ".$id;
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function mUpdateItem(){
        $this->conectar();
        $pais = $_POST['pais'];
        $coordX = $_POST['coordX'];
        $coordY = $_POST['coordY'];
        $idPais = $_POST['idPais'];
        $archivo = isset($_POST['imgBandera']) ? $_POST['imgBandera'] : '';

        // Comprobar | IMG = FILE ? SRC
        //Si hemos subido archivo nuevo, creo un update donde modifico el nombre del archivo en el campo bandera
        if(isset($_FILES['imgBandera']) && is_uploaded_file($_FILES['imgBandera']['tmp_name'])){
            $imgBandera = $_FILES['imgBandera']['name']; //Nombre del archivo
            $imgBanderaTmp = $_FILES['imgBandera']['tmp_name'];
            $rutaBandera = BANDERAS.basename($imgBandera);
            // Mover IMG a Directorio
            if (!move_uploaded_file($imgBanderaTmp, $rutaBandera)){die("Error al subir la imagen");}
            $archivo = $imgBandera;
        }

        $sql = "UPDATE ".$this->tabla." SET nombrePais = ?, coordX = ?, coordY = ?, bandera = ? WHERE idPais = ?";
        $conxPrp = $this->conexion->prepare($sql);
        $conxPrp->bind_param("sddss", $pais, $coordX, $coordY, $archivo, $idPais);
        $result = $conxPrp->execute();
        return $result;
    }
}
?>
