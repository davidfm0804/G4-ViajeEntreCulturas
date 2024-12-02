<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ViajeEntreCulturas";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pais = $_POST['pais'];
    $coordX = $_POST['coordX'];
    $coordY = $_POST['coordY'];
    $idPais = $_POST['idPais'];

    $sql = "UPDATE paises SET nombrePais='$pais'";

    if (!empty($coordX) && !empty($coordY)) {
        $sql .= ", coordX='$coordX', coordY='$coordY'";
    }

    if (isset($_FILES['imgBandera']) && $_FILES['imgBandera']['error'] === UPLOAD_ERR_OK) {
        $imgBandera = $_FILES['imgBandera']['name'];
        $imgBanderaTmp = $_FILES['imgBandera']['tmp_name'];
        $imgBanderaPath = '../img/' . basename($imgBandera);

        if (move_uploaded_file($imgBanderaTmp, $imgBanderaPath)) {
            $sql .= ", bandera='$imgBanderaPath'";
        } else {
            echo "Error al subir la imagen.";
            exit;
        }
    }

    $sql .= " WHERE codPais='$idPais'";

    if ($conn->query($sql) === TRUE) {
        echo "País modificado correctamente.";
    } else {
        echo "Error al modificar el país: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>