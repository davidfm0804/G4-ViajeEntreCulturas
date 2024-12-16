<?php
    require_once('../controladores/Cranking.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <link rel="icon" href="../../assets/img/mapa.jpg" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo CSS."estiloRanking.css";?>">
</head>
<body>
    <header>
        <img src="../../assets/img/logo.png" alt="Logo">
        <h1>Viaje entre Culturas</h1>
            <a href="#">PANEL ADMIN</a>
    </header>
    <?php
     if (isset($_GET['borrado']) && $_GET['borrado'] == 'true') {
        echo "<p class='mensaje-exito'>¡Las puntuaciones se han borrado correctamente!</p>";
    }else{
     if (isset($_POST['idContinente'])) {
        $idContinente = $_POST['idContinente'];
        $objCranking = new Cranking();
        $resultado = $objCranking->cMostrarPuntuacion($idContinente);
     
       if ($resultado->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr>
                <th>Nombre</th>
                <th>Puntos</th>
                <th>Número de Fallos</th>
                <th>Tiempo</th>
              </tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>".$fila['nombre']."</td>
                    <td>".$fila['puntos']."</td>
                    <td>".$fila['numFallos']."</td>
                    <td>".$fila['tiempo']."</td>
                  </tr>";
        }
        echo "</table>";
        echo "<div class='center-buttons'><a href='borrarRankings.php?id=".$idContinente."'><button>Borrar</button></a></div>";
        } else {
            echo "No hay puntuaciones para este continente.";
        }
    } else {
        echo "No hay puntuaciones para este continente.";
    }}
    echo "<div class='center-buttons'><a href='elegirContinente.php'><button>Volver</button></a></div>";
    ?>
 <script src="<?php echo JS."verRanking.js";?>"></script>
</body>
</html>
