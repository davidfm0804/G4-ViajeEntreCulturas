<?php

require_once MODELO.'mCategoria.php';

class cCategoria {

    public $tituloPagina;
    public $view;

    public function __construct() {
        $this->view = 'listadoCategorias'; //Hay que cambiarle el nombre. Es la vista por defecto que mostraremos de la pagina index.php
        $this->tituloPagina = '';
        $this->objCatg = new MCategoria();
    }

    public function listadoCategorias(){
        $this->tituloPagina = 'Listado de Categorías';
        return $this->objCatg->selectCategorias();
    }

    public function formAlta(){
        $this->view = 'registroCategoria';
    }

    public function insertDatos(){
        return $this->objCatg->insertCategoria();
    }


    public function borrarCategoria(){
        $result = $this->obCatg->eliminarCategoria();
        
        if ($result) {
           echo "Registro eliminado correctamente";
        } else {
            echo "Error al eliminar el registro";
        }
        exit;
    }

    public function formModCatg(){
        $this->view = 'formModCatg';
       return $this->objCatg->selectModCategoria();   
    }

    public function modificarCategoria(){
        $result = $this->objCatg->updateCategoria();

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