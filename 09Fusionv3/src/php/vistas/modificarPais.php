<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar País</title>
</head>
<body>
    <h1>Modificar País</h1>
    <form action="mostrarModificarPais.php" method="POST" enctype="multipart/form-data">

        <label for="nombrePais">Nombre del País a Modificar:</label>
        <input type="text" name="nombrePais" placeholder="Nombre del país" ><br><br>

        <label for="bandera">Nueva Bandera:</label>
        <input type="file" name="bandera"><br/><br/>

        <label for="coordX">Nueva Coordenada X:</label>
        <input type="number" step="0.01" name="coordX" placeholder="Nueva coordenada X"><br><br>

        <label for="coordY">Nueva Coordenada Y:</label>
        <input type="number" step="0.01" name="coordY" placeholder="Nueva coordenada Y"><br><br>

        <input type="submit" value="Modificar País">

        <?php
            if (isset($_GET['msj'])) {
                echo "<p>" . $_GET['msj'] . "</p>";
            }
        ?>
    </form>
</body>
</html>
