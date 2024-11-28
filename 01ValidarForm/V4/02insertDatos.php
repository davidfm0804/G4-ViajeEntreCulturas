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

// Establecer parámetros
$nombrePais = $_POST['pais'];
$coordX = $_POST['coordX'];
$coordY = $_POST['coordY'];

// Preparar y enlazar
$stmt = $conn->prepare("INSERT INTO pais (nombrePais, coordX, coordY) VALUES ('".$nombrePais."', ".$coordX.", ".$coordY.")");

// ejecutar
$stmt->execute();

echo "Nuevo registro creado exitosamente";

$stmt->close();
$conn->close();
?>
