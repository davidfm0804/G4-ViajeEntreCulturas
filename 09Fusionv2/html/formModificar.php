<?php
    if (isset($_GET['nombre']))
        $nombrePais = $_GET['nombre'];
    if (isset($_GET['id']))
        $idPais = $_GET['id'];
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar País</title>
    <link rel="icon" href="../src/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../src/css/estiloModificar.css">
</head>
<body>
    <header>
        <img src="../src/img/logo.png" alt="Logo">
        <h1>Viaje entre Culturas</h1>
    </header>
    <main>
        <div>
            <form>
                <div>
                    <label for="IntroducirPais">Nombre país:</label>
                    <input type="text" name="pais" value="<?php if(isset($nombrePais)) echo $nombrePais ?>">
                    <br><br>
                    <a href='../html/mapaModf.html' id="elcor" class="subirBtn">Elige Coordenadas</a>
                    <br><br>
                    
                    <label for="subirBandera" class="subirBtn">
                        Subir bandera
                        <input type="file" id="subirBandera" name="bandera">
                    </label>
                    <input type="hidden" name="coordX" id="coordX">
                    <input type="hidden" name="coordY" id="coordY">
                    <input type="hidden" name="idPais" value="<?php echo $idPais; ?>">
                </div>   
                    <button type="button" class="cancel">Cancelar</button>
                    <button type="button" class="update">Modificar</button>
            </form>
        </div>
    </main>
    <script src="../src/js/04validModif.js"></script>
</body>
</html>
