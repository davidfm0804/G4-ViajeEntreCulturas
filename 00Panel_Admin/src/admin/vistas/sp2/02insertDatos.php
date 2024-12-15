<?php
//Prueba -> Celia
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

$imgBandera = $_FILES['imgBandera']['name'];
$imgBanderaTmp = $_FILES['imgBandera']['tmp_name'];
$imgBanderaPath = '../img/' . basename($imgBandera);

if (!move_uploaded_file($imgBanderaTmp, $imgBanderaPath)) {
    echo "Error al subir la imagen.";
}

// Preparar
$stmt = $conn->prepare("INSERT INTO paises (nombrePais, bandera, coordX, coordY) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssdd", $nombrePais, $imgBanderaPath, $coordX, $coordY);

// Ejecutar
$stmt->execute();

echo "Nuevo registro creado exitosamente";

$stmt->close();
$conn->close();
?>
