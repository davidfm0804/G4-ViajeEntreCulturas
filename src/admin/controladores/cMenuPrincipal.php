<?php

require_once MODELOS.'mMenuPrincipal.php';

class cMenuPrincipal {
    public $tituloPagina;
    public $vista;

    public function __construct() {

        $this->tituloPagina = '';
        $this->vista = '';
        $this->objMenuPrincipal = new mMenuPrincipal(); //objPais es el nombre del objeto instanciado de la clase modelo Pais (mPais). Creamos objeto
    }

    public function cMenuAdmin(){
        $this->vista = 'menuPrincipal';
    }

    public function cPaisSelecContinente(){
        $this->vista = 'seleccioneContinente';
        $this->tituloPagina = 'Seleccione un continente';
        return $this->objMenuPrincipal->mPaisSelecContinente();
    }

    public function cListadoContinentes(){
        $this->vista = 'listadoContinentes';
        $this->tituloPagina = 'Listado de Continentes';
        return $this->objMenuPrincipal->mListadoContinentes();
    }
}
?>