<?php
require_once('../../controladores/Ccontinente.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $objCcontinente = new Ccontinente();
    $resultado = $objCcontinente->cBorrarContinente($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/estiloCelia.css">
    <title>Borrado</title>
</head>
<body>
    <header>
            <img src="../../../img/logo.png" alt="Logo">
            <h1>Viaje entre Culturas</h1>
            <a href="#">PANEL ADMIN</a>
    </header>
    <main class="registro">
        <?php
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
    </main>
</body>
</html>