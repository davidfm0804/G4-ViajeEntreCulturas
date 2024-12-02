<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PAÍSES</title>
    <link rel="stylesheet" href="../src/css/reset.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>
<body>
    <header>
        <!-- Header -->
    </header>
    <nav>
        <!-- Navegación -->
    </nav>
    <main>
        <div>
            <h1>Alta de País</h1><br/>

            <form action="mostrarAltapais.php" method="POST" enctype="multipart/form-data">
                <label for="nombrePais">Nombre del País: </label>
                <input type="text" name="nombrePais" placeholder="Nombre del País" required><br/><br/>

                <label for="bandera">Imagen Bandera:</label>
                <input type="file" name="bandera" required><br/><br/>

                <label for="coordX">Coordenada X:</label>
                <input type="text" name="coordX" required><br/><br/>

                <label for="coordY">Coordenada Y:</label>
                <input type="text" name="coordY" required><br/><br/>

                <input type="submit" value="Enviar">
                <input type="reset" value="Borrar">

                <?php
                    if (isset($_GET['msj'])){
                        echo $_GET['msj'];
                    }
                ?>

            </form>
        </div>
    </main>
    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>