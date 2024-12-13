<?php

class mContinente {
    private $conexion;
    private $tabla = 'continente';
    public function __construct() {
        require_once 'configDb.php';
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

    public function mInsertarContinente() {
        $nombreContinente = trim($_POST['nombreContinente']); // Sanitización básica
        
        try {
            $SQL = "INSERT INTO continente (nombreCont) VALUES (?)";
            $consulta = $this->conexion->prepare($SQL);
            $consulta->bind_param('s', $nombreContinente);
            
            $consulta->execute(); // Ejecuta la consulta
            return ['success' => true]; // Inserción exitosa
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) { 
                return ['success' => false, 'error' => 'duplicado'];
            } else {
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }
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
        $SQL = "UPDATE continente SET nombreCont = ? WHERE idContinente = ?";
        
        if ($stmt = $this->conexion->prepare($SQL)) {
            $stmt->bind_param("si", $nombreC, $idCont);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;

            }
        } else {
            return([
                'success' => false,
                'message' => 'Error al preparar la consulta SQL'
            ]);
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) { 
            return([
                'success' => false,
                'message' => 'El continente ya existe'
            ]);
        } else {
            return([
                'success' => false,
                'message' => 'Error en la base de datos: ' . $e->getMessage()
            ]);
        }
    }
}
  
}
?>
