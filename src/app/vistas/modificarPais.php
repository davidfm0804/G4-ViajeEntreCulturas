<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar País</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/estilo.css">
    <link rel="icon" href="../../img/mapa.jpg" type="image/x-icon">
</head>
<body>
    <header>
        <img src="../../img/logo.png" alt="Logo">
        <h1>Viaje entre Culturas</h1>
    </header>
    <main>
        <div>
        <form action="mostrarModificarPais.php" method="POST" enctype="multipart/form-data">
            <label for="nombrePais">Nombre del País a Modificar:</label><br>
            <input type="text" name="nombrePais" placeholder="Nombre del país" ><br><br>

            <label for="nuevoNombrePais">Nuevo Nombre del País:</label><br>
            <input type="text" name="nuevoNombrePais" placeholder="Nuevo nombre del país" ><br><br>

            <label for="bandera" id="subirBandera">Nueva Bandera:</label><br>
            <input type="file" id="bandera" name="bandera"><br/><br/>

            <label for="coordX">Nueva Coordenada X:</label><br>
            <input type="text" name="coordX" ><br><br>

            <label for="coordY">Nueva Coordenada Y:</label><br>
            <input type="text" name="coordY" ><br><br>

            <input type="submit" value="Modificar">
            <input type="reset" class="cancel" value="Borrar"><br><br>

            <?php
            if (isset($_GET['msj'])) {
                echo "<p>" . $_GET['msj'] . "</p>";
            }
            ?>
        </form>

        </div>
   </main>
</body>
</html>
