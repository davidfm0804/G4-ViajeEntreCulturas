<?php
// mostrarAltapais.php
require_once '../controladores/Cpais.php';

if (!empty($_POST['nombrePais']) && !empty($_FILES['bandera']['name']) && !empty($_POST['coordX']) && !empty($_POST['coordY'])) {
    $nombrePais = $_POST['nombrePais'];
    $coordX = $_POST['coordX'];
    $coordY = $_POST['coordY'];

    $directorioSubida = "../../img/banderas/"; 

    // Obtener solo el nombre original del archivo (sin prefijo generado)
    $nombreArchivo = basename($_FILES['bandera']['name']); 
    $rutaCompleta = $directorioSubida . $nombreArchivo; // Ruta completa donde se guardará la imagen

    // Mover la imagen desde el directorio temporal a la carpeta de destino
    if (move_uploaded_file($_FILES['bandera']['tmp_name'], $rutaCompleta)) {
        // Aquí almacenamos solo el nombre del archivo sin la ruta completa
        $nombreArchivoSinRuta = $nombreArchivo; 

        // Llamar al método para dar de alta el país, pasamos solo el nombre del archivo
        $objCpais = new Cpais();
        $resultado = $objCpais->cAltaPais($nombrePais, $nombreArchivoSinRuta, $coordX, $coordY);

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
