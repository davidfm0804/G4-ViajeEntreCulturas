<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Memory</title>
    <link rel="stylesheet" href="<?php echo CSS.'style.css'; ?>">
</head>
<body>
    <h1>Juego de Memory</h1>

    <div id="game">
        <button id="startGame">Empezar Juego</button>
        <p>Tiempo: <span id="contador">0</span>s</p>
        <p>Puntuación: <span id="puntuacion">0</span></p>
        <p>Intentos: <span id="intentos">0</span></p>

        <div id="tablero" class="hidden">
            <!--Tablero de cartas -->
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
