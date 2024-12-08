<?php
    require_once('../controladores/Ccontinente.php');
    $objCcontinente = new Ccontinente();
    $resultado = $objCcontinente->cMostrarContinente();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Continentes</title>
</head>
<body>
    <table>
        <tr>
            <th>Continente</th>
            <th>Modificar</th>
            <th>Borrar</th>
        </tr>
        <?php
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                    <td>" .$fila['nombreCont']. "</td>
                    <td><a href='formModificarContinente.php?id=" . $fila['idContinente'] . "'>Modificar</a></td>
                    <td><a href='borrar.php?id=" . $fila['idContinente'] . "'>Borrar</a></td>
                  </tr>";
            }
        ?>
    </table>
    <a href="formAltaContinente.php">
        <button>Dar Alta Continente</button>
    </a>
</body>
</html>