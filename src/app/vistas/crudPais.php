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
    <title>Configuración</title>
    <link rel="icon" href="../../img/mapa.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../css/estiloSilva.css">
</head>
<body>
    <header>
        <img src="../../img/logo.png" alt="Logo">
        <h1>Viaje entre Culturas</h1>
    </header>
    <main>
         <h2>Listado de países</h2>
         <a href="altaPais.php"><button id="altaPais">Alta país</button></a>

         <?php
            if ($resultados->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th class='cabecera'>Bandera</th>
                            <th class='cabecera'>Nombre</th>
                            <th class='cabecera'>Modificar</th>
                            <th class='cabecera'>Borrar</th>
                        </tr>";

                // Carpeta base donde se almacenan las imágenes
                $carpetaBase = '../../img/banderas/';


                while ($fila = $resultados->fetch_assoc()) {
                    $rutaImagen = $carpetaBase . $fila['bandera']; // Concatenamos la ruta relativa con la carpeta base
                    echo "<tr>
                            <td><img class='flag' src='" . $rutaImagen . "' alt='" . $fila['nombrePais'] . "'></td>
                            <td class='colNombre'>" . $fila['nombrePais'] . "</td>
                            <td><a href='modificarPais.php?nombrePais=" . $fila['nombrePais'] . "'>
                                <img class='png' src='../../img/modificar.png' alt='Modificar'>
                            </a></td>
                            <td><a href='borrarPais.php?nombrePais=" . urlencode($fila['nombrePais']) . "' 
                                onclick=\"return confirm('¿Estás seguro de que deseas eliminar este país?');\">
                                <img class='png' src='../../img/borrar.png' alt='Borrar'>
                            </a></td>
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "No se encontraron países.";
            }
        ?>                    
    </main>
    <script src="<?php echo JS.'00mainCrud.js';?>"></script>
</body>
</html>
