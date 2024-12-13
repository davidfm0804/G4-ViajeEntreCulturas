<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Items</title>
    <link rel="icon" href="<?php echo IMG.'mapa.jpg';?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo CSS.'estiloCelia.css'; ?>">
</head>
<body>
    <header>
        <img src="<?php echo IMG.'logo.png';?>" alt="Logo">
        <h1>Viaje entre Culturas</h1>
        <a href="index.php">PANEL ADMIN</a>
    </header>
<main>
    <h2>Items de (pais)</h2>
        <div>
            <form>
                <?php
                for($i = 1; $i < 5; $i++){
                ?>
                <fieldset>
                    <legend>Item <?php echo $i;?>:</legend><br/>

                    <label for="categoria<?php echo $i; ?>">Categoría: </label>

                    <select name="categoria<?php echo $i; ?>" id="categoria<?php echo $i;?>">
                        <option disabled hidden selected></option>
                        <?php if(count($dataToView["data"])>0){
                            foreach($dataToView["data"] as $categoria){ ?>
                        <option value="<?php echo $categoria['idCategoria'];?>"><?php echo $categoria['nombreCat']; ?></option>
                        <?php
                            } 
                        } else {
                        ?>
                            <tr><td colspan='4'>No hay categorias disponibles</td></tr>
                        <?php
                        }
                        ?>
                    </select><br/><br/>

                    <label for="subirfoto<?php echo $i; ?>" id="subirBtn<?php echo $i; ?>">Subir foto</label>
                    <input type="file" id="subirfoto<?php echo $i; ?>" name="foto<?php echo $i; ?>">
                     
                    <br/>
                    <label for="descripcion<?php echo $i; ?>" id="descripcion<?php echo $i; ?>">Inserte descripción: </label><br/>
                    <textarea id="descripcion<?php echo $i; ?>" name="descripcion<?php echo $i; ?>"></textarea>
                </fieldset>
                <br/>
                <?php    
                 }
                 ?>
                <input type="hidden" name="idContinente" value="<?php echo $_GET['id'];?>">
                <input type="hidden" name="nombreCont" value="<?php echo $_GET['nombreCont'];?>">
                    <button type="button" class="cancel">Cancelar</button>
                    <button type="button" class="update">Dar Alta</button>
            </form>
        </div>
    </main>
    <script src="<?php echo JS.'validModItems.js';?>"></script>
</body>
</html>