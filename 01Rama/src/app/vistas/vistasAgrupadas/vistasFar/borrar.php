<?php
require_once('../controladores/Ccontinente.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $objCcontinente = new Ccontinente();
    $resultado = $objCcontinente->cBorrarContinente($id);
    if($resultado){
        echo "Borrado Correcto";
    }else{
        echo "Error en el Borrado";
    }
    echo " <a href='listadoContinentes.php'>
        <button>Volver</button>
    </a>";
}else{
    echo "Error el id no existe";
}
?>