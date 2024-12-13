<?php
// mostrarAltapais.php
require_once '../controladores/Cpais.php';

if (!empty($_POST['nombrePais']) && !empty($_FILES['bandera']['name']) && !empty($_POST['coordX']) && !empty($_POST['coordY'])) {
    $nombrePais = $_POST['nombrePais'];
    $coordX = $_POST['coordX'];
    $coordY = $_POST['coordY'];


    $directorioSubida = "../../img/"; 

    $nombreArchivo = uniqid() . "_" . basename($_FILES['bandera']['name']); 
    $rutaCompleta = $directorioSubida . $nombreArchivo;

    if (move_uploaded_file($_FILES['bandera']['tmp_name'], $rutaCompleta)) {

        $rutaRelativa = "img/" . $nombreArchivo; 

        
        $objCpais = new Cpais();
        $resultado = $objCpais->cAltaPais($nombrePais, $rutaRelativa, $coordX, $coordY);

        if ($resultado) {
            header('Location: altaPais.php?msj=Inserción Correcta');
        } else {
            header('Location: altaPais.php?msj=Error en la Inserción');
        }
    } else {
        header('Location: altaPais.php?msj=Error al mover la imagen de la bandera');
    }
} else {
    header('Location: altaPais.php?msj=Campos obligatorios de poner');
}
?>