<?php

require_once MODELO.'mJuego.php';

    class CJuego {
        public $view;

        public function __construct() {
            $this->view = ''; 
            $this->objCatg = new MJuego();
        }

        public function inicio() {
            $this->view = 'inicio'; 
        }

        public function juegoTablero() {
            $this->view = 'juego'; 
        }

        public function regPunt() {
            $this->view = 'registroPuntuacion'; 
        }
        
    }

?>