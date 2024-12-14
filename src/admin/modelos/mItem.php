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
        $idPais = $_GET['idPais'];
        $sql = "SELECT item.idItem, item.descripcion, item.imagen, item.idCategoria, categoria.idCategoria, categoria.nombreCat 
            FROM item INNER JOIN categoria ON item.idCategoria = categoria.idCategoria
            WHERE item.idPais = ?
            ORDER BY item.idItem";
        $consulta = $this->conexion->prepare($sql); 
        $consulta->bind_param("i", $idPais);
        $consulta->execute();
        $resultado = $consulta->get_result();
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

    public function mCargarCategorias(){
        $this->conectar();
        $idCategoria = $_POST["idCategoria"];

        $sql= "SELECT idCategoria, nombreCat FROM categoria WHERE idCategoria != ?";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bind_param("i", $idCategoria);
        $consulta->execute();
        $resultado = $consulta->get_result();

        $categorias = [];

        while($fila = $resultado->fetch_assoc()) {
            $categorias[] = [
                'idCategoria' => $fila['idCategoria'],
                'nombreCategoria' => $fila['nombreCat']
            ];
        }

        $consulta->close();

        return $categorias;
    }

    public function mActualizarItems(){
        $this->conectar();
        $idPais;

        $idCategoriaItem1 = $_POST['categoriaItem1']; $descripcionItem1 = $_POST['descripcionItem1']; 
        $idCategoriaItem2 = $_POST['categoriaItem2']; $descripcionItem2 = $_POST['descripcionItem2'];
        $idCategoriaItem3 = $_POST['categoriaItem3']; $descripcionItem3 = $_POST['descripcionItem3'];
        $idCategoriaItem4 = $_POST['categoriaItem4']; $descripcionItem4 = $_POST['descripcionItem4'];

        $imgItem1 = $_FILES['imgItem1']['name']; //Ejemplo: india.png
        $imgItemTmp1 = $_FILES['imgItem1']['tmp_name'];
        $imgItemPath1 = FOTOS.basename($imgItem1);

        $imgItem2 = $_FILES['imgItem2']['name']; //Ejemplo: india.png
        $imgItemTmp2 = $_FILES['imgItem2']['tmp_name'];
        $imgItemPath2 = FOTOS.basename($imgItem2);
        
        $imgItem3 = $_FILES['imgItem3']['name']; //Ejemplo: india.png
        $imgItemTmp3 = $_FILES['imgItem3']['tmp_name'];
        $imgItemPath3 = FOTOS.basename($imgItem3);
        
        $imgItem4 = $_FILES['imgItem4']['name']; //Ejemplo: india.png
        $imgItemTmp4 = $_FILES['imgItem4']['tmp_name'];
        $imgItemPath4 = FOTOS.basename($imgItem4);

        $this->conexion->begin_transaction();

        try{
            $sqlBorrar = "DELETE FROM item WHERE idPais = ?";
            $consultaBorrar = $this->conexion->prepare($sqlBorrar);
            if (!$consultaBorrar) {
                throw new Exception("Error al preparar el DELETE: " . $this->conexion->error);
            }

            $consultaBorrar->bind_param("i", $idPais);
            if (!$consultaBorrar->execute()) {
                throw new Exception("Error al ejecutar el DELETE: " . $consultaBorrar->error);
            }

            $sqlAlta = "INSERT INTO item (descripcion, imagen, idPais, idCategoria) VALUES (?, ?, ?, ?), (?, ?, ?, ?), (?, ?, ?, ?), (?, ?, ?, ?)";
            $consulta = $this->conexion->prepare($sqlAlta);
            if (!$consulta) {
                throw new Exception("Error al preparar la consulta SQL: " . $this->conexion->error);
            }
            $consulta->bind_param("ssiissiissiissii", 
            $descripcion1, $imgItem1, $idPais, $idCategoria1, 
            $descripcion2, $imgItem2, $idPais, $idCategoria2, 
            $descripcion3, $imgItem3, $idPais, $idCategoria3, 
            $descripcion4, $imgItem4, $idPais, $idCategoria4);

            if (!$consulta->execute()) {
                throw new Exception("Error al insertar los items: " . $consulta->error);
            }
            // Si todo fue exitoso, hacer commit de la transacción
            $this->conexion->commit();

          // Mover las imágenes después de la transacción (solo si fue exitosa)
        if (!move_uploaded_file($imgItemTmp1, $imgItemPath1)) {throw new Exception("Error al mover la foto 1.");}
        if (!move_uploaded_file($imgItemTmp2, $imgItemPath2)) {throw new Exception("Error al mover la foto 2.");}
        if (!move_uploaded_file($imgItemTmp3, $imgItemPath3)) {throw new Exception("Error al mover la foto 3.");}
        if (!move_uploaded_file($imgItemTmp4, $imgItemPath4)) {throw new Exception("Error al mover la foto 4.");}

        // Confirmación de la modificación exitosa
        return true;

        } catch (Exception $e) {
            // Si ocurre algún error, hacer rollback
            $this->conexion->rollback();
            return false;
        }

        $this->conexion->close();
    }
}
?>
