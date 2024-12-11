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
        $nombreCont = $_GET['nombreCont'];
        $sql = 'SELECT * FROM categoria';
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function mAltaPais() {
        $this->conectar();
        $idContinente = $_GET['idContinente'];
        $nombreCont = $_GET['nombreCont'];
        $nombrePais = $_POST['pais'];
        $coordX = $_POST['coordX'];
        $coordY = $_POST['coordY'];
        $categoria = $_POST['categoria'];
        $descripcion = $_POST['descripcion'];

        $imgBandera = $_FILES['imgBandera']['name']; //Ejemplo: india.png
        $imgBanderaTmp = $_FILES['imgBandera']['tmp_name'];
        $imgBanderaPath = BANDERAS.basename($imgBandera);
        if (!move_uploaded_file($imgBanderaTmp, $imgBanderaPath)) {echo "Error al subir la bandera.";}

        $imgItem = $_FILES['imgItem']['name']; //Ejemplo: india.png
        $imgItemTmp = $_FILES['imgItem']['tmp_name'];
        $imgItemPath = FOTOS.basename($imgItem);
        if (!move_uploaded_file($imgItemTmp, $imgItemPath)) {echo "Error al subir la foto.";}

        $this->conexion->begin_transaction();

        try {
            // INSERT PAIS
            $stmt = $this->conexion->prepare("INSERT INTO ".$this->tabla." (nombrePais, bandera, coordX, coordY, idContinente) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssddi", $nombrePais, $imgBandera, $coordX, $coordY, $idContinente);
            if (!$stmt->execute()) {
                throw new Exception("Error al insertar el país: " . $stmt->error);
            }

            // Obtener el idPais del país recién insertado
            $stmt = $this->conexion->prepare("SELECT idPais FROM ".$this->tabla." WHERE nombrePais = ?");
            $stmt->bind_param("s", $nombrePais);
            $stmt->execute();
            $stmt->bind_result($idPais);
            $stmt->fetch();
        
            // Verificamos si se obtuvo el idPais correctamente
            if (!$idPais) {
                throw new Exception("No se pudo obtener el idPais del país recién insertado.");
            }

            $idPais = (int)$idPais;
            $categoria = (int)$categoria;

            // Inserción en la tabla item usando el idPais
            $stmt = $this->conexion->prepare("INSERT INTO item (descripcion, imagen, idPais, idCategoria) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssii", $descripcion, $imgItem, $idPais, $categoria);
            
            // Verifica si la preparación fue exitosa
            if ($stmt === false) {
                throw new Exception("Error al preparar la consulta SQL: " . $this->conexion->error);
            }

            if (!$stmt->execute()) {
                throw new Exception("Error al insertar el item: " . $stmt->error);
            }

            // Si todo fue exitoso, hacer commit de la transacción
            $this->conexion->commit();
            return true;
        } catch (Exception $e) {
            // Si ocurre algún error, hacer rollback
            $this->conexion->rollback();
            echo "Se produjo un error: " . $e->getMessage();
            return false;
        }
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
