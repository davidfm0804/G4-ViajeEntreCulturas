<?php
require_once '../modelos/Mpais.php';
require_once '../controladores/Cpais.php';

if (!empty($_POST['nombrePais']) && !empty($_POST['coordX']) && !empty($_POST['coordY']) && isset($_FILES['bandera'])) {
    $nombrePais = $_POST['nombrePais']; 
    $nuevoNombrePais = $_POST['nuevoNombrePais']; 
    $coordX = $_POST['coordX'];
    $coordY = $_POST['coordY'];

    $directorioSubida = "../../img/banderas/";
    $nombreArchivo = uniqid() . "_" . basename($_FILES['bandera']['name']);
    $rutaCompleta = $directorioSubida . $nombreArchivo;

    if (move_uploaded_file($_FILES['bandera']['tmp_name'], $rutaCompleta)) {
        $bandera = "img/banderas/" . $nombreArchivo;

        $objCpais = new Cpais();
        if ($objCpais->cModificarPais($nombrePais, $nuevoNombrePais, $bandera, $coordX, $coordY)) {
            header('Location: modificarPais.php?msj=País modificado correctamente');
        } else {
            header('Location: modificarPais.php?msj=Error en la modificación');
        }
    } else {
        header('Location: modificarPais.php?msj=Error al subir la bandera');
    }
} else {
    header('Location: modificarPais.php?msj=Todos los campos son obligatorios');
}
?>
