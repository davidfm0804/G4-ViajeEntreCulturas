<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo IMG.'mapa.jpg'; ?>" type="image/x-icon">
        <title>Gestión Categorías</title>
        
        <link rel="stylesheet" href="<?php echo CSS.'estiloCelia.css'; ?>">
    </head>
    <body>
        <header>
            <img src="<?php echo IMG.'logo.png'; ?>" alt="Logo">
            <h1>Viaje entre Culturas</h1>
            <a href="index.php">PANEL ADMIN</a>
        </header>
        <main>
            <h2>Listado categorías</h2>
            <button id="altaPais">alta categoría</button>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(count($dataToView["data"])>0){
                        foreach($dataToView["data"] as $catg){
                            ?>
                            <tr id="<?php echo $catg["idCategoria"]; ?>">
                                <td class="colNombre"><?php echo $catg["nombreCat"]; ?></td> 
                                <td><button><img class='png' src="<?php echo IMG.'modificar.png';?>"></button></td>
                                <td><button><img class='png' src="<?php echo IMG.'borrar.png';?>"></button></td>
                            </tr>
                            <?php
                        } 
                    } else {
                        ?>
                        <tr><td colspan='4'>No hay categorías disponibles</td></tr>
                    <?php
                    }
                    ?>
            </table>
        </main>
        <script src="<?php echo JS_MODELO.'mCategoria.js';?>"></script>
        <script src="<?php echo JS_CONTROLADOR.'cCategoria.js';?>"></script>
        <script src="<?php echo JS.'06FunCatg.js';?>"></script>
    </body>
</html>