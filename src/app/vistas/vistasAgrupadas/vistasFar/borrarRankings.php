<?php
require_once('../controladores/Cranking.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $objCranking = new Cranking();
    $resultado = $objCranking->cBorrarPuntuacion($id);
    if($resultado){
        echo "Borrado Correcto";
    }else{
        echo "Error en el Borrado";
    }
    echo " <a href='elegirContinente.php'>
        <button>Volver</button>
    </a>";
}else{
    echo "Error el id no existe";
}
?>