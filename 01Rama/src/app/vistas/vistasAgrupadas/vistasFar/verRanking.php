<?php
    require_once('../controladores/Cranking.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
</head>
<body>
    <?php
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
        echo "<a href='borrarRankings.php?id=".$idContinente."'><button>Borrar</button></a>";
        }else {
            echo "No hay puntuaciones para este continente.";
        }
    } else {
        echo "No hay puntuaciones para este continente.";
    }
    echo " <a href='elegirContinente.php'>
        <button>Volver</button>
    </a>";
    ?>

</body>
</html>