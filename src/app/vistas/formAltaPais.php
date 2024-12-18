<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Países</title>  
    <link rel="icon" href="../../img/mapa.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../css/estiloHugoAltaItems.css">
</head>
<body>
    <header>
    <img src="../../img/logo.png" alt="Logo">
        <h1>Viaje entre Culturas</h1>
    </header>
<main>
        <div>
            <form>
                <div>
                    <label for="IntroducirPais">Nombre país:</label>
                    <input type="text" name="pais">
                    <br><br>
    
                    <label for="bandera" id="subirBandera">
                        Subir bandera
                        <input type="file" id="bandera" name="imagen">
                    </label>                    
                    <br><br>
    
                    <label for="coordenadaX">Coordenada X:</label>
                    <input type="text" name="coordenada_x" placeholder="1200"disabled>
                    <br><br>
    
                    <label for="coordenadaY">Coordenada Y:</label>
                    <input type="text" name="coordenada_y" placeholder="800" disabled>
                    <br><br>
                </div>   

                <fieldset>
                    <legend>Item:</legend><br/>

                    <label for="categoria">Categoría: </label>

                    <select name="categoria" id="categoria">
                        <option disabled selected></option>
                        
                        <option value=""></option>

                            <tr><td colspan='4'>No hay categorias disponibles</td></tr>

                    </select><br/><br/>

                    <label for="subirfoto" id="subirBandera">Subir foto</label><br>
                    <input type="file" id="subirfoto" name="foto">
                     
                    <br/>
                    <label for="descripcion" id="descripcion">Inserte descripción: </label><br/>
                    <textarea id="descripcion" name="descripcion"></textarea>
                </fieldset>
                <br/>
                <input type="hidden" name="idContinente" value="">
                <input type="hidden" name="nombreCont" value="">
                    <button type="button" class="cancel">Cancelar</button>
                    <button type="button" class="update">Dar Alta</button>
            </form>
        </div>
    </main>
</body>
</html>
