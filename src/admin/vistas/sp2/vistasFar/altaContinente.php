<?php
require_once('../controladores/Ccontinente.php');

// Comprobar si el formulario fue enviado
if (!empty($_POST['nombreContinente'])) {
    $nombre = $_POST['nombreContinente'];

    $objCcontinente = new Ccontinente();
    $resultado = $objCcontinente->cInsertarContinente($nombre);
    echo $resultado;
} else {
    echo "Campo Nombre no introducido";
}
?>
<a href='formAltaContinente.php'>
    <button>Dar Alta Continente</button>
</a>
