<?php
    require_once '../controladores/Cpais.php';

    if (!empty( $_GET['nombrePais'])) {
        $nombrePais = $_GET['nombrePais'];

        $objCpais = new Cpais();
        $resultado = $objCpais->cEliminarPais($nombrePais);

        if ($resultado) {
            header('Location: eliminarPais.php?msj=Eliminación Correcta');
        } else {
            header('Location: eliminarPais.php?msj=Error en la Eliminación');
        }
    } else {
        header('Location: eliminarPais.php?msj=Debe rellenar el campo');
    }
?>