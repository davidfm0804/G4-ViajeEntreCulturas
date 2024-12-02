<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ViajeEntreCulturas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pais = $_POST['pais'];
    $coordX = $_POST['coordX'];
    $coordY = $_POST['coordY'];
    $idPais = $_POST['idPais'];

    // Verificar el valor de idPais
    error_log("ID del País recibido: " . $idPais);

    $imgBandera = $_FILES['imgBandera']['name'];
    $imgBanderaTmp = $_FILES['imgBandera']['tmp_name'];
    $imgBanderaPath = '../img/' . basename($imgBandera);

    if (!move_uploaded_file($imgBanderaTmp, $imgBanderaPath)) {
        echo "Error al subir la imagen.";
    }

    // Arreglo ID [Última Opción]
    
    $posPunto = strpos($idPais, '.');
    
    if ($posPunto !== false) {
        $id = substr($idPais, 0, $posPunto);
    }
    
    
    function console_log_php($message) {
        $js_message = json_encode($message);

        echo "<script>console.log({$js_message},'hola');</script>";
    }

    console_log_php($id);


    $sql = "UPDATE pais SET nombrePais='$pais', coordX='$coordX', coordY='$coordY', bandera='$imgBanderaPath' WHERE codPais='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "País modificado correctamente.";
        header("Location: ./mainCrud.php");
        exit();
    } else {
        echo "Error al modificar el país: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>