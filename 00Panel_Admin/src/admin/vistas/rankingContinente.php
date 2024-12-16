<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <link rel="icon" href="<?php echo IMG.'mapa.jpg'?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo CSS."estiloRanking.css";?>">
</head>
<body>
    <header>
        <img src="<?php echo IMG.'logo.png'?>" alt="Logo">
        <h1>Viaje entre Culturas</h1>
            <a href="#">PANEL ADMIN</a>
    </header>
     <input id="idContinente" type="hidden" value="<?php echo $_GET['idContinente'];?>">
    <?php
   
     if (isset($_GET['idContinente'])) {
        if(count($dataToView["data"])>0) {
        echo "<table border='1'>";
        echo "<tr>
                <th>Nombre</th>
                <th>Puntos</th>
                <th>Número de Fallos</th>
                <th>Tiempo</th>
              </tr>";
        foreach($dataToView["data"] as $fila) {
            echo "<tr>
                    <td>".$fila['nombre']."</td>
                    <td>".$fila['puntos']."</td>
                    <td>".$fila['numFallos']."</td>
                    <td>".$fila['tiempo']."</td>
                  </tr>";
        }
        echo "</table>";
        echo "<div class='center-buttons'><button id='borrar'>Borrar</button></a></div>";
        } else {
            echo "No hay puntuaciones para este continente.";
        }
    } else {
        echo "No hay puntuaciones para este continente.";
    }
    echo "<div class='center-buttons'><a href='index.php?controlador=MenuPrincipal&accion=cRankingSelecContinente'><button>Volver</button></a></div>";
    ?>
 <script src="<?php echo JS."verRanking.js";?>"></script>
</body>
</html>
