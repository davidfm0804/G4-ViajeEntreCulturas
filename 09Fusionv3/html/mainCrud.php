<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Prueba - Celia -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
    <link rel="icon" href="../src/img/mapa.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../src/css/estiloSilva.css">
</head>
<body>
    <header>
        <img src="../src/img/logo.png" alt="Logo">
        <h1>Viaje entre Culturas</h1>
    </header>
    <main>        
         <h2>Listado de países</h2>
         <button id="altaPais">Alta país</button>
         <table>
            <tr>
                <th class="cabecera">Bandera</th>
                <th class="cabecera">Nombre</th>
                <th class="cabecera">Modificar</th>
                <th class="cabecera">Borrar</th>
            </tr>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ViajeEntreCulturas";

            // Crear conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $sql = "SELECT codPais, nombrePais, bandera FROM pais";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($fila = $result->fetch_assoc()) {
                    echo "<tr id='".$fila['codPais']."'>";
                    echo "<td><img class='flag' src='../src/img/".$fila['bandera']."' alt='".$fila['nombrePais']."'></td>";
                    echo "<td class='colNombre'>".$fila['nombrePais']."</td>";
                    echo "<td><button><img class='png' src='../src/img/modificar.png'></button></td>";
                    echo "<td><button><img class='png' src='../src/img/borrar.png'></button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay países disponibles</td></tr>";
            }

            $conn->close();
            ?>
         </table>
    </main>
    <script src="../src/js/00mainCrud.js"></script>
</body>
</html>