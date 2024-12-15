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
    <main>
        <img id="mapa" src="<?php echo IMG.'mapa.jpg'?>">
    </main>
    <input type="hidden" name="idContinente" value="<?php echo $_GET['idContinente']; ?>">
    <input type="hidden" name="nombreCont" value="<?php echo $_GET['nombreCont']; ?>">
    <input type="hidden" name="idPais" value="<?php echo $_GET['idPais']; ?>">
    <input type="hidden" name="pais" value="<?php echo $_GET['pais']; ?>">
    <script src='<?php echo JS.'05ubiModf.js'?>'></script>
</body>
</html>