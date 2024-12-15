<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo IMG.'mapa.jpg'?>" type="image/x-icon">
        <title>Memory Game</title>
        
        <link rel="stylesheet" href="<?php echo CSS.'estiloCeliaJuego.css'?>">
    </head>
    <body>
        <header>
            <img src="<?php echo IMG.'logo.png'?>" alt="Logo">
            <h1>Viaje entre Culturas</h1>
        </header>
        <main class="registro">
            <h2>¿En qué continente te gustaría poner a prueba tus conocimientos?</h2>
            <select name="continente">
                <option disabled selected>Selección Continente</option>
                <?php
                    if(count($dataToView["data"]) > 0){
                        foreach($dataToView["data"] as $cont){
                            ?>
                            <option value="<?php echo $cont["idContinente"]; ?>"><?php echo $cont["nombreCont"]; ?></option>
                            <?php
                        }
                    }
                ?>
            </select>
            <button type='reset'>BORRAR</button>
            <button type='submit'>¡A JUGAR!</button>
        </main>
        <script src='<?php echo JS.'00FunBienv.js'?>'></script>
    </body>
</html>