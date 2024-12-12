<?php
class GameController {
    public function iniciarJuego() {
        include_once 'vista/vista_juego.php'; 
    }
}

class GameModel {
    private $rankingFile = 'ranking.json';

    public function obtenerRanking() {
        if (file_exists($this->rankingFile)) {
            $data = file_get_contents($this->rankingFile);
            return json_decode($data, true);
        }
        return [];
    }

    public function guardarPuntaje($nombre, $tiempo) {
        $ranking = $this->obtenerRanking();
        $ranking[] = ['nombre' => $nombre, 'tiempo' => $tiempo];
        usort($ranking, function ($a, $b) {
            return $a['tiempo'] - $b['tiempo'];
        });
        file_put_contents($this->rankingFile, json_encode($ranking, JSON_PRETTY_PRINT));
    }
}

?>