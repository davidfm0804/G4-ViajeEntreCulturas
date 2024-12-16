const idContinente = document.querySelector('[name="idContinente"]').value;
const nombreCont = document.querySelector('[name="nombreCont"]').value;

/*-- Ajustes DOM --*/
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`;
});

// Cambiar la imagen de la bandera al subir una nueva imagen 
document.querySelector('#subirBandera').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function(e) {
        document.querySelector('#banderaActualImg').src = e.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});

/*-- Guardar Elementos | LocalStorage --*/
document.getElementById('elcor').addEventListener('click', function(event) {
    // Quitar Evento Default
    event.preventDefault();
    const pais = document.querySelector('[name="pais"]').value;
    const imgBanderaInput = document.querySelector('#subirBandera');
    const imgBandera = document.querySelector('[name="banderaActual"]').value || document.querySelector('#banderaActualImg').name;
    //imgBandera = "bandera.png"
    const idPais = document.querySelector('[name="idPais"]').value;
    localStorage.setItem('nombrePais', pais);
    localStorage.setItem('imgBandera', imgBandera);
    localStorage.setItem('idPais', idPais);
    window.location.href = `index.php?controlador=Pais&accion=cCambiarChincheta&idPais=${idPais}&pais=${pais}&idContinente=${idContinente}&nombreCont=${nombreCont}`;
});

/*-- Añadir Evento -> Form --*/
document.querySelector('.update').addEventListener('click', async function(event){

    /*-- Recoger Elementos --*/
    const pais = document.querySelector('[name="pais"]').value;
    const imgBanderaInput = document.querySelector('#subirBandera');
    const imgBandera = imgBanderaInput.files.length > 0 
        ? imgBanderaInput.files[0] 
        : document.querySelector('[name="banderaActual"]').value;
    const coordX = document.querySelector('[name="coordX"]').value;
    const coordY = document.querySelector('[name="coordY"]').value;
    const idPais = document.querySelector('[name="idPais"]').value;

    /*-- Declaración Variables --*/
    let valid = true;
    const formatoValido = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

    /*-- Validaciones --*/

    // Validación para el campo 'pais' | No puede estar vacío
     if (!pais) {
         alert("Por favor, indique el nombre del país.");
         valid = false;  // Si el campo está vacío, la validación falla
    }

    // Validación para el campo 'imgBandera' | Si se ha subido una bandera, debe tener un formato de imagen válido
    if (imgBanderaInput.files.length > 0 && !formatoValido.includes(imgBandera.type)) {
    alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
    valid = false;  // Si el formato de la imagen no es válido, la validación falla
    }

    // Validación para el campo 'coordX' | Debe ser un valor numérico
    if (!coordX || isNaN(coordX)) {
    alert("Por favor, indique una coordenada X válida.");
    valid = false;  // Si las coordenadas X no están presentes o no son numéricas, la validación falla
    }

    // Validación para el campo 'coordY' | Debe ser un valor numérico
    if (!coordY || isNaN(coordY)) {
    alert("Por favor, indique una coordenada Y válida.");
     valid = false;  // Si las coordenadas Y no están presentes o no son numéricas, la validación falla
    }

    /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
    if (valid) {
        const formData = new FormData();

        formData.append('idPais', idPais);
        formData.append('pais', pais);
        if (imgBandera instanceof File) {
            formData.append('imgBandera', imgBandera);
        } else {
            formData.append('imgBandera', imgBandera);
        }
        formData.append('coordX', coordX);
        formData.append('coordY', coordY);

        /*-- Mostrar FormData --*/
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }

        // Promesa | Fetch + FormData -> Borrar Pais
        try {
            const response = await fetch ('index.php?controlador=Pais&accion=cUpdatePais',{
                method: 'POST',
                body: formData,
            });

            // Verificamos si la respuesta del servidor es correcta
            if(response.ok){
                const result = await response.text();
                alert(result);
                window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`; 
            } else {
                alert('País modificado correctamente');
                window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`; 
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error en la conexión con el servidor');
            window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`; 
        }
        
    }
});
