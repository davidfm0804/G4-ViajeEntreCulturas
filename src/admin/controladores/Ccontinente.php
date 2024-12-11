<?php

require_once MODELOS.'mContinente.php';

class cContinente {

    public $tituloPagina;
    public $view;

    public function __construct() {
<<<<<<< HEAD:src/app/controladores/Ccontinente.php
        require_once '../../modelos/Mcontinente.php';
        $this->objcontinente = new Mcontinente();
=======
        $this->vista = ''; //Hay que cambiarle el nombre. Es la vista por defecto que mostraremos de la pagina index.php
        $this->tituloPagina = '';
        $this->objContinente = new mContinente(); //objPais es el nombre del objeto instanciado de la clase modelo Pais (mPais). Creamos objeto
>>>>>>> 8585935ba008e605496e7716a45c1276909ef52f:src/admin/controladores/Ccontinente.php
    }

    public function cFormAltaContinente(){
        $this->vista ='formAltaContinente';
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
