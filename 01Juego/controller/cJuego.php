<?php

require_once MODELO.'mJuego.php';

    class CJuego {
        public $view;

        public function __construct() {
            $this->view = ''; 
            $this->objJuego = new MJuego();
        }

        public function inicio() {
            $this->view = 'inicio'; 
        }

        public function juegoTablero() {
            $this->view = 'juego'; 
        }

        public function registrarPuntuacion() {
            $this->view = 'registroPuntuacion'; 
        }

        public function verRanking() {
            $idCont = isset($_GET['idCont']) ? intval($_GET['idCont']) : false;
            $this->view = 'rankingPuntuaciones'; 
            return $this->objJuego->seleccionarPuntuaciones($idCont);
        }

        // Insertar Puntuacion
        public function insertarPuntuacion() {
            if (!isset($_POST['nombre']) || !isset($_POST['puntos']) || !isset($_POST['tiempo']) 
                || !isset($_POST['numFallos']) || !isset($_POST['idCont'])) {
                echo "Error al registrar la puntuación";
                exit;
            }

            $result = $this->objJuego->insertarPuntuacion($_POST['nombre'], $_POST['puntos'], 
                $_POST['numFallos'], $_POST['tiempo'], $_POST['idCont']);

            if ($result)
                echo "Puntuación registrada correctamente";
            else
                echo "Error al registrar la puntuación";

            exit;
        }
    }

?>