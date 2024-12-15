<?php
class Ccontinente {
    private $objcontinente;

    public function __construct() {
        require_once '../../modelos/Mcontinente.php';
        $this->objcontinente = new Mcontinente();
    }

    public function cMostrarContinente() {
        return $this->objcontinente->mMostrarContinentes();
    }
    
    public function cInsertarContinente($nombreContinente) {
        $resultado = $this->objcontinente->mInsertarContinente($nombreContinente);
        if ($resultado === true) {
            return "Consulta Correcta";
        } elseif ($resultado === "Csu") {
            return "Continente Duplicado";
        } else {
            return "Error en el registro";
        }
    }

    public function cBorrarContinente($idCont) {
        return $this->objcontinente->mBorrarContinente($idCont);
    }

    public function cModificarContinente($nombreC, $idCont) {
        $resultado = $this->objcontinente->mModificarContinente($nombreC, $idCont);
        if ($resultado === true) {
            return "Modificación correcta";
        } elseif ($resultado === "Csu") {
            return "Nombre del continente ya existe";
        } else {
            return "Error al modificar";
        }
    }
}
?>
