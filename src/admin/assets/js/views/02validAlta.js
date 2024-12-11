/*-- Ajustes DOM --*/
document.querySelector('main').style.position = "relative";
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = './crudPais.php';
});

/*-- Dar Valor Inputs Coordenadas [localStorage] --*/
document.querySelector('[name="coordenada_x"]').value = localStorage.getItem('coordX');
document.querySelector('[name="coordenada_y"]').value = localStorage.getItem('coordY');

/*-- Añadir Evento -> Form --*/
document.querySelector('.update').addEventListener('click', async function(event){

    /*-- Recoger Elementos --*/
    const pais = document.querySelector('[name="pais"]');
    const imgBandera = document.querySelector('[name="bandera"]');
    const coordX = document.querySelector('[name="coordenada_x"]');
    const coordY = document.querySelector('[name="coordenada_y"]');

    /*-- Declaración Variables --*/
    let valid = true;
    const formatoValido = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

    /*-- Validaciones --*/

    // Select Pais | NOT NULL
    if (!pais.value) {
        alert("Por favor, indique el nombre del país.");
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

        try {
            const response = await fetch(`index.php?controlador=Pais&accion=cAltaPais&id`, {
                method: 'POST',
                body: formData
            });
            const result = await response.text();
            
            // Crear elementos
            const h2 = document.createElement('h2');
            h2.textContent = 'Datos enviados:';
            h2.style.margin = '4%';

            const pre = document.createElement('pre');
            pre.textContent = result;
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
            document.body.innerHTML = '';
            document.body.appendChild(h2);
            document.body.appendChild(pre);
            document.body.appendChild(buttonMostrarMapa);
            document.body.appendChild(buttonAddCultura);
            document.body.appendChild(buttonVolver);

            /*-- Funcionalidad Botón Mostrar Mapa --*/
            document.getElementById('mostrarMapa').addEventListener('click', function() {
                window.location.href = './mapaUbiPais.php?script=03cargarCoord.js';
            });
            
            /*-- Funcionalidad Botón Añadir Cultura --*/
            document.getElementById('addCultura').addEventListener('click', function() {
                window.location.href = './mapaUbiPais.php';
            });
            
            /*-- Funcionalidad Botón Volver --*/
            document.getElementById('volver').addEventListener('click', function() {
                window.location.href = './crudPais.php';
            });
        } catch (error) {
            console.error('Error:', error);
        }

        // Borrar Coordenadas localStorage
        localStorage.removeItem('coordX');
        localStorage.removeItem('coordY');
    }
});