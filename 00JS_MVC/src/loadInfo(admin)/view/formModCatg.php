<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo IMG.'mapa.jpg'; ?>" type="image/x-icon">
        <title>Registro Categoría</title>
        
        <link rel="stylesheet" href="<?php echo CSS.'estiloCelia.css'; ?>">
    </head>
    <body>
        <header>
            <img src="<?php echo IMG.'logo.png'; ?>" alt="Logo">
            <h1>Viaje entre Culturas</h1>
            <a href="#">PANEL ADMIN</a>
        </header>
        <main class="registro">
            <h2>Modificar categoría</h2>
            <form method="post" action="index.php?controlador=Categoria&accion=modificarCategoria">
                <input type="hidden" name="idCat" value="<?php echo $categoria['idCat']; ?>">
                <input type="text" name="categoria" value="<?php echo $categoria['nombreCat']; ?>" placeholder="Nombre Categoría">
                <button type="submit">Enviar</button>
            </form>
        </main>
        <script src="<?php echo JS.'06FunCatg.js';?>"></script>
    </body>
</html>