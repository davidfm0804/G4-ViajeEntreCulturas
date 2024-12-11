<?php
    require_once('../../controladores/Ccontinente.php');
    $objCcontinente = new Ccontinente();
    $resultado = $objCcontinente->cMostrarContinente();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/estiloCelia.css">
    <title>Continentes</title>
</head>
<body>
    <header>
            <img src="../../../img/logo.png" alt="Logo">
            <h1>Viaje entre Culturas</h1>
            <a href="#">PANEL ADMIN</a>
        </header>
        <main>
            <h2>Listado continentes</h2>
            <button><a href="formAltaContinente.php">alta continente</a></button>
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
                    <td class='borrar'><a href='borrar.php?id=" . $fila['idContinente'] . "'>Borrar</a></td>
                  </tr>";
            }
        ?>
    </table>
</body>
<script src="validBorrar.js"></script>
</html>