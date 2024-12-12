<?php
class cCategoria {
    private $objMcategoria;

    public function __construct() {
        require_once MODELOS.'mcategoria.php';
        $this->objMcategoria = new mCategoria(); 
    }

    public function cAltaCategoria($nombreCat) { 
        return $this->objMcategoria->mAltaCategoria($nombreCat);
    }
}
?>