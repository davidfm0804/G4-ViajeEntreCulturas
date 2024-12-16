<?php

require_once MODELOS.'Mranking.php';

class Cranking {
    private $objranking;

    public function __construct() {
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
