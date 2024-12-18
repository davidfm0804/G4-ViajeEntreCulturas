<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo IMG.'mapa.jpg'; ?>" type="image/x-icon">
    <title>Registro Puntuación</title>
    <link rel="stylesheet" href="<?php echo CSS.'estiloCeliaJuego.css'; ?>">
</head>
<body>
    <header>
        <img src="<?php echo IMG.'logo.png'; ?>" alt="Logo">
        <h1>Viaje entre Culturas</h1>
    </header>
    <main class="registro">
        <h2>Registrar Puntuación [<span id="puntuacion"></span>]</h2>
        <input type="text" name="nombreJug" placeholder="Nombre Jugador" required>
        <button type="reset">Borrar</button>
        <button type="button">Cancelar</button>
        <button type="submit">Enviar</button>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <script src="<?php echo JS.'03FunRegtPunt.js'?>"></script>
</body>
</html>