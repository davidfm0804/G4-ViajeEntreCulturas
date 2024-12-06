<?php
// mostrarAltaCategoria.php
require_once '../controladores/Ccategoria.php';

if (!empty($_POST['nombreCat'])) {
    $nombreCat = $_POST['nombreCat'];

    $objCcategoria = new Ccategoria();
    $resultado = $objCcategoria->cAltaCategoria($nombreCat);

    if ($resultado) {
        header('Location: altaCategoria.php?msj=Inserción Correcta');
    } else {
        header('Location: altaCategoria.php?msj=Error en la Inserción');
    }
} else {
    header('Location: altaCategoria.php?msj=El campo Nombre de la Categoría es obligatorio');
}
?>
