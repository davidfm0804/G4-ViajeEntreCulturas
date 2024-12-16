<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viaje entre culturas</title>
    <link rel="icon" href="<?php echo IMG.'mapa.jpg'?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo CSS.'estiloCeliaJuego.css'?>">
</head>
<body id='mapa'>
    <header>
        <img src="<?php echo IMG.'logo.png'?>" alt="Logo">
        <h1>Viaje entre Culturas</h1>
        <p id="open-popup">❓</p>
    </header>
    <!-- Popup que aparece al cargar -->
    <div id="popup">
        <div class="popup-content">
            <span id="close-popup" class="close-btn">❌</span>
            <h2 id="popup-title">Ayuda</h2>
            <div id="popup-body">
                <p>¡Bienvenido a la sección del Mapa!</p>
                <p>Descubre algunos datos curiosos sobre estos paises pulsando en las diferentes chinchetas.</p>
                <p>Una vez hayas terminado, podrás poner a prueba tus conocimientos con un Memory Game. ¡Suerte!</p>
            </div>
        </div>
    </div>
    <main>
        <img id="mapa" src="<?php echo IMG.'mapa.jpg'?>" alt="Mapa">
    </main>
    <script src="<?php echo JS_MODELO.'mJuego.js'?>"></script>
    <script src="<?php echo JS_CONTROLADOR.'cJuego.js'?>"></script>
    <script src="<?php echo JS.'01FunMapa.js'?>"></script>
</body>
</html>
