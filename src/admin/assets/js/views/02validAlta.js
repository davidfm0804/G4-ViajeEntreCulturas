const idContinente = document.querySelector('[name="idContinente"]').value;
const nombreCont = document.querySelector('[name="nombreCont"]').value;
/*-- Ajustes DOM --*/
document.querySelector('main').style.position = "relative";
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id${idContinente}&nombreCont=${nombreCont}`;
});

/*-- Dar Valor Inputs Coordenadas [localStorage] --*/
document.querySelector('[name="coordenada_x"]').value = localStorage.getItem('coordX');
document.querySelector('[name="coordenada_y"]').value = localStorage.getItem('coordY');

/*-- Añadir Evento -> Form --*/
document.querySelector('.update').addEventListener('click', async function(event){

    /*-- Recoger Elementos --*/
    const pais = document.querySelector('[name="pais"]');
    const imgBandera = document.querySelector('[name="imagen"]');
    const coordX = document.querySelector('[name="coordenada_x"]');
    const coordY = document.querySelector('[name="coordenada_y"]');

    const categoria1 = document.querySelector('[name="categoria1"]');
    const imgItem1 = document.querySelector('[name="foto1"]');
    const descripcion1 = document.querySelector('[name="descripcion1"]');

    const categoria2 = document.querySelector('[name="categoria2"]');
    const imgItem2 = document.querySelector('[name="foto2"]');
    const descripcion2 = document.querySelector('[name="descripcion2"]');

    const categoria3 = document.querySelector('[name="categoria3"]');
    const imgItem3 = document.querySelector('[name="foto3"]');
    const descripcion3 = document.querySelector('[name="descripcion3"]');

    const categoria4 = document.querySelector('[name="categoria4"]');
    const imgItem4 = document.querySelector('[name="foto4"]');
    const descripcion4 = document.querySelector('[name="descripcion4"]');

    /*-- Declaración Variables --*/
    let valid = true;
    const formatoValido = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

    /*-- Validaciones --*/

    // Select Pais | NOT NULL
    if (!pais.value) {
        alert("Por favor, indique el nombre del país.");
        valid = false;
    }

    // Input File [imgItem1] | NOT NULL && Formato IMG
    if (imgItem1.files.length === 0) {
        alert("Por favor, sube una imagen de la foto.");
        valid = false;
    } else if (!formatoValido.includes(imgItem1.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }

    // Input File [imgItem2] | NOT NULL && Formato IMG
    if (imgItem2.files.length === 0) {
        alert("Por favor, sube una imagen de la foto.");
        valid = false;
    } else if (!formatoValido.includes(imgItem2.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }

    // Input File [imgItem3] | NOT NULL && Formato IMG
    if (imgItem3.files.length === 0) {
        alert("Por favor, sube una imagen de la foto.");
        valid = false;
    } else if (!formatoValido.includes(imgItem3.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }

    // Input File [imgItem4] | NOT NULL && Formato IMG
    if (imgItem4.files.length === 0) {
        alert("Por favor, sube una imagen de la foto.");
        valid = false;
    } else if (!formatoValido.includes(imgItem4.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }

    // Input File [imgBandera] | NOT NULL && Formato IMG
    if (imgBandera.files.length === 0) {
        alert("Por favor, sube una imagen de la bandera.");
        valid = false;
    } else if (!formatoValido.includes(imgBandera.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }

    // Input Text [Coordenadas] | NOT NULL
    if (!coordX.value || !coordY.value) {
        alert("Por favor, localiza la cultura en el mapa.");
        valid = false;
    }

    /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
    if (valid) {
        const formData = new FormData();
        formData.append('pais', pais.value);
        formData.append('imgBandera', imgBandera.files[0]);
        formData.append('coordX', coordX.value);
        formData.append('coordY', coordY.value);
        formData.append('categoria1', categoria1.value);
        formData.append('imgItem1', imgItem1.files[0]);
        formData.append('descripcion1', descripcion1.value);
        formData.append('categoria2', categoria2.value);
        formData.append('imgItem2', imgItem2.files[0]);
        formData.append('descripcion2', descripcion2.value);
        formData.append('categoria3', categoria3.value);
        formData.append('imgItem3', imgItem3.files[0]);
        formData.append('descripcion3', descripcion3.value);
        formData.append('categoria4', categoria4.value);
        formData.append('imgItem4', imgItem4.files[0]);
        formData.append('descripcion4', descripcion4.value);

        try {
            const response = await fetch(`index.php?controlador=Pais&accion=cAltaPais&idContinente=${idContinente}&nombreCont=${nombreCont}`, {
                method: 'POST',
                body: formData
            });
            
            
            // Crear elementos
            const h2 = document.createElement('h2');
            h2.textContent = 'Datos enviados:';
            h2.style.margin = '4%';

            const pre = document.createElement('pre');
            pre.textContent = "Nuevo registro creado exitosamente";
            pre.style.margin = '1% 0 4% 6%';

            const buttonMostrarMapa = document.createElement('button');
            buttonMostrarMapa.id = 'mostrarMapa';
            buttonMostrarMapa.style.margin = '2%';
            buttonMostrarMapa.className = 'update';
            buttonMostrarMapa.textContent = 'Mostrar paises en el mapa';

            const buttonAddCultura = document.createElement('button');
            buttonAddCultura.id = 'addCultura';
            buttonAddCultura.style.margin = '2%';
            buttonAddCultura.className = 'update';
            buttonAddCultura.textContent = 'Añadir Pais';

            const buttonVolver = document.createElement('button');
            buttonVolver.id = 'volver';
            buttonVolver.style.display = 'block';
            buttonVolver.style.margin = '2% auto';
            buttonVolver.className = 'cancel';
            buttonVolver.textContent = 'Volver';

            /*-- Sobreescibir Body | Add Elements --*/

            document.querySelector('main').innerHTML = '';
            document.querySelector('main').appendChild(h2);
            document.querySelector('main').appendChild(pre);
            document.querySelector('main').appendChild(buttonMostrarMapa);
            document.querySelector('main').appendChild(buttonAddCultura);
            document.querySelector('main').appendChild(buttonVolver);

            /*-- Funcionalidad Botón Mostrar Mapa --*/
            document.getElementById('mostrarMapa').addEventListener('click', function() {
                window.location.href = `index.php?controlador=Pais&accion=cMapaChinchetas&idContinente=${idContinente}&nombreCont=${nombreCont}`;
            });
            
            /*-- Funcionalidad Botón Añadir Cultura --*/
            document.getElementById('addCultura').addEventListener('click', function() {
                window.location.href = `index.php?controlador=Pais&accion=cMapaChincheta&id=${idContinente}&nombreCont=${nombreCont}`;
            });
            
            /*-- Funcionalidad Botón Volver --*/
            document.getElementById('volver').addEventListener('click', function() {
                window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`;
            });
        } catch (error) {
            console.error('Error:', error);
        }

        // Borrar Coordenadas localStorage
        localStorage.removeItem('coordX');
        localStorage.removeItem('coordY');
    }
});