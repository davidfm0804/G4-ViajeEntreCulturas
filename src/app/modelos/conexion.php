<?php
    require_once 'configDb.php'; //Archivo de configuración

    $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
    $controlador = new mysqli_driver();//Desactivar errores
    $controlador->report_mode = MYSQLI_REPORT_OFF;//Desactivar errores
    $texto_error=$conexion->errno;
?>


