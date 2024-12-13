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
    public function cFormModContinente(){
        $this->vista='formModContinente';
    }

    public function cMostrarContinente() {
        return $this->objcontinente->mMostrarContinentes();
    }
    
    public function cInsertarContinente() {
        $resultado = $this->objContinente->mInsertarContinente();
        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit;
    }

    public function cBorrarContinente() {
        $idContinente = $_POST['idContinente'];

        $result = $this->objContinente->mBorrarContinente($idContinente);

        if ($result) {
           echo "Registro eliminado correctamente";
        } else {
            // Si hubo un error, establecemos otro mensaje en la sesión
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
        if(!$resultado){
            echo "Error Modificando el continente";
        }else{
            echo "Continente Modificado";
        }
    }
}
?>
