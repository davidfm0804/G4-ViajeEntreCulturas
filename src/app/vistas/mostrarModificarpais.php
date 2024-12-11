<?php
require_once '../modelos/Mpais.php';
require_once '../controladores/Cpais.php';

if (!empty($_POST['nombrePais']) && !empty($_POST['coordX']) && !empty($_POST['coordY'])) {
    $nombrePais = $_POST['nombrePais']; 
    $nuevoNombrePais = $_POST['nuevoNombrePais']; 
    $coordX = $_POST['coordX'];
    $coordY = $_POST['coordY'];

    // Verificamos si se ha subido una nueva bandera
    if (isset($_FILES['bandera']) && $_FILES['bandera']['error'] === UPLOAD_ERR_OK) {
        $directorioSubida = "../../img/banderas/";

        // Usamos el nombre original del archivo
        $nombreArchivo = basename($_FILES['bandera']['name']); // Obtiene el nombre original
        $rutaCompleta = $directorioSubida . $nombreArchivo;

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES['bandera']['tmp_name'], $rutaCompleta)) {
            // Guardamos solo el nombre del archivo (sin la ruta completa)
            $bandera = $nombreArchivo;
        } else {
            header('Location: modificarPais.php?msj=Error al subir la bandera');
            exit;
        }
    } else {
        // Si no se subió una nueva bandera, mantenemos la bandera actual
        // Aquí asumimos que ya tienes un método para obtener la bandera actual
        $objCpais = new Cpais();
        $paisExistente = $objCpais->cObtenerPaisPorNombre($nombrePais);

        if ($paisExistente && $paisExistente->num_rows > 0) {
            $pais = $paisExistente->fetch_assoc();
            $bandera = $pais['bandera']; // Mantenemos la bandera actual
        } else {
            header('Location: modificarPais.php?msj=El país no existe');
            exit;
        }
    }

    // Ahora realizamos la modificación con la nueva bandera (o la bandera actual si no se subió una nueva)
    $objCpais = new Cpais();
    if ($objCpais->cModificarPais($nombrePais, $nuevoNombrePais, $bandera, $coordX, $coordY)) {
        header('Location: modificarPais.php?msj=País modificado correctamente');
    } else {
        header('Location: modificarPais.php?msj=Error en la modificación');
    }
} else {
    header('Location: modificarPais.php?msj=Todos los campos son obligatorios');
}
?>
