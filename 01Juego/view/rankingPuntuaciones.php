<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo IMG.'mapa.jpg'; ?>" type="image/x-icon">
        <title>Memory Game Ranking</title>
        
        <link rel="stylesheet" href="<?php echo CSS.'estiloCeliaJuego.css'; ?>">
    </head>
    <body>
        <header>
            <img src="<?php echo IMG.'logo.png'; ?>" alt="Logo">
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
                    if(count($dataToView["data"]) > 0){
                        $posicion = 1;
                        foreach($dataToView["data"] as $punt){
                            ?>
                            <tr id="<?php echo $punt["idPuntuacion"]; ?>">
                                <td><?php echo $posicion++; ?></td>
                                <td><?php echo $punt["nombre"]; ?></td>
                                <td><?php echo $punt["puntos"]; ?></td>
                                <td><?php echo $punt["tiempo"]; ?></td>
                                <td><?php echo $punt["numFallos"]; ?></td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="5">No hay puntuaciones</td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
            <button type="button">¡Mejora Tu Marca!</button>
            <button type="reset">Reiniciar Juego [Diferentes Cartas]</button>
        </main>
        <script src="<?php echo JS.'04FunRankPunt.js'?>"></script>
    </body>
</html>