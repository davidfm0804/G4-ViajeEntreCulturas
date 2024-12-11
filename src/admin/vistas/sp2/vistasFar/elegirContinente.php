<?php
    require_once('../../controladores/Cranking.php');
    $objCranking = new Cranking();
    $resultado = $objCranking->cMostrarContinente();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/estiloCelia.css">
    <title>Elige Continente</title>
</head>
<body>
    <header>
            <img src="../../../img/logo.png" alt="Logo">
            <h1>Viaje entre Culturas</h1>
            <a href="#">PANEL ADMIN</a>
    </header>
    <form action="verRanking.php" method="POST">
        <select name="idContinente" id="EligeContinente">
        <option value="" disabled selected>Selecciona Continente</option>
            <?php
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<option value='".$fila['idContinente']."'>
                    ".$fila['nombreCont']."
                  </option>";
                }
            ?>
        </select>
        <input type="submit"value="Ver Ranking">
    </form>
</body>
</html>
