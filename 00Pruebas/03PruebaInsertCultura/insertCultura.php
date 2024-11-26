<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pais = $_POST['pais'];
        $descripcion = $_POST['descrip'];
        $coordX = $_POST['coordX'];
        $coordY = $_POST['coordY'];
        echo "<h2>Datos recibidos:</h2>";
        echo "País: $pais<br>";
        echo "Descripción: $descripcion<br>";
        echo "Coordenada X: $coordX<br>";
        echo "Coordenada Y: $coordY<br>";
    }
?>