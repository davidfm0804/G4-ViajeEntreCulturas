<?php

class mPais {

    private $tabla = 'pais'; //Nombre de la tabla donde buscamos información
    private $conexion;

    public function __construct() {

    }

    public function conectar(){
        $objetoBD = new bbdd(); //Conectamos a la base de datos. Creamos objeto $objetoBD
        $this->conexion = $objetoBD->conexion; //Llamamos al metodo que realiza la conexion a la BBDD
    }

    public function selectPaises(){
        $this->conectar(); //Llamo al metodo conectar de arriba
        $sql = 'SELECT idPais, nombrePais, bandera FROM '.$this->tabla; //Escribimos la consulta
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function insertPais(){
        $this->conectar();
        $nombrePais = $_POST['pais'];
        $coordX = $_POST['coordX'];
        $coordY = $_POST['coordY'];

        $imgBandera = $_FILES['imgBandera']['name']; //Ejemplo: india.png
        $imgBanderaTmp = $_FILES['imgBandera']['tmp_name'];
        $imgBanderaPath = BANDERAS.basename($imgBandera);

        if (!move_uploaded_file($imgBanderaTmp, $imgBanderaPath)) {
            echo "Error al subir la imagen.";
        }

        // Preparar
        $stmt = $this->conexion->prepare("INSERT INTO ".$this->tabla." (nombrePais, bandera, coordX, coordY, idContinente) VALUES (?, ?, ?, ? ,1)");
        $stmt->bind_param("ssdd", $nombrePais, $imgBandera, $coordX, $coordY);

        // Ejecutar
        $stmt->execute();

        // echo "Nuevo registro creado exitosamente";
    }

    public function updatePais(){
        $this->conectar();
        $pais = $_POST['pais'];
        $coordX = $_POST['coordX'];
        $coordY = $_POST['coordY'];
        $idPais = $_POST['idPais'];

        //Si hemos subido archivo nuevo, creo un update donde modifico el nombre del archivo en el campo bandera
        if(isset($_FILES['imgBandera']) && is_uploaded_file($_FILES['imgBandera']['tmp_name'])){
            $imgBandera = $_FILES['imgBandera']['name']; //Nombre del archivo
            $imgBanderaTmp = $_FILES['imgBandera']['tmp_name'];
            $rutaBandera = BANDERAS.basename($imgBandera);
            // Mover IMG a Directorio
            if (!move_uploaded_file($imgBanderaTmp, $rutaBandera)){die("Error al subir la imagen");}
            $archivo = $imgBandera;
        }

        if(!isset($archivo))
            $archivo = $_POST['imgBanderaActual']; // Si no hemos subido archivo, cogemos el nombre del archivo que ya teniamos
        

        $sql = "UPDATE ".$this->tabla." SET nombrePais = ?, coordX = ?, coordY = ?, bandera = ? WHERE codPais = ?";
        $conxPrp = $this->conexion->prepare($sql);
        $conxPrp->bind_param("sddss", $pais, $coordX, $coordY, $archivo, $idPais);
        $result = $conxPrp->execute();
        return $result;
    }

    public function getCoord(){
        $this->conectar();
        $sql = "SELECT coordX, coordY FROM ".$this->tabla;
        $result = $this->conexion->query($sql);

        $coordenadas = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $coordenadas[] = $row;
            }
        }

        return json_encode($coordenadas);
    }

    public function eliminarPais(){
        $this->conectar();
        $id = $_POST['id'];
        $sql = "DELETE FROM ".$this->tabla." WHERE codPais = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    public function selectModPais(){
        $this->conectar();
        $id = $_GET['id'];
        $sql = "SELECT nombrePais, bandera, coordX, coordY FROM paises WHERE codPais = ".$id;
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
    
}
?>
