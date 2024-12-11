<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/estiloCelia.css">
    <title>Alta Continente</title>
</head>
<body>
    <header>
            <img src="../../../img/logo.png" alt="Logo">
            <h1>Viaje entre Culturas</h1>
            <a href="#">PANEL ADMIN</a>
    </header>
    <main class="registro">
    <h2>Alta Continente</h2>
    <form action="altaContinente.php" method="POST">
        <input type="text" name="nombreContinente"> 
        <input type="submit" value="Dar Alta"></br></br>
    </form>
    </main>
    <a href='listadoContinentes.php'>
        <button>Volver Inicio</button>
    </a>
</body>
<script src="validAltaCont.js"></script>
</html>