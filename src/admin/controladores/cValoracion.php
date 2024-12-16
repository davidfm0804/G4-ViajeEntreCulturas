<?php

require_once MODELOS.'mValoracion.php';

class cValoracion {

    public $tituloPagina;
    public $view;

    public function __construct() {
        $this->vista = ''; //Hay que cambiarle el nombre. Es la vista por defecto que mostraremos de la pagina index.php
        $this->tituloPagina = '';
        $this->objValoracion = new mValoracion(); //objPais es el nombre del objeto instanciado de la clase modelo Pais (mPais). Creamos objeto
    }

    public function cListadoCorreos() {
        $this->vista = 'listadoCorreos'; //Hay que cambiarle el nombre. Es la vista por defecto que mostraremos de la pagina index.php
        $this->tituloPagina = 'Listado de valoraciones';
        return $this->objValoracion->mListadoCorreos();    
    }



}
?>