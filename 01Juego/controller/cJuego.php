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

        public function verRanking() {
            $this->view = 'rankingPuntuaciones'; 
            return $this->objCatg->selectPuntuaciones();
        }

        // Insert Puntuacion
        public function insertarPuntuacion() {
            if (!isset($_POST['nombre']) || !isset($_POST['puntos']) || !isset($_POST['tiempo']) 
                || !isset($_POST['numFallos']) || !isset($_POST['idContinente'])) {
                echo "Error al registrar la puntuación";
                exit;
            }

            $result = $this->objCatg->insertPuntuacion($_POST['nombre'], $_POST['puntaje'], 
                $_POST['numFallos'], $_POST['tiempo'], $_POST['idContinente']);

            if ($result)
                echo "Puntuación registrada correctamente";
            else
                echo "Error al registrar la puntuación";

            exit;
        }
    }

?>