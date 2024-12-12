<?php

require_once MODELOS.'mPais.php';

class cPais {

    public $tituloPagina;
    public $vista;

    public function __construct() {
        $this->vista = ''; //Hay que cambiarle el nombre. Es la vista por defecto que mostraremos de la pagina index.php
        $this->tituloPagina = '';
        $this->objPais = new mPais(); //objPais es el nombre del objeto instanciado de la clase modelo Pais (mPais). Creamos objeto
    }

    public function cListadoPaises(){ //Este método devuelve el listado de países
        $this->tituloPagina = 'Listado de países de '.$_GET['nombreCont'];
        $this->vista = 'listadoPaises';
        return $this->objPais->mListadoPaises();
    }

    public function cMapaChincheta(){ //Este método devuelve la vista del mapa para colocar la chincheta
        $this->vista = 'mapaChincheta'; 
    }

    public function cFormAltaPais(){
        $this->vista = 'formAltaPais';
        return $this->objPais->mFormAltaPais(); //Este método devuelve la vista del formulario para dar de alta un nuevo país
    }

    public function cAltaPais() {
        return $this->objPais->mAltaPais();
    }

    public function cFormModPais(){
        $this->vista = 'formModPais';
        return $this->objPais->mFormModPais();
    }
    
    public function cCambiarChincheta(){
        $this->vista = 'cambiarChincheta';
    }
    public function cUpdatePais(){
        $result = $this->objPais->mUpdatePais();

        if ($result) {
            echo "Registro modificado correctamente";
         } else {
             // Si hubo un error, establecemos otro mensaje en la sesión
             echo "Error al modificar el registro";
         }
         exit;
    }

    public function cBorrarPais(){
        $result = $this->objPais->mBorrarPais();
        
        if ($result) {
           echo "Registro eliminado correctamente";
        } else {
            // Si hubo un error, establecemos otro mensaje en la sesión
            echo "Error al eliminar el registro";
        }
        exit;
    }
}
?>