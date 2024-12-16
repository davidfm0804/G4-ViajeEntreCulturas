const idContinente = document.querySelector('[name="idContinente"]').value;
const nombreCont = document.querySelector('[name="nombreCont"]').value;

/*-- Ajustes DOM --*/
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`;
});

document.querySelector('#subirBandera').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function(e) {
        document.querySelector('#banderaActualImg').src = e.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});

/*-- Dar Valor Elementos | LocalStorage --*/
if(localStorage.getItem('nombrePais')) document.querySelector('[name="pais"]').value = localStorage.getItem('nombrePais');
if(localStorage.getItem('imgBandera')) document.querySelector('#banderaActualImg').value = localStorage.getItem('imgBandera');
if(localStorage.getItem('idPais')) document.querySelector('[name="idPais"]').value = localStorage.getItem('idPais'); 
if(localStorage.getItem('banderaAct')) document.querySelector('#banderaActualImg').src = localStorage.getItem('banderaAct');
if(localStorage.getItem('coordX')) document.querySelector('[name="coordX"]').value = localStorage.getItem('coordX');
if(localStorage.getItem('coordY')) document.querySelector('[name="coordY"]').value = localStorage.getItem('coordY');

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
    // if (!pais) {
    //     alert("Por favor, indique el nombre del país.");
    //     valid = false;  // Si el campo está vacío, la validación falla
    // }

    // Validación para el campo 'imgBandera' | Si se ha subido una bandera, debe tener un formato de imagen válido
    // if (imgBanderaInput.files.length > 0 && !formatoValido.includes(imgBanderaInput.files[0].type)) {
    //     alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
    //     valid = false;  // Si el formato de la imagen no es válido, la validación falla
    // }

    // Validación para el campo 'coordX' | Debe ser un valor numérico
    // if (!coordX || isNaN(coordX)) {
    //     alert("Por favor, indique una coordenada X válida.");
    //     valid = false;  // Si las coordenadas X no están presentes o no son numéricas, la validación falla
    // }

    // Validación para el campo 'coordY' | Debe ser un valor numérico
    // if (!coordY || isNaN(coordY)) {
    //     alert("Por favor, indique una coordenada Y válida.");
    //     valid = false;  // Si las coordenadas Y no están presentes o no son numéricas, la validación falla
    // }

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
                alert('Error al modificar el país.');
                window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`; 
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error en la conexión con el servidor');
            window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`; 
        }

        // Borrar Coordenadas localStorage después de completar la operación
        localStorage.removeItem('coordX');
        localStorage.removeItem('coordY');
        localStorage.removeItem('nombrePais');
        localStorage.removeItem('imgBandera');
        localStorage.removeItem('idPais');
    }
});
