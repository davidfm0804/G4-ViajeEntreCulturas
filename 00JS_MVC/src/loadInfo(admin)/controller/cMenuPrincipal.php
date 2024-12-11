<?php

require_once MODELOS.'mMenuPrincipal.php';

class cMenuPrincipal {
    public $tituloPagina;
    public $vista;

    public function __construct() {

        $this->tituloPagina = '';
        $this->vista = '';
        $this->objMenuPrincipal = new mMenuPrincipal(); 
    }

    public function cMenuAdmin(){
        $this->vista = 'menuPrincipal';
    }

    public function cPaisSelecContinente(){
        $this->vista = 'seleccioneContinente';
        $this->tituloPagina = 'Seleccione un continente';
        return $this->objMenuPrincipal->mPaisSelecContinente();
    }

    public function cListadoCategorias(){
        $this->vista = 'listadoCategorias';
        $this->tituloPagina = 'Seleccione un continente';
        return $this->objMenuPrincipal->mListadoCategorias();
    }
}
?>