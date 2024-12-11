<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../../img/mapa.jpg" type="image/x-icon">
        <title>Registro Categoría</title>
        <link rel="stylesheet" href="../../CSS/estiloCelia.css">
    </head>
    <body>
        <header>
            <img src="../../img/logo.png" alt="Logo">
            <h1>Viaje entre Culturas</h1>
            <a href="#">PANEL ADMIN</a>
        </header>
        <main class="registro">
            <h2>Registrar categoría</h2>
            <form id="categoriaForm" action="mostrarAltaCategoria.php" method="POST">
                <input type="text" name="nombreCat" placeholder="Nombre Categoría" required>
                <div>
                    <button type="reset">Borrar</button>
                    <button type="button" class="cancel">Cancelar</button>
                    <button type="submit" class="update">Enviar</button>
                </div>
            </form>
            <?php
                if (isset($_GET['msj'])) {
                    echo $_GET['msj'];
                }
            ?>
        </main>

        <script src="../../js/06validCategoria.js"></script>
    </body>
</html>
