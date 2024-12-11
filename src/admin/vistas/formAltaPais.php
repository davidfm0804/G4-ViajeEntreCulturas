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

                <?php
                for($i = 1; $i < 5; $i++){
                ?>
                <fieldset>
                    <legend>Item <?php echo $i;?>:</legend><br/>

                    <label for="categoria<?php echo $i; ?>">Categoría: </label>

                    <select name="categoria<?php echo $i; ?>" id="categoria<?php echo $i;?>">
                        <option disabled selected></option>
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
    <script src="<?php echo JS.'02validAlta.js';?>"></script>
</body>
</html>
