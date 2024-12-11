<?php
class Ccategoria {
    private $objMcategoria;

    public function __construct() {
        require_once '../modelos/Mcategoria.php';
        $this->objMcategoria = new Mcategoria(); 
    }

    public function cAltaCategoria($nombreCat) { 
        return $this->objMcategoria->mAltaCategoria($nombreCat);
    }
}
?>