/*-- Ajustes DOM --*/
document.querySelector('main').style.position = "relative";
document.querySelector('.cancel').addEventListener('click', function(){
    window.open('./PanelAdmin');
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
        alert("Por favor, selecciona un país.");
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
            const response = await fetch('./02insertDatos.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.text();
            document.body.innerHTML = `<h2>Datos enviados:</h2><pre>${result}</pre><button id="mostrarMapa" class='update'>Mostrar culturas en el mapa</button><button id="addCultura" class='update'>Añadir Cultura</button><button id="volver" class='cancel'>Volver</button>`;
            document.getElementById('mostrarMapa').addEventListener('click', function() {
                window.location.href = './mapaUbiPais.html?script=03cargarCoord.js';
            });
            document.getElementById('addCultura').addEventListener('click', function() {
                window.location.href = './mapaUbiPais.html';
            });
            document.getElementById('volver').addEventListener('click', function() {
                window.location.href = './#PanelAdmin';
            });
        } catch (error) {
            console.error('Error:', error);
        }

        // Borrar Coordenadas localStorage
        localStorage.removeItem('coordX');
        localStorage.removeItem('coordY');
    }
});