<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo IMG.'mapa.jpg'; ?>" type="image/x-icon">
        <title>Gestión Continentes</title>
        
        <link rel="stylesheet" href="<?php echo CSS.'estiloCelia.css'; ?>">
    </head>
    <body>
        <header>
            <img src="<?php echo IMG.'logo.png'; ?>" alt="Logo">
            <h1>Viaje entre Culturas</h1>
            <a href="index.php">PANEL ADMIN</a>
        </header>
<main>        
        <h2><?php echo $controlador->tituloPagina; ?></h2>
        <button id="altaPais">Alta continente</button>
        <table>
            <tr>
                <th class="cabecera">Nombre</th>
                <th class="cabecera">Modificar</th>
                <th class="cabecera">Borrar</th>
            </tr>
            <?php
            if(count($dataToView["data"])>0){
                foreach($dataToView["data"] as $continente){
                    ?>
                    <tr id="<?php echo $continente["idContinente"]; ?>">
                        <td class='colNombre'><?php echo $continente["nombreCont"]; ?></td> 
                        <td><button><img class='png' src="<?php echo IMG.'modificar.png';?>"></button></td>
                        <td><button><img class='png' src="<?php echo IMG.'borrar.png';?>"></button></td>
                    </tr>
                    <?php
                } 
            } else {
                ?>
                <tr><td colspan='4'>No hay continentes disponibles</td></tr>
            <?php
            }
            ?>
        </table>
    </main>
    <script src="<?php echo JS.'listadoContinentes.js';?>"></script>
</body>
</html>