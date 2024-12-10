<?php

require_once MODELO.'mPais.php';

class Cpais {

    public $tituloPagina;
    public $vista;

    public function __construct() {
        $this->vista = 'listadoPaises'; //Hay que cambiarle el nombre. Es la vista por defecto que mostraremos de la pagina index.php
        $this->tituloPagina = '';
        $this->objPais = new mPais(); //objPais es el nombre del objeto instanciado de la clase modelo Pais (mPais). Creamos objeto
    }

    public function cListadoPaises(){ //Este método devuelve el listado de países
        $this->tituloPagina = 'Listado de países';
        return $this->objPais->selectPaises();
    }

    public function cMapaChincheta(){ //Este método devuelve la vista del mapa para colocar la chincheta
        $this->vista = 'mapaChincheta'; 
    }

    public function cFormAlta(){
        $this->vista = 'formAlta'; //Este método devuelve la vista del formulario para dar de alta un nuevo país
    }


    public function cAltaPais() {
        return $this->objpais->mAltaPais();
    }

    public function cEliminarPais($nombrePais) {
        return $this->objMpais->mBorrarPais($nombrePais);
    }
    

    public function cObtenerPaises() {
        return $this->objMpais->mObtenerPaises();
    }

    public function cObtenerPaisPorNombre($nombrePais) {
        return $this->objMpais->mObtenerPaisPorNombre($nombrePais);
    }     
    
    public function cModificarPais($nombrePais, $nuevoNombrePais, $bandera, $coordX, $coordY) {
        if ($this->objMpais->mModificarPais($nombrePais, $nuevoNombrePais, $bandera, $coordX, $coordY)) {
            return true;
        }
        return false;
    }
    

}
?>