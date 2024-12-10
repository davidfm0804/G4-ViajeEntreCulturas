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

    public function mapaChincheta(){
        $this->view = 'mapaChincheta';
    }

    public function formAlta(){
        $this->view = 'formAlta';
    }

    public function insertDatos(){
        return $this->objPais->insertPais();
    }

    public function obtenerCoord(){
        $coordenadasJson = $this->objPais->getCoord();
        
        header('Content-Type: application/json');

        echo $coordenadasJson;
        exit; //Si no pongo exit, no se acaba la asincronia del fetch
    }

    public function borrarPais(){
        $result = $this->objPais->eliminarPais();
        
        if ($result) {
           echo "Registro eliminado correctamente";
        } else {
            echo "Error al eliminar el registro";
        }
        exit;
    }

    public function formModPais(){
        $this->view = 'formModPais';
       return $this->objPais->selectModPais();   
    }

    public function cambiarChincheta(){
        $this->view = 'cambiarChincheta';
    }

    public function modificarPais(){
        $result = $this->objPais->updatePais();

        if ($result) {
            echo "Registro modificado correctamente";
         } else {
             // Si hubo un error, establecemos otro mensaje en la sesión
             echo "Error al modificar el registro";
         }
         exit;
    }
}
?>