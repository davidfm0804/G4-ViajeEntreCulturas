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
        return $this->objMenuPrincipal->mPaisSelecContinente();
    }

    public function cItemSelecContinente(){
        $this->vista = 'itemSeleccioneContinente';
        return $this->objMenuPrincipal->mPaisSelecContinente();
    }

    public function ListadoCategorias(){
        $this->vista = 'listadoCategorias';
        return $this->objMenuPrincipal->mListadoCategorias();
    }

    public function cRankingSelecContinente(){
        $this->vista = 'RankingElegirContinente';
        return $this->objMenuPrincipal->mRankingSelecContinente();
    }

}
?>