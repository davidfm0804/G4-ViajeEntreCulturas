<?php
        require_once '../modelos/configdb.php';
        $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
        $conexion->set_charset("utf8");

        if ( $conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        $nombreContinente = $_POST["nombreContinente"];
        $idContinente = $_POST["id"];

$sql = "SELECT nombreCont FROM continente WHERE idContinente = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idContinente); // 's' indica que es una cadena de texto
$stmt->execute();
$result = $stmt->get_result();

$continenteActual = $result->fetch_assoc();

header('Content-Type: application/json');
// Verificamos si el continente ya existe
if ($continenteActual['nombreCont'] === $nombreContinente) {
    echo json_encode(['existe' => true]);
} else {
    echo json_encode(['existe' => false]);
}

$stmt->close();
$conexion->close();
?>