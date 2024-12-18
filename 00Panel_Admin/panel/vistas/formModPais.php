<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Países</title>
    <link rel="icon" href="<?php echo IMG.'mapa.jpg';?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo CSS.'estiloModPais.css'; ?>">
</head>
<body>
    <header>
        <img src="<?php echo IMG.'logo.png';?>" alt="Logo">
        <h1>Viaje entre Culturas</h1>
    </header>
    <main>
        <div>
            <form>
                <div>
                <?php
                    foreach($dataToView["data"] as $pais){
                    ?>
                    <label for="pais">Nombre país:</label>
                    <input type="text" name="pais" id="pais" value="<?php echo $pais["nombrePais"]; ?>">
                    <br><br>
                    <a href='index.php?controlador=Pais&accion=cambiarChincheta' id="elcor" class="subirBtn">Elige Coordenadas</a>
                    <br><br>
                    <label for="banderaActual">Bandera actual:
                        <input type="file" id="banderaActual" name="bandera" style="display: none;" onchange="cambiarBandera(this)">
                        <br/>
                        <img width="25%" src="<?php echo BANDERAS.$pais["bandera"]; ?>" alt="Bandera de <?php echo $pais["nombrePais"]; ?>" name="<?php echo $pais["nombrePais"]; ?>" id="banderaActualImg">
                    </label>
                    <br><br>
                    <label for="subirBandera" class="subirBtn">Subir nueva bandera</label>
                    <input type="file" id="subirBandera" name="subirBandera">
                    
                    <input type="hidden" name="banderaActual" value="<?php echo $pais["bandera"]; ?>"> <!-- value="india.png"-->
                    <input type="hidden" name="coordX" id="coordX" value="<?php echo $pais["coordX"]; ?>">
                    <input type="hidden" name="coordY" id="coordY" value="<?php echo $pais["coordY"]; ?>">
                    <input type="hidden" name="idPais" value="<?php echo $_GET["idPais"]; ?>">
                    <input type="hidden" name="idContinente" value="<?php echo $_GET["idContinente"]; ?>">
                    <input type="hidden" name="nombreCont" value="<?php echo $_GET["nombreCont"]; ?>">
                    <?php
                }
                ?>
                
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
            if(scriptToLoad === '04validModifv2.js'){
                script.src = "<?php echo JS.'04validModifv2.js';?>";
            }
            else{
                script.src = "<?php echo JS.'04validModif.js';?>";
            }
            script.defer = true; // Asegura que el script se ejecute después de que el documento esté completamente cargado
            document.body.appendChild(script);
        });

    </script>
</body>
</html>