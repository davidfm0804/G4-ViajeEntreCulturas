<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Game</title>
    <link rel="stylesheet" href="<?php echo CSS.'estiloCeliaJuego.css'; ?>">
</head>
<body id="juego">
    <h1>Memory Game</h1>

    <div id="game">
        <button id="startGame">Empezar Juego</button>
        <p>Tiempo: <span id="contador">0</span>s</p>
        <p>Puntuación: <span id="puntuacion">0</span></p>
        <p>Fallos: <span id="intentos">0</span></p>

        <div id="tablero" class="hidden">
            <!--Tablero de cartas -->
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <script src="<?php echo JS.'02FunTablero.js' ?>"></script>
</body>
</html>
