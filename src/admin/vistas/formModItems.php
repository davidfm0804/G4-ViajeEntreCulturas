<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Items</title>
    <link rel="icon" href="<?php echo IMG.'mapa.jpg';?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo CSS.'estiloSilva.css'; ?>">
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
                        <option selected> <?php echo $item["nombreCat"];?></option>
                    </select><br/><br/>
                    <img width="150px" src="<?php echo FOTOS.$item['imagen'];?>" alt="Foto de <?php echo $item["nombreCat"];?>" id="fotoActual"><br/>
                    <label for="subirfoto<?php echo $indice + 1; ?>" id="subirBtn<?php echo $indice + 1; ?>">Subir foto</label>
                    <input type="file" id="subirfoto<?php echo $indice + 1; ?>" name="foto<?php echo $indice + 1; ?>">
                     
                    <br/>
                    <label for="descripcion<?php echo $indice + 1; ?>" id="descripcion<?php echo $indice + 1; ?>">Inserte descripción: </label><br/>
                    <textarea id="descripcion<?php echo $indice + 1; ?>" name="descripcion<?php echo $indice + 1; ?>"><?php echo $item["descripcion"];?></textarea>
                </fieldset>
                <br/>
                <?php    
                 }
                }
                 ?>
                    <button type="button" class="cancel">Cancelar</button>
                    <button type="button" class="update">Actualizar</button>
            </form>
        </div>
    </main>
    <script src="<?php echo JS.'validModItems.js';?>"></script>
</body>
</html>