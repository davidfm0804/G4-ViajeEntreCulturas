const idContinente = document.querySelector('[name="idContinente"]').value;
const nombreCont = document.querySelector('[name="nombreCont"]').value;

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
    const imgBandera = document.querySelector('[name="imagen"]');
    const coordX = document.querySelector('[name="coordenada_x"]');
    const coordY = document.querySelector('[name="coordenada_y"]');

    const categoria1 = document.querySelector('[name="categoria1"]');
    const categoria2 = document.querySelector('[name="categoria2"]');
    const categoria3 = document.querySelector('[name="categoria3"]');
    const categoria4 = document.querySelector('[name="categoria4"]');


    const imgItem1 = document.querySelector('[name="foto1"]');
    const imgItem2 = document.querySelector('[name="foto2"]');
    const imgItem3 = document.querySelector('[name="foto3"]');
    const imgItem4 = document.querySelector('[name="foto4"]');

    const descripcion1 = document.querySelector('[name="descripcion1"]');
    const descripcion2 = document.querySelector('[name="descripcion2"]');
    const descripcion3 = document.querySelector('[name="descripcion3"]');
    const descripcion4= document.querySelector('[name="descripcion4"]');
    
 


    /*-- Declaración Variables --*/
    let valid = true;
    const formatoValido = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/pjpeg', 'image/x-png'];

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
    } else {
        console.log(imgBandera.files[0].type);  // Verifica el tipo MIME del archivo
        if (!formatoValido.includes(imgBandera.files[0].type)) {
            alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
            valid = false;
        }
    }
    // Coordenadas (Aunque siempre deberian estar)
    if (!coordX.value || !coordY.value) {
        alert("Por favor, localiza la cultura en el mapa.");
        valid = false;
    }
    // Item1

    if (!categoria1.value.trim()) {
        alert("Por favor, introduce un valor para la categoría 1.");
        valid = false;
    }
    if (imgItem1.files.length === 0) {
        alert("Por favor, sube una imagen de la foto en el item1.");
        valid = false;
    } else if (!formatoValido.includes(imgItem1.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }
      
    if (descripcion1.value.length > 500) {
        alert("No puedes introducir 500 caracteres en la descripcion del item 1");
        valid = false;
    }else if(descripcion1.value.length <= 0){
        alert("No puedes dejar vacia la descripcion del item 1");
    }

     // Item2

    if (!categoria2.value.trim()) {
        alert("Por favor, introduce un valor para la categoría 2.");
        valid = false;
    }
    if (imgItem2.files.length === 0) {
        alert("Por favor, sube una imagen de la foto en el item2.");
        valid = false;
    } else if (!formatoValido.includes(imgItem2.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }
    if (descripcion2.value.length > 500) {
        alert("No puedes introducir 500 caracteres en la descripcion del item 2");
        valid = false;
    }else if(descripcion2.value.length <= 0){
        alert("No puedes dejar vacia la descripcion del item 2");
    }

     // Item3

    if (!categoria3.value.trim()) {
        alert("Por favor, introduce un valor para la categoría 3.");
        valid = false;
    }
    if (imgItem3.files.length === 0) {
        alert("Por favor, sube una imagen de la foto en el item3.");
        valid = false;
    } else if (!formatoValido.includes(imgItem3.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }
    if (descripcion3.value.length > 500) {
        alert("No puedes introducir 500 caracteres en la descripcion del item 3");
        valid = false;
    }else if(descripcion3.value.length <= 0){
        alert("No puedes dejar vacia la descripcion del item 3");
    }
      // Item4
    if (!categoria4.value.trim()) {
        alert("Por favor, introduce un valor para la categoría 4.");
        valid = false;
    }
    if (imgItem4.files.length === 0) {
        alert("Por favor, sube una imagen de la foto en el item4.");
        valid = false;
    } else if (!formatoValido.includes(imgItem4.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }
 
    if (descripcion4.value.length > 500) {
        alert("No puedes introducir 500 caracteres en la descripcion del item 4");
        valid = false;
    }else if(descripcion4.value.length <= 0){
        alert("No puedes dejar vacia la descripcion del item 4");
    }

    /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
    if (valid) {
        const formData = new FormData();
        formData.append('pais', pais.value);
        formData.append('imgBandera', imgBandera.files[0]);
        formData.append('coordX', coordX.value);
        formData.append('coordY', coordY.value);
        formData.append('categoria', categoria.value);
        formData.append('imgItem', imgItem.files[0]);
        formData.append('descripcion', descripcion.value);

        try {
            const response = await fetch(`index.php?controlador=Pais&accion=cAltaPais&idContinente=${idContinente}&nombreCont=${nombreCont}`, {
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