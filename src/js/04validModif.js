/*-- Ajustes DOM --*/
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = './mainCrud.php';
});

/*-- Guardar Elementos | LocalStorage --*/
document.getElementById('elcor').addEventListener('click', function(event) {
    // Quitar Evento Default
    event.preventDefault();
    const pais = document.querySelector('[name="pais"]').value;
    const imgBandera = document.querySelector('[name="bandera"]').value ? document.querySelector('[name="bandera"]').value : document.querySelector('#banderaActual').src;
    const idPais = document.querySelector('[name="idPais"]').value;
    localStorage.setItem('nombrePais', pais);
    localStorage.setItem('imgBandera', imgBandera);
    localStorage.setItem('idPais', idPais);
    window.location.href = './mapaModf.php';
});

/*-- Añadir Evento -> Form --*/
document.querySelector('.update').addEventListener('click', async function(event){

    /*-- Recoger Elementos --*/
    const pais = document.querySelector('[name="pais"]').value;
    const imgBanderaInput = document.querySelector('[name="bandera"]');
    const imgBandera = imgBanderaInput.files.length > 0 ? imgBanderaInput.files[0] : document.querySelector('#banderaActual').src;
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

    // Input File [imgBandera] | if NOT NULL -> Formato IMG
    if (imgBanderaInput.files.length > 0 && !formatoValido.includes(imgBandera.type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }

    /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
    if (valid) {
        const formData = new FormData();

        formData.append('idPais', idPais);
        formData.append('pais', pais);
        if (imgBanderaInput.files.length > 0) {
            formData.append('imgBandera', imgBandera);
        } else {
            formData.append('imgBandera', document.querySelector('#banderaActual').src);
        }
        formData.append('coordX', coordX);
        formData.append('coordY', coordY);

        /*-- Mostrar FormData --*/
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }

        // Promesa | Fetch + FormData -> Borrar Pais
        try {
            const response = await fetch ('../05modificarPais.php',{
                method: 'POST',
                body: formData,
            });
    
            //Verificamos si la respuesta del server es correcta
            if(response.ok){
                const result = await response.text();
                alert(result);
                window.location.href = './mainCrud.php'; 
            }else{
                alert('Pais modificado correctamente');
                window.location.href = './mainCrud.php'; 
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error en la conexión con el servidor');
            window.location.href = './mainCrud.php'; 
        }
        
    }
});