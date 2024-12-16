const idContinente = document.querySelector('[name="idContinente"]').value;
const nombreCont = document.querySelector('[name="nombreCont"]').value;

document.querySelector('main').style.position = "relative";
document.querySelector('.cancel').addEventListener('click', function() {
    window.location.href = `index.php?controlador=Item&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`;
});

const formatoValido = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
const maxDescripcionLength = 500; // Longitud máxima permitida para la descripción

function validarArchivo(inputFile) {
    const archivo = inputFile.files[0];
    if (archivo && !formatoValido.includes(archivo.type)) {
        alert('El archivo seleccionado no es una imagen válida. Solo se permiten archivos JPEG, PNG, GIF o JPG.');
        inputFile.value = '';
    }
}

function validarDescripcion(textarea) {
    if (textarea.value.length > maxDescripcionLength) {
        alert(`La descripción no puede tener más de ${maxDescripcionLength} caracteres.`);
        textarea.value = textarea.value.substring(0, maxDescripcionLength);
    }

    if (textarea.value.trim() === "") {
        alert("La descripción no puede estar en blanco.");
        textarea.focus();
        return false; 
    }

    return true; 
}

function validarCategorias() {
    const categoriasSeleccionadas = [];
    for (let i = 1; i <= 4; i++) {
        const categoriaSelect = document.querySelector(`[name="categoria${i}"]`);
        const categoriaId = categoriaSelect.value; // Obtenemos el id de la categoría seleccionada
        if (categoriasSeleccionadas.includes(categoriaId)) {
            alert(`La categoría ${categoriaSelect.options[categoriaSelect.selectedIndex].text} ya ha sido seleccionada. Por favor, elige una categoría diferente.`);
            return false; // Si hay categorías repetidas, devolvemos false
        }
        categoriasSeleccionadas.push(categoriaId);
    }
    return true; // Si no hay categorías repetidas, devolvemos true
}

for (let i = 1; i <= 4; i++) {
    const imgInput = document.querySelector(`#subirfoto${i}`);
    imgInput.addEventListener('change', function () {
        validarArchivo(imgInput);
    });

    const descripcionInput = document.querySelector(`[name="descripcion${i}"]`);
    descripcionInput.addEventListener('input', function () {
        validarDescripcion(descripcionInput);
    });
}

function cambiarImagen(inputFile) {
    const archivo = inputFile.files[0];
    if (!archivo || !formatoValido.includes(archivo.type)) {
        return;
    }

    const index = inputFile.id.replace('subirfoto', '');
    const reader = new FileReader();

    reader.onload = function (e) {
        const imgElement = document.querySelector(`#fotoActualIMG${index}`);
        imgElement.src = e.target.result;
    };

    reader.readAsDataURL(archivo);
}

const selectCategoria1 = document.getElementById('categoria1');
const selectCategoria2 = document.getElementById('categoria2');
const selectCategoria3 = document.getElementById('categoria3');
const selectCategoria4 = document.getElementById('categoria4');

const urlCargarCategorias = `index.php?controlador=Item&accion=cCargarCategorias`;
async function actualizarSelect(selectElement, url) {
    try {
        const optionSelected = selectElement.querySelector('option:checked');
        const idCategoria = optionSelected ? optionSelected.id : null;

        const formData = new FormData();
        formData.append('idCategoria', idCategoria);

        const respuesta = await fetch(url, {
            method: 'POST',
            body: formData
        });

        if (!respuesta.ok) {
            throw new Error('Error en la respuesta del servidor');
        }

        const categorias = await respuesta.json();

        categorias.forEach(categoria => {
            const option = document.createElement('option');
            option.id = categoria.idCategoria;
            option.textContent = categoria.nombreCategoria;
            selectElement.appendChild(option);
        });

    } catch (error) {
        console.error('Error:', error);
    }
}

actualizarSelect(selectCategoria1, urlCargarCategorias);
actualizarSelect(selectCategoria2, urlCargarCategorias);
actualizarSelect(selectCategoria3, urlCargarCategorias);
actualizarSelect(selectCategoria4, urlCargarCategorias);


document.querySelector('.update').addEventListener('click', async function(event) {
    event.preventDefault();
    let valid = true;

    // Validar archivos e imágenes antes de enviar el formulario
    for (let i = 1; i <= 4; i++) {
        const imgInput = document.querySelector(`#subirfoto${i}`);
        if (imgInput.files.length > 0) {
            const archivo = imgInput.files[0];
            if (!formatoValido.includes(archivo.type)) {
                alert(`El archivo seleccionado en la categoría ${i} no es una imagen válida.`);
                valid = false;
                break;
            }
        }

        const descripcionInput = document.querySelector(`[name="descripcion${i}"]`);
        if (descripcionInput.value.length > maxDescripcionLength) {
            alert(`La descripción de la categoría ${i} no puede tener más de ${maxDescripcionLength} caracteres.`);
            valid = false;
            break;
        }

        if (descripcionInput.value.trim() === "") {
            alert(`La descripción de la categoría ${i} no puede estar en blanco.`);
            valid = false;
            break;
        }
    }

    // Validación de categorías repetidas
    if (!validarCategorias()) {
        valid = false;
    }

    if (!valid) {
        return; // Detener la ejecución si hay errores
    }

    const idPais = document.querySelector('[name="idPais"]').value;
    let formData = new FormData();
    formData.append('idPais', idPais);

    for (let i = 1; i <= 4; i++) {
        const categoriaItem = document.querySelector(`[name="categoria${i}"]`).selectedOptions[0].id;
        formData.append(`categoriaItem${i}`, categoriaItem);

        const descripcionItem = document.querySelector(`[name="descripcion${i}"]`).value;
        formData.append(`descripcionItem${i}`, descripcionItem);

        const imgItemInput = document.querySelector(`#subirfoto${i}`);
        const imgItem = imgItemInput.files.length > 0 
            ? imgItemInput.files[0]
            : document.querySelector(`[name="imagenActual${i}"]`).value;

        if (imgItem instanceof File) {
            formData.append(`imgItem${i}`, imgItem);
        } else if (imgItem !== "") {
            formData.append(`imgItem${i}`, imgItem);
        }
    }

    try {
        const response = await fetch('index.php?controlador=Item&accion=cActualizarItems', {
            method: 'POST',
            body: formData,
        });

        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }

        const result = await response.text();
        console.log("Respuesta del servidor:", result);

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
});
