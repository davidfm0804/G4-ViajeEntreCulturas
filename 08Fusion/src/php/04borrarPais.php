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
    $sql = "DELETE FROM pais WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        // json_encode || Valor php -> Formato JSON
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }
    $stmt->close();

$conn->close();
?>