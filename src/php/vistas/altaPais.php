<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viaje entre culturas</title>
    <link rel="icon" href="../../img/mapa.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/estilo.css">
</head>
<body>
    <header>
        <img src="../../img/logo.png" alt="Logo">
        <h1>Viaje entre Culturas</h1>
    </header>
    <main>
        <div>
            <form action="mostrarAltapais.php" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="nombrePais">Nombre del País: </label><br>
                    <input type="text" name="nombrePais" placeholder="Nombre del País">
                    <br><br>                                     

                    <label for="bandera" id="subirBandera">
                        Subir bandera
                        <input type="file" id="bandera" name="bandera">
                    </label>                    
                    <br><br>

                    <label for="coordX">Coordenada X:</label><br>
                    <input type="text" name="coordX" >
                    <br><br>

                    <label for="coordY">Coordenada Y:</label><br>
                    <input type="text" name="coordY" >
                    <br><br>
                </div>             

                <input type="submit" class="update" value="Dar de Alta">
                <input type="reset" class="cancel" value="Borrar">
                <br><br>

                <?php
                    if (isset($_GET['msj'])){
                        echo $_GET['msj'];
                    }
                ?>

            </form>
        </div>
    </main>
</body>
</html>


         
                  
            