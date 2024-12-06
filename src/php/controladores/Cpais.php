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