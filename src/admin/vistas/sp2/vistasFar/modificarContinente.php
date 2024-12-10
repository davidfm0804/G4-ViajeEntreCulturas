<?php
require_once('../controladores/Ccontinente.php');

if (isset($_POST['id']) && !empty($_POST['nombreContinente'])) {
    $id = $_POST['id']; 
    $nombreCont = $_POST['nombreContinente']; 
    $objCcontinente = new Ccontinente();
    $resultado = $objCcontinente->cModificarContinente($nombreCont, $id);
    echo $resultado;
} else {
    echo "Algún dato está vacío o no válido.";
}
echo"<a href='listadoContinentes.php'>
    <button>Volver al Inicio</button>
</a>";
?>

