<?php

require_once MODELO.'mMenuPrincipal.php';

class cMenuPrincipal {
    public $tituloPagina;
    public $view;

    public function __construct() {

        $this->tituloPagina = '';
        $this->view = '';
        $this->objMenuPrincipal = new mMenuPrincipal(); 
    }

    public function cMenuAdmin(){
        $this->view = 'menuPrincipal';
    }

    public function cPaisSelecContinente(){
        $this->view = 'seleccioneContinente';
        $this->tituloPagina = 'Seleccione un continente';
        return $this->objMenuPrincipal->mPaisSelecContinente();
    }

    public function ListadoCategorias(){
        $this->view = 'listadoCategorias';
        $this->tituloPagina = 'Seleccione un continente';
        return $this->objMenuPrincipal->mListadoCategorias();
    }
}
?>