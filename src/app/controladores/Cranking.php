<?php
class Cranking {
    private $objranking;

    public function __construct() {
        require_once '../../modelos/Mranking.php';
        $this->objranking = new Mranking();
    }

    public function cMostrarContinente() {
        return $this->objranking->mMostrarContinentes();
    }

    public function cMostrarPuntuacion($idContinente) {
        return $this->objranking->mMostrarPuntuacion($idContinente);
    }
    public function cBorrarPuntuacion($idContinente){
        return $this->objranking->mBorrarPuntuacion($idContinente);
    }
}
?>
