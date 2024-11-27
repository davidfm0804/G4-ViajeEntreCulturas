document.getElementById("formCultura").addEventListener('submit', async function(event){
    // Desactivar Submit
    event.preventDefault();

    // Recoger Elementos
    const pais = document.getElementById('selectPais');
    const imgBandera = document.getElementById('imgBandera');
    const coordX = document.getElementById('coordX');
    const coordY = document.getElementById('coordY');
    const archivoGeneral = document.getElementById('imgGeneral');
    const archivoGastronomia = document.getElementById('imgGastronomia');
    const archivoReligion = document.getElementById('imgReligion');
    const archivoFiestas = document.getElementById('imgFiestas');
    const descrip = document.getElementById('descrip');

    // Declaración Variables 
    let valid = true;
    const formatoValido = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

    /* Validaciones */

    // Select Pais | NOT NULL
    if (pais.value === "") {
        alert("Por favor, selecciona un país.");
        valid = false;
    }

    /* Preguntar Isa: IMGS NULL? */
    // Input File [imgBandera] | NOT NULL && Formato IMG
    if (imgBandera.files.length === 0) {
        alert("Por favor, sube una imagen de la bandera.");
        valid = false;
    } else if (!formatoValido.includes(imgBandera.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }

    // Textarea [Descriptivo] | NOT NULL
    if (descrip.value.trim() === "") {
        alert("Por favor, ingresa una descripción.");
        valid = false;
    }

    // Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa
    if (valid) {
        const formData = new FormData();
        formData.append('pais', opciones.value);
        formData.append('imgBandera', archivoBandera.files[0]);
        formData.append('coordX', coordX.value);
        formData.append('coordY', coordY.value);
        formData.append('imgGeneral', archivoGeneral.files[0]);
        formData.append('imgGastronomia', archivoGastronomia.files[0]);
        formData.append('imgReligion', archivoReligion.files[0]);
        formData.append('imgFiestas', archivoFiestas.files[0]);
        formData.append('descrip', descrip.value);

        try {
            const response = await fetch('mostrarDatos.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.text();
            document.body.innerHTML = `<h2>Datos enviados:</h2><pre>${result}</pre>`;
        } catch (error) {
            console.error('Error:', error);
        }
    }
});