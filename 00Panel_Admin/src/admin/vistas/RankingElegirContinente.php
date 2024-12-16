<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elige Continente</title>
    <link rel="stylesheet" href="<?php echo CSS."estiloRanking.css";?>">

    <link rel="icon" href="<?php echo IMG."logo.png";?>" type="image/x-icon">
</head>
<body>
    <header>
        <img src="<?php echo IMG."logo.png";?>" alt="Logo">
        <h1>Viaje entre Culturas</h1>
            <a href="index.php">PANEL ADMIN</a>
    </header>
    <form>
        <label for="EligeContinente">Elige Continente: </label>
        <select name="idContinente" id="EligeContinente">
        <option value="" disabled selected>Selecciona un continente</option>
            <?php
              if(count($dataToView["data"])>0){
                foreach($dataToView["data"] as $continente){
                    echo "<option value='".$continente['idContinente']."'>
                    ".$continente['nombreCont']."
                  </option>";
                }}
            ?>
        </select>
        <button id="verRanking">Ver Ranking</button>
    </form>
    <script src="<?php echo JS."elegirContinente.js";?>"></script>
</body>
</html>
