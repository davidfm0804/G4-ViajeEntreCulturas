<?php

class MCategoria {

    private $tabla = 'categoria'; //Nombre de la tabla donde buscamos información
    private $conexion;

    public function __construct() {

    }

    public function conectar(){
        $objetoBD = new bbdd(); //Conectamos a la base de datos. Creamos objeto $objetoBD
        $this->conexion = $objetoBD->conexion; //Llamamos al metodo que realiza la conexion a la BBDD
    }

    public function selectCategorias(){
        $this->conectar(); //Llamo al metodo conectar de arriba
        $sql = 'SELECT idCategoria, nombreCat FROM '.$this->tabla; //Escribimos la consulta
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function insertCategoria($nombreCat){
        $this->conectar();

        // Preparar
        $stmt = $this->conexion->prepare("INSERT INTO ".$this->tabla." (nombreCat) VALUES (?)");
        $stmt->bind_param("s", $nombreCat);

        // Ejecutar
        $stmt->execute();

        return $stmt->affected_rows;

        // echo "Nuevo registro creado exitosamente";
    }

    public function selectModCatg(){
        $this->conectar();
        $idCat = $_GET['id']; 
        $sql = "SELECT idCategoria, nombreCat FROM ".$this->tabla." WHERE idCategoria = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $idCat);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function updateCategoria(){
        $this->conectar();
        $idCat = $_POST['idCat'];
        $nombreCat = $_POST['categoria'];

        $sql = "UPDATE ".$this->tabla." SET nombreCat = ? WHERE idCat = ?";
        $conxPrp = $this->conexion->prepare($sql);
        $conxPrp->bind_param("s", $nombreCat);
        $result = $conxPrp->execute();
        return $result;
    }

    public function eliminarCategoria($idCat){
        $this->conectar();
        $sql = "DELETE FROM ".$this->tabla." WHERE idCategoria = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $idCat);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }
    
}
?>
