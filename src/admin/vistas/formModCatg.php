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
            <a href="index.php">PANEL ADMIN</a>
        </header>
        <main class="registro">
            <h2>Modificar categoría</h2>
            <?php
                if(count($dataToView["data"])>0){ 
                    foreach($dataToView["data"] as $catg){
            ?>
            <input type="hidden" name="idCat" value="<?php echo $catg['idCategoria']?>">
            <input type="text" name="categoria" placeholder="Nombre Categoría" value="<?php echo $catg['nombreCat']?>">
            <?php
                }}
            ?>
            <button>borrar</button>
            <button>cancelar</button>
            <button>enviar</button>
        </main>
        <script src="<?php echo JS_MODELO.'mCategoria.js';?>"></script>
        <script src="<?php echo JS_CONTROLADOR.'cCategoria.js';?>"></script>
        <script src="<?php echo JS.'06FunModfCatg.js';?>"></script>
    </body>
</html>