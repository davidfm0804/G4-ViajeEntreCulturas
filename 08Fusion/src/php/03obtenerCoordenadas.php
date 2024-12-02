<!-- Prueba -> Celia -->
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

$sql = "SELECT coordX, coordY FROM pais";
$result = $conn->query($sql);

$coordenadas = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $coordenadas[] = $row;
    }
}


echo json_encode($coordenadas);

$conn->close();
?>