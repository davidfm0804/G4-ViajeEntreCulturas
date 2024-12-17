<?php
class cRanking {
    private $objranking;

    public function __construct() {
        require_once MODELOS.'mRanking.php';
        $this->objranking = new Mranking();
    }

    public function cMostrarContinente() {
        return $this->objranking->mMostrarContinentes();
    }

    public function cMostrarPuntuacion($idContinente) {
        return $this->objranking->mMostrarPuntuacion($idContinente);
    }
    public function cBorrarPuntuacion(){
        $result= $this->objranking->mBorrarPuntuacion();
        if($result){
            echo "Borrado Correctamente";
        }else{
            echo "Error en el Borrado";
        }
    }
    public function cListadoRanking(){
        $this->vista='rankingContinente';
        $this->tituloPagina = 'RankingContinente';
        return $this->objranking->mListadoRanking();
    }
}
?>
