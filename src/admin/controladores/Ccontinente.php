<?php

require_once MODELOS.'mContinente.php';

class cContinente {

    public $tituloPagina;
    public $view;

    public function __construct() {
        $this->vista = ''; //Hay que cambiarle el nombre. Es la vista por defecto que mostraremos de la pagina index.php
        $this->tituloPagina = '';
        $this->objContinente = new mContinente(); //objPais es el nombre del objeto instanciado de la clase modelo Pais (mPais). Creamos objeto
    }

    public function cFormAltaContinente(){
        $this->vista ='formAltaContinente';
    }

    public function cListadoContinentes(){
        $this->vista = 'listadoContinentes';
        $this->tituloPagina = 'Listado de Continentes';
        return $this->objContinente->mListadoContinentes();
    }

    public function cFormModContinente(){
        $this->vista = 'formModContinente';    
    }

    public function cMostrarContinentes() {
        return $this->objcontinente->mMostrarContinentes();
    }
    
    public function cInsertarContinente() {
        $resultado = $this->objContinente->mInsertarContinente();
       
        header('Content-Type: application/json');
    
        if ($resultado === true) {
            echo json_encode(['success' => true, 'message' => 'Consulta Correcta']);
        } elseif ($resultado === "Csu") {
            echo json_encode(['success' => false, 'message' => 'Continente Duplicado']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error en el registro']);
        }
    }

    public function cBorrarContinente() {
       
        if (!isset($_POST['idContinente']) || empty($_POST['idContinente'])) {
            echo "El ID del continente es obligatorio";
            exit;
        }

        $idContinente = $_POST['idContinente'];

        $resultado = $this->objContinente->mBorrarContinente($idContinente);
        
        if ($resultado) {
           echo "Registro eliminado correctamente";
        } else {
            echo "Error al eliminar el registro";
        }
        exit;
        
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
