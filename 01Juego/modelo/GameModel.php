<?php

class GameModel {
    
    private $rankingFile = 'ranking.json';
    
    public function obtenerRanking() {
        if (file_exists($this->rankingFile)) {
            $data = file_get_contents($this->rankingFile);
            return json_decode($data, true); 
        }
        return []; 
    }

    // Guardar un nuevo puntaje en el archivo de ranking
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