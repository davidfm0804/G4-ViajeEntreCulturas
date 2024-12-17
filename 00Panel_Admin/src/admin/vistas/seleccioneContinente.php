<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viaje entre culturas</title>
    <link rel="icon" href="<?php echo IMG.'mapa.jpg';?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo CSS.'estiloSilva.css'; ?>">
</head>
<body>
    <header>
        <img src="<?php echo IMG.'logo.png';?>" alt="Logo">
        <h1>Viaje entre Culturas</h1>
    </header>
        <main>        
            <h2><?php echo $controlador->tituloPagina; ?></h2>
            <table>
                <tr>
                    <th class="cabecera">Nombre</th>
                    <th class="cabecera">Seleccionar</th>
                </tr>
                <?php
                if(count($dataToView["data"])>0){
                    foreach($dataToView["data"] as $continente){
                        ?>
                        <tr id="<?php echo $continente["idContinente"]; ?>">
                            <td class='colNombre'><?php echo $continente["nombreCont"]; ?></td> 
                            <td><button><img class='png' src="<?php echo IMG.'modificar.png';?>"></button></td>
                        </tr>
                        <?php
                    } 
                } else {
                    ?>
                    <tr><td colspan='4'>No hay continentes disponibles</td></tr>
                <?php
                }
                ?>
            </table>
        </main>
        <script src="<?php echo JS.'seleccioneContinente.js';?>"></script>
    </body>
</html>