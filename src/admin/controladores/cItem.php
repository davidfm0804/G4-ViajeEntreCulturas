<?php

require_once MODELOS.'mItem.php';

class cItem {

    public $tituloPagina;
    public $vista;

    public function __construct() {
        $this->vista = ''; //Hay que cambiarle el nombre. Es la vista por defecto que mostraremos de la pagina index.php
        $this->tituloPagina = '';
        $this->objItem = new mItem(); //objPais es el nombre del objeto instanciado de la clase modelo Pais (mPais). Creamos objeto
    }

    public function cListadoPaises(){ //Este método devuelve el listado de países
        $this->tituloPagina = 'Listado de países de '.$_GET['nombreCont'];
        $this->vista = 'itemListadoPaises';
        return $this->objItem->mListadoPaises();
    }

    public function cFormModItems(){
        $this->vista = 'formModItems';
        return $this->objItem->mFormModItems();
    }

    public function cUpdateItem(){
        $result = $this->objItem->mUpdateItem();

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