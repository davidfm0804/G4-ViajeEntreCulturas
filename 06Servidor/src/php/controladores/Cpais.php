<?php
class Cpais {
    private $objMpais;

    public function __construct() {
        require_once '../modelos/Mpais.php';
        $this->objMpais = new Mpais();
    }

    public function cAltaPais($nombrePais, $bandera, $x, $y) {
        return $this->objMpais->mAltaPais($nombrePais, $bandera, $x, $y);
    }

    public function cObtenerPaises() {
        return $this->objMpais->mObtenerPaises();
    }

    public function cObtenerPaisPorNombre($nombrePais) {
        return $this->objMpais->mObtenerPaisPorNombre($nombrePais);
    }     
    
}
?>