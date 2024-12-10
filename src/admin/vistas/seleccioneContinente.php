        <main>        
            <h2><?php echo $controlador->tituloPagina; ?></h2>
            <table>
                <tr>
                    <th class="cabecera">Nombre</th>
                    <th class="cabecera">Seleccionar</th>
                </tr>
                <?php
                if(count($dataToView["data"])>0){
                    foreach($dataToView["data"] as $continente){
                        ?>
                        <tr id="<?php echo $continente["idContinente"]; ?>">
                            <td class='colNombre'><?php echo $continente["nombreCont"]; ?></td> 
                            <td><button><img class='png' src="<?php echo IMG.'modificar.png';?>"></button></td>
                        </tr>
                        <?php
                    } 
                } else {
                    ?>
                    <tr><td colspan='4'>No hay continentes disponibles</td></tr>
                <?php
                }
                ?>
            </table>
        </main>
        <script src="<?php echo JS.'seleccioneContinente.js';?>"></script>
    </body>
</html>