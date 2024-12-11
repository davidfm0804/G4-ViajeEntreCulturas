<?php
    require_once('../controladores/Cranking.php');
    $objCranking = new Cranking();
    $resultado = $objCranking->cMostrarContinente();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elige Continente</title>
</head>
<body>
    <form action="verRanking.php" method="POST">
        <label for="EligeContinente">Elige Continente: </label>
        <select name="idContinente" id="EligeContinente">
        <option value="" disabled selected>Selecciona un continente</option>
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
