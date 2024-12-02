<?php
    if (isset($_GET['nombre']))
        $nombrePais = $_GET['nombre'];

    if (isset($_GET['id'])) {
        $idPais = $_GET['id'];
        
        // Conexión a la base de datos
        $conx = new mysqli('localhost', 'root', '', 'viajeentreculturas');
        
        // Verificar conexión
        if ($conx->connect_error)
            die("Conexión fallida");
        
        // SELECT | Obtener Datos País
        $sql = "SELECT nombrePais, bandera, coordX, coordY FROM paises WHERE codPais = ?";
        $conxPrp = $conx->prepare($sql);
        $conxPrp->bind_param("i", $idPais);
        $conxPrp->execute();
        
        // Bind_Result | Estructur Datos Obtenidos
        $conxPrp->bind_result($nombrePais,$bandera, $coordX, $coordY);

        // Fetxh | Asocia Datos a Estructura Definida
        $conxPrp->fetch();
        $conxPrp->close();
    }
    
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar País</title>
    <link rel="icon" href="../src/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../src/css/estiloModificarPaises.css">
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
                    <input type="text" name="pais" value="<?php echo $nombrePais; ?>">
                    <br><br>
                    <a href='../html/mapaModf.html' id="elcor" class="subirBtn">Elige Coordenadas</a>
                    <br><br>
                    <label for="banderaActual">Bandera actual:</label>
                    <img width="25%" src="<?php echo '../src/img/'.$bandera; ?>" alt="Bandera de <?php echo $nombrePais; ?>" id="banderaActual">
                    <br><br>
                    <label for="subirBandera" class="subirBtn">
                        Subir nueva bandera
                        <input type="file" id="subirBandera" name="bandera">
                    </label>
                    <input type="hidden" name="banderaActual" value="<?php echo $bandera; ?>">
                    <input type="hidden" name="coordX" id="coordX" value="<?php echo $coordX; ?>">
                    <input type="hidden" name="coordY" id="coordY" value="<?php echo $coordY; ?>">
                    <input type="hidden" name="idPais" value="<?php echo $idPais; ?>">
                </div>   
                    <button type="button" class="cancel">Cancelar</button>
                    <button type="button" class="update">Modificar</button>
            </form>
        </div>
    </main>
    <script>
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const scriptToLoad = getQueryParam('script');
            const script = document.createElement('script');
            script.src = scriptToLoad === '04validModifv2.js' ? '../src/js/04validModifv2.js' : '../src/js/04validModif.js';
            script.defer = true; // Asegura que el script se ejecute después de que el documento esté completamente cargado
            document.body.appendChild(script);
        });

    </script>
</body>
</html>
