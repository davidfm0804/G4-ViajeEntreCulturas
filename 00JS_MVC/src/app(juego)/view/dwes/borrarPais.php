<?php
require_once '../controladores/Cpais.php';

if (isset($_GET['nombrePais']) && !empty($_GET['nombrePais'])) {
    $nombrePais = $_GET['nombrePais'];

    $objCpais = new Cpais();
    if ($objCpais->cEliminarPais($nombrePais)) {
       
        header("Location: crudPais.php?mensaje=eliminado");
        exit;
    } else {
      
        header("Location: crudPais.php?mensaje=error");
        exit;
    }
} else {
    
    header("Location: crudPais.php?mensaje=sinNombre");
    exit;
}
