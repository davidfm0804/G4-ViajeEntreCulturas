/*-- Dar Valor Elementos | LocalStorage --*/
if(localStorage.getItem('nombrePais')) document.querySelector('[name="pais"]').value = localStorage.getItem('nombrePais');
if(localStorage.getItem('imgBandera')) document.querySelector('[name="bandera"]').value = localStorage.getItem('imgBandera');
if(localStorage.getItem('idPais')) document.querySelector('[name="idPais"]').value = localStorage.getItem('idPais'); 

/*-- Ajustes DOM --*/
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = './mainCrud.php';
});

/*-- Añadir Evento -> Form --*/
document.querySelector('.update').addEventListener('click', async function(event){

    /*-- Recoger Elementos --*/
    const pais = document.querySelector('[name="pais"]');
    const imgBandera = document.querySelector('[name="bandera"]');
    const coordX = localStorage.getItem('coordX');
    const coordY = localStorage.getItem('coordY');
    const idPais = document.querySelector('[name="idPais"]');

    /*-- Declaración Variables --*/
    let valid = true;
    const formatoValido = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

    /*-- Validaciones --*/

    // Input Pais | NOT NULL
    if (!pais.value) {
        alert("Por favor, indique el nombre del país.");
        valid = false;
    }

    // Input File [imgBandera] | If NOT NULL => Formato IMG
    if (imgBandera.files.length != 0)
        if (!formatoValido.includes(imgBandera.files[0].type)) {
            alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
            valid = false;
        }

    /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
    if (valid) {
        const formData = new FormData();
        formData.append('pais', pais.value);
        
        if (imgBandera.files.length > 0) {
            formData.append('imgBandera', imgBandera.files[0]);
        }

        if (coordX && coordY) {
            formData.append('coordX', coordX);
            formData.append('coordY', coordY);
        }

        formData.append('idPais', document.querySelector('[name="idPais"]').value);

        /*-- Mostrar FormData --*/
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }

        // Promesa | Fetch + FormData -> Borrar Pais
        try {
            const response = await fetch ('../src/php/05modificarPais.php',{
                method: 'POST',
                body: formData,
            });
    
            //Verificamos si la respuesta del server es correcta
            if(response.ok){
                const result = await response.text();
                alert(result);
                window.location.href = './mainCrud.php'; 
            }else
                alert('Error al modificar el país');
                window.location.href = './mainCrud.php'; 
        } catch (error) {
            console.error('Error:', error);
            alert('Error en la conexión con el servidor');
            window.location.href = './mainCrud.php'; 
        }
                
        // Borrar Coordenadas localStorage
        localStorage.removeItem('coordX');
        localStorage.removeItem('coordY');
        localStorage.removeItem('nombrePais');
        localStorage.removeItem('imgBandera');
        localStorage.removeItem('idPais');
    }
});