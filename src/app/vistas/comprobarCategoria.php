<?php
require_once '../modelos/configdb.php';

header('Content-Type: application/json');

// Establecer conexión a la base de datos
$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    echo json_encode(['error' => 'Conexión fallida: ' . $conexion->connect_error]);
    exit;
}

// Obtener el nombre de la categoría desde la solicitud
$nombreCat = $_POST['nombreCat'] ?? '';

$palabrasOfensivas = ["ofensivo", "inapropiado", "insulto"];

// Validaciones
if (empty($nombreCat) || strlen($nombreCat) < 3 || preg_match('/[^A-Za-záéíóúÁÉÍÓÚüÜ\s]/', $nombreCat)) {
    echo json_encode(['error' => 'El nombre de la categoría debe contener solo letras y espacios, y tener al menos 3 caracteres.']);
    exit;
}

foreach ($palabrasOfensivas as $palabra) {
    if (stripos($nombreCat, $palabra) !== false) { // Verifica palabras ofensivas
        echo json_encode(['error' => 'El nombre contiene palabras no permitidas.']);
        exit;
    }
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

if ($result === false) {
    echo json_encode(['error' => 'Error al ejecutar la consulta.']);
} elseif ($result->num_rows > 0) {
    echo json_encode(['existe' => true]);
} else {
    echo json_encode(['existe' => false]);
}

$stmt->close();
$conexion->close();
