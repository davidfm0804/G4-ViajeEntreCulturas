<?php
require_once '../controladores/Cpais.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar País</title>
</head>
<body>
    <h1>Eliminar País</h1>

    <form action="mostrarEliminarPais.php" method="POST">
        <label for="nombrePais">Nombre del País a Eliminar:</label>
        <input type="text" name="nombrePais" placeholder="Introduce el nombre del país" >
        <br><br>
        <input type="submit" value="Eliminar País">
    </form>

    <?php
        if (isset($_GET['msj'])){
            echo $_GET['msj'];
        }
    ?>

</body>
</html>
