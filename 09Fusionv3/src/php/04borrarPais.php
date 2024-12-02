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

    $id = $_POST['id'];
    $sql = "DELETE FROM pais WHERE codPais = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Registro eliminado correctamente";
    } else {
        echo "Error al eliminar el registro: ";
    }
    $stmt->close();

$conn->close();
?>