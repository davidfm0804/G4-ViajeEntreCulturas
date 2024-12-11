   <main>
        <div>
            <form>
                <div>
                    <label for="IntroducirPais">Nombre país:</label>
                    <input type="text" name="pais">
                    <br><br>
    
                    <label for="subirBandera" id="subirBtn">
                        Subir bandera
                        <input type="file" id="subirBandera" name="bandera">
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
                    <legend>Item 1:</legend>
                    <label for="categoria">Categoría: </label>
                    <select name="categoria" id="categoria">
                        <option disabled selected></option>
                    <?php
                    if(count($dataToView["data"])>0){
                    foreach($dataToView["data"] as $categoria){
                        ?>
                    <option value="<?php echo $categoria['idCategoria'];?>"><?php echo $categoria['nombreCat']; ?></option>
                    <?php
                    } 
                } else {
                    ?>
                    <tr><td colspan='4'>No hay categorias disponibles</td></tr>
                <?php
                }
                ?>
                </select>
                <br/><br/>
                    <label for="subirfoto" id="subirBtn<?php echo $categoria['idCategoria']; ?>">
                        Subir foto
                        <input type="file" id="subirfoto1" name="foto1">
                    </label> 
                    <br/>
                    <label for="descripcion" id="descripcion<?php echo $categoria['idCategoria']; ?>">Inserte descripción: </label><br/>
                    <textarea id="descripcion1" name="descripcion"></textarea>
                </fieldset>

                <fieldset>
                    <legend>Item 2:</legend>
                    <label for="categoria">Categoría: </label>
                    <select name="categoria" id="categoria">
                        <option disabled selected></option>
                    <?php
                    if(count($dataToView["data"])>0){
                    foreach($dataToView["data"] as $categoria){
                        ?>
                    <option value="<?php echo $categoria['idCategoria'];?>"><?php echo $categoria['nombreCat']; ?></option>
                    <?php
                    } 
                } else {
                    ?>
                    <tr><td colspan='4'>No hay categorias disponibles</td></tr>
                <?php
                }
                ?>
                </select>
                <br/><br/>
                    <label for="subirfoto" id="subirBtn<?php echo $categoria['idCategoria']; ?>">
                        Subir foto
                        <input type="file" id="subirfoto1" name="foto1">
                    </label> 
                    <br/>
                    <label for="descripcion" id="descripcion<?php echo $categoria['idCategoria']; ?>">Inserte descripción: </label><br/>
                    <textarea id="descripcion1" name="descripcion"></textarea>
                </fieldset>

                <fieldset>
                    <legend>Item 3:</legend>
                    <label for="categoria">Categoría: </label>
                    <select name="categoria" id="categoria">
                        <option disabled selected></option>
                    <?php
                    if(count($dataToView["data"])>0){
                    foreach($dataToView["data"] as $categoria){
                        ?>
                    <option value="<?php echo $categoria['idCategoria'];?>"><?php echo $categoria['nombreCat']; ?></option>
                    <?php
                    } 
                } else {
                    ?>
                    <tr><td colspan='4'>No hay categorias disponibles</td></tr>
                <?php
                }
                ?>
                </select>
                <br/><br/>
                    <label for="subirfoto" id="subirBtn<?php echo $categoria['idCategoria']; ?>">
                        Subir foto
                        <input type="file" id="subirfoto1" name="foto1">
                    </label> 
                    <br/>
                    <label for="descripcion" id="descripcion<?php echo $categoria['idCategoria']; ?>">Inserte descripción: </label><br/>
                    <textarea id="descripcion1" name="descripcion"></textarea>
                </fieldset>
                
                <fieldset>
                    <legend>Item 4:</legend>
                    <label for="categoria">Categoría: </label>
                    <select name="categoria" id="categoria">
                        <option disabled selected></option>
                    <?php
                    if(count($dataToView["data"])>0){
                    foreach($dataToView["data"] as $categoria){
                        ?>
                    <option value="<?php echo $categoria['idCategoria'];?>"><?php echo $categoria['nombreCat']; ?></option>
                    <?php
                    } 
                } else {
                    ?>
                    <tr><td colspan='4'>No hay categorias disponibles</td></tr>
                <?php
                }
                ?>
                </select>
                <br/><br/>
                    <label for="subirfoto" id="subirBtn<?php echo $categoria['idCategoria']; ?>">
                        Subir foto
                        <input type="file" id="subirfoto1" name="foto1">
                    </label> 
                    <br/>
                    <label for="descripcion" id="descripcion<?php echo $categoria['idCategoria']; ?>">Inserte descripción: </label><br/>
                    <textarea id="descripcion1" name="descripcion"></textarea>
                </fieldset>
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
