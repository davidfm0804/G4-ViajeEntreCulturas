<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo CSS.'style.css'; ?>">
        <title>Juego de Memory</title>
    </head>
    <body>
        <h1>¡Bienvenido al Juego de Memory!</h1>
        <button id="startGame" type='button' window>Empezar Juego</button>
    </body>
    <script>
        document.getElementById('startGame').addEventListener('click', function() {
            window.location.href = 'index.php?controller=Juego&action=juegoTablero'; 
        });
    </script>
</html>
