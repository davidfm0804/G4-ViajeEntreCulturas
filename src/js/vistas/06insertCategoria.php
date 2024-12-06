<?php
include 'config¡f.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreCatg = $_POST['nombreCatg'];

    $sql = "INSERT INTO categorias (nombreCatg) VALUES ('$nombreCatg')";

    if ($conn->query($sql) === TRUE) {
        echo "Categoría agregada con éxito. ID de la categoría: " . $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
