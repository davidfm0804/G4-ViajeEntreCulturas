const idContinente = document.querySelector('[name="idContinente"]').value;
const nombreCont = document.querySelector('[name="nombreCont"]').value;
/*-- Ajustes DOM --*/
document.querySelector('main').style.position = "relative";
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = `index.php?controlador=Item&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`;
});

function cambiarImagen(inputFile) {
    // Obtener el índice de la imagen (basado en el ID del input)
    const index = inputFile.id.replace('subirfoto', ''); // Por ejemplo, para "subirfoto1", index será 1

    // Crear un objeto FileReader
    const reader = new FileReader();

    // Leer el archivo cuando se selecciona
    reader.onload = function(e) {
        // Cambiar la imagen en el HTML al archivo seleccionado
        const imgElement = document.querySelector(`#fotoActualIMG${index}`);
        imgElement.src = e.target.result; // Actualizamos la imagen con el nuevo archivo
    };

    // Leer el archivo como URL de datos (base64)
    reader.readAsDataURL(inputFile.files[0]);
}

// Definir las constantes para cada uno de los selects
const selectCategoria1 = document.getElementById('categoria1');
const selectCategoria2 = document.getElementById('categoria2');
const selectCategoria3 = document.getElementById('categoria3');
const selectCategoria4 = document.getElementById('categoria4');

const urlCargarCategorias = `index.php?controlador=Item&accion=cCargarCategorias`;
async function actualizarSelect(selectElement, url) {
    try {
        // Obtener el id del option seleccionado debajo del select
        const optionSelected = selectElement.querySelector('option:checked'); // Seleccionamos el option marcado
        const idCategoria = optionSelected ? optionSelected.id : null; // Extraemos el id del option seleccionado, si existe

        // Crear un FormData para enviar al servidor
        const formData = new FormData();
        formData.append('idCategoria', idCategoria);  // Añadimos el id de la categoría seleccionada

        // Realizar la solicitud fetch con método POST
        const respuesta = await fetch(url, {
            method: 'POST', // Usamos POST para enviar el FormData
            body: formData // Enviamos el FormData con los datos
        });

        // Verificamos si la respuesta es exitosa
        if (!respuesta.ok) {
            throw new Error('Error en la respuesta del servidor');
        }

        // Parseamos la respuesta JSON
        const categorias = await respuesta.json(); 

        // Creamos las nuevas opciones para el select, sin eliminar las anteriores
        categorias.forEach(categoria => {
            // Creamos un nuevo option
            const option = document.createElement('option');
            option.id = categoria.idCategoria; // Establecemos el id del option
            option.textContent = categoria.nombreCategoria; // Establecemos el nombre de la categoría

            // Añadimos el option al select (debajo del option ya existente)
            selectElement.appendChild(option);
        });

    } catch (error) {
        console.error('Error:', error); // Imprimir el error en caso de que haya un fallo
    }
}

actualizarSelect(selectCategoria1, urlCargarCategorias);
actualizarSelect(selectCategoria2, urlCargarCategorias);
actualizarSelect(selectCategoria3, urlCargarCategorias);
actualizarSelect(selectCategoria4, urlCargarCategorias);

/*-- Añadir Evento -> Form --*/
document.querySelector('.update').addEventListener('click', async function(event){

        /*-- Declaración Variables --*/
    let valid = true;
    const formatoValido = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

    /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
    if (valid) {
            /*-- Recoger Elementos --*/
        const idPais = document.querySelector('[name="idPais"]').value;
        // Crear un objeto para almacenar los datos
        let formData = new FormData();
        formData.append('idPais', idPais);

        for (let i = 1; i <= 4; i++) {
            // Recoger categoría
            const categoriaItem = document.querySelector(`[name="categoria${i}"]`).selectedOptions[0].id;
            formData.append(`categoriaItem${i}`, categoriaItem);

            // Recoger descripción
            const descripcionItem = document.querySelector(`[name="descripcion${i}"]`).value;
            formData.append(`descripcionItem${i}`, descripcionItem);

            // Obtener las imágenes (si se cambian) o mantener las imágenes actuales
            const imgItemInput = document.querySelector(`#subirfoto${i}`);
            const imgItem = imgItemInput.files.length > 0 
                ? imgItemInput.files[0]  // Nueva imagen
                : document.querySelector(`[name="imagenActual${i}"]`).value;  // Imagen actual

            // Si la imagen ha cambiado, agregar el archivo, de lo contrario, agregar la imagen actual
            if (imgItem instanceof File) {
                formData.append(`imgItem${i}`, imgItem);
            } else if (imgItem !== ""){
                formData.append(`imgItem${i}`, imgItem);  // Si no cambia, agregamos la imagen actual
            }
        }


        // Promesa | Fetch + FormData -> Borrar Pais
        try {
            const response = await fetch ('index.php?controlador=Item&accion=cActualizarItems',{
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }

            // Leer la respuesta del servidor
            const result = await response.text();
            console.log("Respuesta del servidor:", result);

            // Mostrar mensaje dependiendo del estado
            if (result.includes('modificado correctamente')) {
                alert('Registro modificado correctamente');
                window.location.href = `index.php?controlador=Item&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`;
            } else {
                alert('Hubo un error: ' + result);
            }
        
        } catch (error) {
            console.error('Error al hacer la solicitud:', error);
            alert('Hubo un error al realizar la solicitud al servidor. Intenta de nuevo.');
        }
    }
});