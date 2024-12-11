<?php
$idContinente = $_GET['id'];
$nombreCont = $_GET['nombreCont'];
?>
<main>        
        <h2><?php echo $controlador->tituloPagina; ?></h2>
        <button id="altaPais">Alta país</button>
        <table>
            <tr>
                <th class="cabecera">Bandera</th>
                <th class="cabecera">Nombre</th>
                <th class="cabecera">Modificar</th>
                <th class="cabecera">Borrar</th>
            </tr>
            <?php
            if(count($dataToView["data"])>0){
                foreach($dataToView["data"] as $pais){
                    ?>
                    <tr id="<?php echo $pais["idPais"]; ?>">
                        <td><img class='flag' src='<?php echo BANDERAS.$pais["bandera"]; ?>' alt='<?php echo $pais["nombrePais"]; ?>'></td>
                        <td class='colNombre'><?php echo $pais["nombrePais"]; ?></td> 
                        <td><button><img class='png' src="<?php echo IMG.'modificar.png';?>"></button></td>
                        <td><button><img class='png' src="<?php echo IMG.'borrar.png';?>"></button></td>
                    </tr>
                    <?php
                } 
            } else {
                ?>
                <tr><td colspan='4'>No hay países disponibles</td></tr>
            <?php
            }
            ?>
        </table>
        <input type="hidden" id="idContinente" value="<?php echo $idContinente; ?>">
        <input type="hidden" id="nombreCont" value="<?php echo $nombreCont; ?>">
    </main>
    <script src="<?php echo JS.'listadoPaises.js';?>"></script>
</body>
</html>