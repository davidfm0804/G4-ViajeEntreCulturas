<?php
require_once('../controladores/Cranking.php');

if (isset($_GET['id'])) {
    $idContinente = $_GET['id'];
    $objCranking = new Cranking();
    $objCranking->cBorrarPuntuacion($idContinente);
    
    header("Location: VerRanking.php?idContinente=$idContinente&borrado=true");
    exit();
}
?>
