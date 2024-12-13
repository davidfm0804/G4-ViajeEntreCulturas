<?php

require_once MODELO.'mPais.php';

class cPais {

    public $tituloPagina;
    public $view;

    public function __construct() {
        $this->view = 'listadoPaises'; //Hay que cambiarle el nombre. Es la vista por defecto que mostraremos de la pagina index.php
        $this->tituloPagina = '';
        $this->objPais = new mPais(); //objPais es el nombre del objeto instanciado de la clase modelo Pais (mPais). Creamos objeto
    }

    public function listadopaises(){
        $this->tituloPagina = 'Listado de países';
        return $this->objPais->selectPaises();
    }

    public function altaPais(){
        $this->tituloPagina = 'Dar de alta';
        return $this->objPais->selectPaises();
    }
}
?>