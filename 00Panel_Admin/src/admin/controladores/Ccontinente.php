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

    public function cModificarContinente() {
        // Recoger los datos enviados a través del formulario o petición (por ejemplo, FormData)
        $nombreC = $_POST['nombreCont'];  // 'nombreCont' es el campo enviado
        $idCont = $_POST['idContinente']; // 'idContinente' es el campo enviado
        // Llamar al método del modelo para modificar el continente
        $resultado = $this->objContinente->mModificarContinente($nombreC, $idCont);

        if ($resultado === true) {
            echo "Continente Modificado";
        } elseif ($resultado === "csu") {
            echo "El nombre del continente ya existe, no se puede modificar.";
        } else {    
            echo "Error Modificando el continente";
        }
    }
}
?>
