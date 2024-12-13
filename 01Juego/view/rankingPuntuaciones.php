<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../../src/img/mapa.jpg" type="image/x-icon">
        <title>Ranking</title>
        
        <link rel="stylesheet" href="../../src/css/estiloCelia.css">
    </head>
    <body>
        <header>
            <img src="../../src/img/logo.png" alt="Logo">
            <h1>Viaje entre Culturas</h1>
        </header>
        <main class="registro">
            <h2>Ranking</h2>
            <table>
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Nombre</th>
                        <th>Puntos</th>
                        <th>Tiempo</th>
                        <th>Fallos</th>
                    </tr>
                </thead>
                <?php
                    if(count($dataToView["data"])>0){
                        foreach($dataToView["data"] as $punt){
                            ?>
                            <tr id="<?php echo $punt["idPuntuacion"]; ?>">
                                <td><?php echo $punt["nombre"]; ?></td>
                                <td><?php echo $punt["puntos"]; ?></td>
                                <td><?php echo $punt["numFallos"]; ?></td>
                                <td><?php echo $punt["tiempo"]; ?></td>
                            </tr>
                    <?php
                    }else{
                    ?>
                        <tr><td colspan='4'>No hay puntuaciones disponibles</td></tr>
                    <?php
                    }
                    ?>
            </table>
        </main>
    </body>
</html>