<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../../img/mapa.jpg" type="image/x-icon">
        <title>Gestión Categorías</title>
        <link rel="stylesheet" href="../../css/estiloHugo.css">  
    </head>
    <body>
        <header>
            <img src="../../img/logo.png" alt="Logo">
            <h1>Viaje entre Culturas</h1>
            <a href="#">PANEL ADMIN</a>
        </header>
        <main>
            <h2>Listado categorías</h2>      
            <a href="altaCategoria.php">
                <button>alta categoría</button>
            </a>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Gastronomía</td>
                        <td><button class="modificar"><img src="../../img/modificar2.png"></button></td>
                        <td><button class="borrar"><img src="../../img/borrar.png"></button></td>
                    </tr>
                    <tr>
                        <td>Vestimenta</td>
                        <td><button class="modificar"><img src="../../img/modificar2.png"></button></td>
                        <td><button class="borrar"><img src="../../img/borrar.png"></button></td>
                    </tr>
                    <tr>
                        <td>Música</td>
                        <td><button><img src="../../img/modificar2.png"></button></td>
                        <td><button><img src="../../img/borrar.png"></button></td>
                    </tr>
                    <tr>
                        <td>Danza</td>
                        <td><button class="modificar"><img src="../../img/modificar2.png"></button></td>
                        <td><button class="borrar"><img src="../../img/borrar.png"></button></td>
                    </tr>
            </table>
        </main>
    </body>
</html>