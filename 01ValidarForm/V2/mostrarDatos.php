<?php
    echo '<h2>Resultados del Formulario</h2>';
    echo '<p><strong>Pais:</strong> '.(isset($_POST['pais']) ? $_POST['pais'] : 'No se seleccionó país').'</p>';
    echo '<p><strong>Descripcion:</strong> '.(isset($_POST['descrip']) ? $_POST['descrip'] : 'No se ingresó descripción').'</p>';
    echo '<p><strong>Imagen Bandera:</strong> '.(isset($_FILES['imgBandera']) ? $_FILES['imgBandera']['name'] : 'No se subió imagen').'</p>';
    echo '<p><strong>Coordenada X:</strong> '.(isset($_POST['coordX']) ? $_POST['coordX'] : 'No se ingresó coordenada X').'</p>';
    echo '<p><strong>Coordenada Y:</strong> '.(isset($_POST['coordY']) ? $_POST['coordY'] : 'No se ingresó coordenada Y').'</p>';
    echo '<p><strong>Imagen General:</strong> '.(isset($_FILES['imgGeneral']) ? $_FILES['imgGeneral']['name'] : 'No se subió imagen').'</p>';
    echo '<p><strong>Imagen Gastronomía:</strong> '.(isset($_FILES['imgGastronomia']) ? $_FILES['imgGastronomia']['name'] : 'No se subió imagen').'</p>';
    echo '<p><strong>Imagen Religión:</strong> '.(isset($_FILES['imgReligion']) ? $_FILES['imgReligion']['name'] : 'No se subió imagen').'</p>';
    echo '<p><strong>Imagen Fiestas:</strong> '.(isset($_FILES['imgFiestas']) ? $_FILES['imgFiestas']['name'] : 'No se subió imagen').'</p>';
?>