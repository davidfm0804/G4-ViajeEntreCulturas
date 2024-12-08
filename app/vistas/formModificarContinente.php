<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Continente</title>
</head>
<body>
    <?php
    if (isset($_GET['id'])) {
    ?>
        <form action="modificarContinente.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <label for="nombreContinente">Nombre del Continente:</label>
            <input type="text" name="nombreContinente" id="nombreContinente">
            <br><br>
            <input type="submit" value="Modificar">
        </form>
    <?php
    } else {
        echo "ID no válido.";
    }
    ?>
    <br>
    <a href='listadoContinentes.php'>
        <button>Volver Inicio</button>
    </a>
</body>
</html>
