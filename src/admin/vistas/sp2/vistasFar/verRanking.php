<?php
    require_once('../../controladores/Cranking.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/estiloCelia.css">
    <title>Ranking</title>
</head>
<body>
    <header>
        <img src="../../../img/logo.png" alt="Logo">
            <h1>Viaje entre Culturas</h1>
            <a href="#">PANEL ADMIN</a>
    </header>
    <main class="registro">
        
    <?php
     if (isset($_POST['idContinente'])) {
        $idContinente = $_POST['idContinente'];
        $objCranking = new Cranking();
        $resultado = $objCranking->cMostrarPuntuacion($idContinente);
     
       if ($resultado->num_rows > 0) {
        echo "<h2>Ranking</h2>";
        echo "<table>";
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
        echo"</main>";
        echo "<a href='borrarRankings.php?id=".$idContinente."'><button>Borrar</button></a>";
        }else {
            echo "</br><p>No hay puntuaciones para este continente.</p>";
        }
    } else {
        echo "No hay puntuaciones para este continente.";
    }
    ?>
    <a href='elegirContinente.php'>
        <button>    Volver</button>
    </a>
</body>
</html>