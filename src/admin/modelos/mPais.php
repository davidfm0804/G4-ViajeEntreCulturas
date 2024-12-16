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
        $this->conexion->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
    }

    public function conectar(){
        $objetoBD = new bbdd();
        $this->conexion = $objetoBD->conexion; 
    }

    public function mListadoPaises(){
        $this->conectar();
        $idContinente = $_GET['id'];
        if(!isset($idContinente)||empty($idContinente)){
            //Si no tenemos idContinente no podemos mostrar paises. Devolvemos false y salimos de la consulta
            return false; //
            exit;
        }
        $sql = 'SELECT idPais, nombrePais, bandera FROM '.$this->tabla.' WHERE idContinente = '.$idContinente;
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function mFormAltaPais(){
        $this->conectar();
        $idContinente = $_GET['id'];
        if(!isset($idContinente)||empty($idContinente)){
            return false; //
            exit;
        }
        $nombreCont = $_GET['nombreCont'];
        if(!isset($nombreCont)||empty($nombreCont)){
            return false; 
            exit;
        }
        $sql = 'SELECT * FROM categoria';
        $resultado = $this->conexion->query($sql); 
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function mAltaPais() {
        $this->conectar();
        $idContinente = $_GET['idContinente'];
        $nombreCont = $_GET['nombreCont'];
        $nombrePais = $_POST['pais'];
        $coordX = $_POST['coordX'];
        $coordY = $_POST['coordY'];

        $idCategoria1 = $_POST['categoria1']; $descripcion1 = $_POST['descripcion1']; 
        $idCategoria2 = $_POST['categoria2']; $descripcion2 = $_POST['descripcion2'];
        $idCategoria3 = $_POST['categoria3']; $descripcion3 = $_POST['descripcion3'];
        $idCategoria4 = $_POST['categoria4']; $descripcion4 = $_POST['descripcion4'];

        $imgBandera = $_FILES['imgBandera']['name']; 
        $imgBanderaTmp = $_FILES['imgBandera']['tmp_name'];
        $imgBanderaPath = BANDERAS.basename($imgBandera);
        
        $imgItem1 = $_FILES['imgItem1']['name']; 
        $imgItemTmp1 = $_FILES['imgItem1']['tmp_name'];
        $imgItemPath1 = FOTOS.basename($imgItem1);

        $imgItem2 = $_FILES['imgItem2']['name']; 
        $imgItemTmp2 = $_FILES['imgItem2']['tmp_name'];
        $imgItemPath2 = FOTOS.basename($imgItem2);
        
        $imgItem3 = $_FILES['imgItem3']['name']; 
        $imgItemTmp3 = $_FILES['imgItem3']['tmp_name'];
        $imgItemPath3 = FOTOS.basename($imgItem3);
        
        $imgItem4 = $_FILES['imgItem4']['name'];
        $imgItemTmp4 = $_FILES['imgItem4']['tmp_name'];
        $imgItemPath4 = FOTOS.basename($imgItem4);
        
        $this->conexion->begin_transaction();

        try {
            // INSERT PAIS
            $consulta = $this->conexion->prepare("INSERT INTO ".$this->tabla." (nombrePais, bandera, coordX, coordY, idContinente) VALUES (?, ?, ?, ?, ?)");
            $consulta->bind_param("ssddi", $nombrePais, $imgBandera, $coordX, $coordY, $idContinente);
            if (!$consulta->execute()) {
                throw new Exception("Error al insertar el país: " . $consulta->error);
            }

            // Obtener el idPais del país recién insertado
            $consulta = $this->conexion->prepare("SELECT idPais FROM ".$this->tabla." WHERE nombrePais = ?");
            $consulta->bind_param("s", $nombrePais);
            $consulta->execute();
            $consulta->bind_result($idPais);
            $consulta->fetch();
            $consulta->close();
            // Verificamos si se obtuvo el idPais correctamente
            if (!$idPais) {
                throw new Exception("No se pudo obtener el idPais del país recién insertado.");
            }

            $idPais = (int)$idPais;
            $idCategoria1 = (int)$idCategoria1;
            $idCategoria2 = (int)$idCategoria2;
            $idCategoria3 = (int)$idCategoria3;
            $idCategoria4 = (int)$idCategoria4;

            // Inserción en la tabla item usando el idPais
            $consulta = $this->conexion->prepare("INSERT INTO item (descripcion, imagen, idPais, idCategoria) VALUES (?, ?, ?, ?), (?, ?, ?, ?), (?, ?, ?, ?), (?, ?, ?, ?)");
            $consulta->bind_param("ssiissiissiissii", $descripcion1, $imgItem1, $idPais, $idCategoria1, $descripcion2, $imgItem2, $idPais, $idCategoria2, $descripcion3, $imgItem3, $idPais, $idCategoria3, $descripcion4, $imgItem4, $idPais, $idCategoria4);
            if ($consulta === false) {
                throw new Exception("Error al preparar la consulta SQL: " . $this->conexion->error);
            }
            if (!$consulta->execute()) {
                throw new Exception("Error al insertar el item: " . $consulta->error);
            }
            // Si todo fue exitoso, hacer commit de la transacción
            $this->conexion->commit();

            if (!move_uploaded_file($imgBanderaTmp, $imgBanderaPath)) {echo "Error al subir la bandera.";}
            if (!move_uploaded_file($imgItemTmp1, $imgItemPath1)) {echo "Error al subir la foto.";}
            if (!move_uploaded_file($imgItemTmp2, $imgItemPath2)) {echo "Error al subir la foto.";}
            if (!move_uploaded_file($imgItemTmp3, $imgItemPath3)) {echo "Error al subir la foto.";}
            if (!move_uploaded_file($imgItemTmp4, $imgItemPath4)) {echo "Error al subir la foto.";}

            return "Registro dado de alta correctamente";
            exit;

        } catch (Exception $e) {
            // Si ocurre algún error, hacer rollback
            $this->conexion->rollback();
            return "Error al dar de alta: " . $e->getMessage();
            exit;
        }   

        $this->conexion->close();
    }

    public function mNombrePaisRepetido($nombre){
        $this->conectar();
        $consulta = $this->conexion->prepare("SELECT * FROM pais WHERE nombrePais = ?"); // Preparar la consulta
        $consulta->bind_param("s", $nombre);
        $consulta->execute();
        $consulta->store_result();
        if ($consulta) {
            // Comprobar el número de filas
            if ($consulta->num_rows > 0) {
                return false; 
            } else {
                return true;
            }
            $consulta->close();
        } else {
            die("Error en la preparación de la consulta: " . $this->conexion->error);
        }
    }

    public function mMostrarChinchetas(){
        $this->conectar();
        $idContinente = $_GET["idContinente"];
        
        $sql = "SELECT coordX, coordY FROM pais WHERE idContinente = ?";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param("i", $idContinente);
        $consulta->execute();
        $resultado = $consulta->get_result();

        $coordenadas = [];
        while($fila = $resultado->fetch_assoc()){
            $coordenadas[] = $fila;
        }
        $consulta->close();
        return $coordenadas;
    }

    public function mFormModPais(){
        $this->conectar();
        $id = $_GET['idPais'];
        $sql = "SELECT nombrePais, bandera, coordX, coordY FROM ".$this->tabla." WHERE idPais = ".$id;
        $resultado = $this->conexion->query($sql); 
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function mUpdatePais(){
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

            if (!move_uploaded_file($imgBanderaTmp, $rutaBandera)){die("Error al subir la imagen");}
            $archivo = $imgBandera;
        }

        $sql = "UPDATE ".$this->tabla." SET nombrePais = ?, coordX = ?, coordY = ?, bandera = ? WHERE idPais = ?";
        $conxPrp = $this->conexion->prepare($sql);
        $conxPrp->bind_param("sddss", $pais, $coordX, $coordY, $archivo, $idPais);
        $result = $conxPrp->execute();
        return $result;
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
    
    public function mBorrarPais() {
        $this->conectar();
        $id = $_POST['id'];
        $sql = "DELETE FROM ".$this->tabla." WHERE idPais = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }
}
?>
