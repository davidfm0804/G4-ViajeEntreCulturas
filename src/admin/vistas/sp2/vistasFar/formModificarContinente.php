<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/estiloCelia.css">
    <title>Modificar Continente</title>
</head>
<body>
    <header>
            <img src="../../../img/logo.png" alt="Logo">
            <h1>Viaje entre Culturas</h1>
            <a href="#">PANEL ADMIN</a>
    </header>
    <main>
        <?php
            $idContinente = $_GET['id'];
            if (isset($_GET['id'])) {
        ?>
            <form action="modificarContinente.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <input type="text" name="nombreContinente" id="nombreContinente" placeholder="Nombre Continente">
                <br><br>
                <input type="submit" value="Modificar">
            </form>
        <?php
            } else {
                echo "ID no válido.";
            }
        ?>
        <br>
        <a href='listadoContinentes.php'>
            <button>Volver Inicio</button>
        </a>
    </main>
    <script type="text/javascript">
    var idContinente = "<?php echo $idContinente;?>";
    </script>
</body>
<script src="validModifCont.js"></script>
</html>
