<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Items</title>
    <link rel="icon" href="<?php echo IMG.'mapa.jpg';?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo CSS.'estiloHugoPaisItems.css'; ?>">
</head>
<body>
    <header>
        <img src="<?php echo IMG.'logo.png';?>" alt="Logo">
        <h1>Viaje entre Culturas</h1>
        <a href="index.php">PANEL ADMIN</a>
    </header>
<main>
    <h2><?php echo $controlador->tituloPagina; ?></h2>
        <div>
            <form>
               <?php if(count($dataToView["data"])>0){
                foreach($dataToView["data"] as $indice => $item){ ?>
                <fieldset>
             
                    <legend>Item <?php echo $indice + 1;?>:</legend><br/>

                    <label for="categoria<?php echo $indice + 1; ?>">Categoría: </label>
                       
                    <select name="categoria<?php echo $indice + 1; ?>" id="categoria<?php echo $indice + 1;?>">
                        <option selected id="<?php echo $item["idCategoria"];?>"> <?php echo $item["nombreCat"];?></option>
                    </select><br/><br/>

                     <!-- Input file para cambiar la imagen -->
                    <input type="file" id="subirfoto<?php echo $indice + 1; ?>" name="foto<?php echo $indice + 1; ?>" style="display: none;" onchange="cambiarImagen(this)">
                    <br/><br/>
                    <img width="150px" src="<?php echo FOTOS . $item['imagen']; ?>" alt="Foto de <?php echo $item["nombreCat"]; ?>" id="fotoActualIMG<?php echo $indice + 1; ?>"><br/>
                    <label for="subirfoto<?php echo $indice + 1; ?>" id="subirBandera"<?php echo $indice + 1; ?>>Subir foto</label>

                    <br/>

                    <!-- Campo oculto para la imagen actual -->
                    <input type="hidden" name="imagenActual<?php echo $indice + 1; ?>" value="<?php echo $item['imagen']; ?>">

                     
                    <br/>
                    <label for="descripcion<?php echo $indice + 1; ?>" id="descripcion<?php echo $indice + 1; ?>">Inserte descripción: </label><br/>
                    <textarea id="descripcion<?php echo $indice + 1; ?>" name="descripcion<?php echo $indice + 1; ?>"><?php echo $item["descripcion"];?></textarea>
                </fieldset>
                <br/>
                <?php    
                 }
                }
                 ?>
                 <input type="hidden" name="idContinente" value="<?php echo $_GET["idContinente"]; ?>">
                 <input type="hidden" name="nombreCont" value="<?php echo $_GET["nombreCont"]; ?>">
                 <input type="hidden" name="idPais" value="<?php echo $_GET["idPais"]; ?>">
                 <input type="hidden" name="nombrePais" value="<?php echo $_GET["nombrePais"]; ?>">
                    <button type="button" class="cancel">Cancelar</button>
                    <button type="button" class="update">Actualizar</button>
            </form>
        </div>
    </main>
    <script src="<?php echo JS.'validModItems.js';?>"></script>
</body>
</html>