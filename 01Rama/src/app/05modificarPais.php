<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ViajeEntreCulturas";

// Create connection
$conx = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conx->connect_error)
    die("Fallo Conexión");

    $pais = $_POST['pais'];
    $coordX = $_POST['coordX'];
    $coordY = $_POST['coordY'];
    $idPais = $_POST['idPais'];

    // Comprobar | IMG = FILE ? SRC
    if(isset($_FILES['imgBandera']) && is_uploaded_file($_FILES['imgBandera']['tmp_name'])){
        $imgBandera = $_FILES['imgBandera']['name'] ? $_FILES['imgBandera']['name'] : $_POST['imgBandera'];
        $imgBanderaTmp = $_FILES['imgBandera']['tmp_name'];
        $bandera = '../img/' . basename($imgBandera);
        // Mover IMG a Directorio
        if (!move_uploaded_file($imgBanderaTmp, $bandera))
            die("Error al subir la imagen");
    } else 
        $bandera = basename($_POST['imgBandera']);

    $sql = "UPDATE paises SET nombrePais = ?, coordX = ?, coordY = ?, bandera = ? WHERE codPais = ?";
    $conxPrp = $conx->prepare($sql);
    $conxPrp->bind_param("sddss", $pais, $coordX, $coordY, basename($imgBandera), $idPais);
    if($conxPrp->execute()) {
        echo "País modificado correctamente.";
        header("Location: ./mainCrud.php");
    }else{
        echo "País modificado correctamente.";
        header("Location: ./mainCrud.php");
    }
        

    $conx->close();

?>