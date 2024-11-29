/*-- Dar Valor Inputs Coordenadas [localStorage] --*/
document.getElementById('coordX').value = localStorage.getItem('coordX');
document.getElementById('coordY').value = localStorage.getItem('coordY');

/*-- Añadir Evento -> Form --*/
document.getElementById("formCultura").addEventListener('submit', async function(event){
    /*-- Desactivar Submit --*/
    event.preventDefault();

    /*-- Recoger Elementos --*/
    const pais = document.getElementById('pais');
    const imgBandera = document.getElementById('imgBandera');
    const coordX = document.getElementById('coordX');
    const coordY = document.getElementById('coordY');
    const imgGeneral = document.getElementById('imgGeneral');
    const imgGastronomia = document.getElementById('imgGastronomia');
    const imgReligion = document.getElementById('imgReligion');
    const imgFiestas = document.getElementById('imgFiestas');
    const descrip = document.getElementById('descrip');

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

    // Textarea [Descriptivo] | NOT NULL
    if (descrip.value.trim() === "") {
        alert("Por favor, ingresa una descripción.");
        valid = false;
    }

    /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
    if (valid) {
        const formData = new FormData();
        formData.append('pais', pais.value);
        formData.append('imgBandera', imgBandera.files[0]);
        formData.append('coordX', coordX.value);
        formData.append('coordY', coordY.value);
        formData.append('imgGeneral', imgGeneral.files[0]);
        formData.append('imgGastronomia', imgGastronomia.files[0]);
        formData.append('imgReligion', imgReligion.files[0]);
        formData.append('imgFiestas', imgFiestas.files[0]);
        formData.append('descrip', descrip.value);

        try {
            const response = await fetch('../php/02insertDatos.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.text();
            document.body.innerHTML = `<h2>Datos enviados:</h2><pre>${result}</pre><button id="mostrarMapa">Mostrar en el mapa</button>`;
            document.getElementById('mostrarMapa').addEventListener('click', function() {
                window.location.href = '../html/03index.html';
            });
        } catch (error) {
            console.error('Error:', error);
        }

        // Borrar Coordenadas localStorage
        localStorage.removeItem('coordX');
        localStorage.removeItem('coordY');
    }
});