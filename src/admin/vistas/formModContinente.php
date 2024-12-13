<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar PaÃs</title>
    <link rel="icon" href="<?php echo IMG.'logo.png'?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo CSS.'estilo.css'?>">
</head>
<body>
    <header>
        <img src="<?php echo IMG.'logo.png'?>" alt="Logo">
        <h1>Viaje entre Culturas</h1>
    </header>
<main>

    <form>
        <label for="nombreContinente">Nombre del Continente:</label>
        <input type="text" name="nombreContinente">
        <input type="hidden" id='idContinente' value='<?php echo $_GET['id']?>' >
    </form>
    <button type="button" class="cancel">Cancelar</button>
    <button type="button" class="update">Modificar</button>

    </main>
</body>
<script src="<?php echo JS.'validModCont.js';?>"></script>
</html>
