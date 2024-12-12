<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viaje entre culturas</title>
    <link rel="icon" href="<?php echo IMG.'mapa.jpg';?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo CSS.'estiloMapa.css'; ?>">
</head>
<body>
    <header>
        <img src="<?php echo IMG.'logo.png';?>" alt="Logo">
        <h1>Viaje entre Culturas</h1>
        <div>
            <span><a href="index.php">VOLVER</a></span>
        </div>
    </header>
    <?php
    $idContinente = $_GET['id'];
    $nombreCont = $_GET['nombreCont'];
    ?>
    <main>
        <img id="mapa" src="<?php echo IMG.'mapa.jpg';?>">
    </main>
    <input type="hidden" id="idContinente" value="<?php echo $idContinente; ?>">
    <input type="hidden" id="nombreCont" value="<?php echo $nombreCont; ?>">
    <script>
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const scriptToLoad = getQueryParam('script');
            const script = document.createElement('script');
            if(scriptToLoad === '03cargarCoord.js'){
                script.src = "<?php echo JS.'03cargarCoord.js';?>";
            }
            else{
                script.src = "<?php echo JS.'01coordCop.js';?>";
            }
            script.defer = true; // Asegura que el script se ejecute después de que el documento esté completamente cargado
            document.body.appendChild(script);
        });
    </script>
</body>
</html>