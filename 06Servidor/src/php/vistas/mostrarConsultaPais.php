<?php
require_once '../controladores/Cpais.php';

$objCpais = new Cpais();

if (isset($_POST['paisConsulta']) && !empty($_POST['paisConsulta'])) {
    $paisConsulta = $_POST['paisConsulta'];
    
    $resultados = $objCpais->cObtenerPaisPorNombre($paisConsulta);
} else {

    $resultados = $objCpais->cObtenerPaises();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Países</title>
    <link rel="stylesheet" href="../src/css/reset.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>
<body>
    <header>

    </header>
    <nav>
 
    </nav>
    <main>
        <div>
            <h1>Lista de Países</h1><br/>

            <?php
            if ($resultados->num_rows > 0) {

                echo "<table border='1'>
                        <tr>
                            <th>Nombre País</th>
                            <th>Bandera</th>
                            <th>Coordenada X</th>
                            <th>Coordenada Y</th>
                        </tr>";

                while ($fila = $resultados->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $fila['nombrePais'] . "</td>
                            <td><img src='" . $fila['bandera'] . "' alt='Bandera' width='50'></td>
                            <td>" . $fila['coordX'] . "</td>
                            <td>" . $fila['coordY'] . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron países con ese nombre.";
            }
            ?>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>
