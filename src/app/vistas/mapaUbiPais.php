<?php require_once('../config/config.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viaje entre culturas</title>
    <link rel="stylesheet" href="../../css/estiloMapa.css">
    <link rel="icon" href='../../img/mapa.jpg'type="image/x-icon">
</head>
<body>
    <header>
    <img src="../../img/logo.png" alt="Logo">
        <h1>Viaje entre Culturas</h1>
        <div>
            <span><a href="./crudPais.php">VOLVER</a></span>
        </div>
    </header>
    <main>
        <img id="mapa" src="<?php echo IMG.'mapa.jpg';?>">
    </main>
    <script>
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const scriptToLoad = getQueryParam('script');
            const script = document.createElement('script');
            script.src = scriptToLoad === '03cargarCoord.js' ? '<?php echo JS.'03cargarCoord.js';?>' : '<?php echo JS.'01coordCop.js';?>';
            script.defer = true; // Asegura que el script se ejecute después de que el documento esté completamente cargado
            document.body.appendChild(script);
        });
    </script>
</body>
</html>