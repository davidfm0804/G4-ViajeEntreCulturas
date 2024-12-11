<?php
        require_once '../modelos/configdb.php';
        $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
        $conexion->set_charset("utf8");

        if ( $conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        $nombreContinente = $_POST["nombreContinente"];

$sql = "SELECT nombreCont FROM continente WHERE nombreCont = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $nombreContinente); // 's' indica que es una cadena de texto
$stmt->execute();
$result = $stmt->get_result();

header('Content-Type: application/json');
// Verificamos si el continente ya existe
if ($result->num_rows > 0) {
    echo json_encode(['existe' => true]);
} else {
    echo json_encode(['existe' => false]);
}

$stmt->close();
$conexion->close();
?>