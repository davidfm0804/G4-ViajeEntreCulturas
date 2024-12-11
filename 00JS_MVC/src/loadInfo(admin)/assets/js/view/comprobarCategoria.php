<?php
require_once '../modelos/configdb.php';

// Establecer conexión a la base de datos
$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die(json_encode(['error' => 'Conexión fallida: ' . $conexion->connect_error]));
}

// Obtener el nombre de la categoría desde la solicitud
$nombreCat = $_POST['nombreCat'] ?? '';

if (empty($nombreCat) || preg_match('/[^A-Za-záéíóúÁÉÍÓÚüÜ\s]/', $nombreCat)) {
    echo json_encode(['error' => 'El nombre de la categoría no es válido.']);
    exit;
}

// Verificar si la categoría ya existe en la base de datos
$sql = "SELECT nombreCat FROM categoria WHERE nombreCat = ?";
$stmt = $conexion->prepare($sql);

if ($stmt === false) {
    echo json_encode(['error' => 'Error al preparar la consulta.']);
    exit;
}

$stmt->bind_param("s", $nombreCat);
$stmt->execute();
$result = $stmt->get_result();

header('Content-Type: application/json');

if ($result->num_rows > 0) {
    echo json_encode(['existe' => true]);
} else {
    echo json_encode(['existe' => false]);
}

$stmt->close();
$conexion->close();
?>
