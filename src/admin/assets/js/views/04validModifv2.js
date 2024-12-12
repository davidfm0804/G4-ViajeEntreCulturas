const idContinente = document.querySelector('[name="idContinente"]').value;
const nombreCont = document.querySelector('[name="nombreCont"]').value;

/*-- Ajustes DOM --*/
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = './crudPais.php';
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

    // Input Pais | NOT NULL
    if (!pais) {
        alert("Por favor, indique el nombre del país.");
        valid = false;
    }

    // Input File [imgBandera] | NOT NULL && Formato IMG
    if (imgBandera.files.length > 0 && !formatoValido.includes(imgBandera.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
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
    
            //Verificamos si la respuesta del server es correcta
            if(response.ok){
                const result = await response.text();
                alert(result);
                window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`; 
            }else{
                alert('País modificado correctamente.');
                window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`; 
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error en la conexión con el servidor');
            window.location.href = `index.php?controlador=Pais&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`; 
        }
                
        // Borrar Coordenadas localStorage
        localStorage.removeItem('coordX');
        localStorage.removeItem('coordY');
        localStorage.removeItem('nombrePais');
        localStorage.removeItem('imgBandera');
        localStorage.removeItem('idPais');
    }
});