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
                    <button type="button" class="cancel">Cancelar</button>
                    <button type="button" class="update">Dar Alta</button>
            </form>
        </div>
    </main>
    <script src="<?php echo JS.'02validAlta.js';?>"></script>
</body>
</html>
