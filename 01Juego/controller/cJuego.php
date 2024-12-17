<?php

require_once MODELO.'mJuego.php';

    class CJuego {
        public $view;

        public function __construct() {
            $this->view = ''; 
            $this->objJuego = new MJuego();
        }

        public function bienvenida() {
            $this->view = 'bienvenida'; 
            return $this->objJuego->seleccionarContinentes();
        }

        public function mapa() {
            $this->view = 'mapa'; 
        }

        public function juegoMemory() {
            $this->view = 'juego'; 
        }

        public function registrarPuntuacion() {
            $this->view = 'registroPuntuacion'; 
        }

        public function obtenerInfoPartida() {
            $idCont = isset($_POST['idCont']) ? intval($_POST['idCont']) : false;
            if ($idCont !== false) {
                $infoPartida = $this->objJuego->obtenerInfoPartida($idCont);
                echo $infoPartida; // Enviar la respuesta JSON al cliente
            } else {
                echo json_encode(array('error' => 'ID de continente no válido'));
            }
        }

        public function obtenerInfoPais() {
            $idPais = isset($_POST['idPais']) ? intval($_POST['idPais']) : false;
            if ($idPais) {
                $infoPais = $this->objJuego->obtenerInfoPais($idPais);
                echo $infoPais; // Enviar Respuesta JSON
            } else {
                echo json_encode(array('error' => 'ID de país no válido'));
            }
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

        public function obtenerSeleccionada() {
            return $this->objJuego->obtenerSeleccionada();
        }
    }

?>