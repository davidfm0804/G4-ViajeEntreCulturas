// -------------------------------------------- VALIDACIONES ITEMS--------------------------------------------------------

// Evento al hacer click en la clase update (validaciones)
document.querySelector('input[type="submit"]').addEventListener('click', async function (event) {
    event.preventDefault();

    const nombreItem = document.querySelector('[name="nombreItem"]');
    const descripcion = document.querySelector('[name="descripcion"]');
    const imagen = document.querySelector('[name="imagen"]');

    let valid = true;

    // Validación del nombre del item
    if (!nombreItem.value) {
        alert("Por favor, indique el nombre del Item.");
        valid = false;
    } else if (/[^a-zA-ZáéíóúÁÉÍÓÚñÑ]/.test(nombreItem.value)) {
        alert("Por favor, inserte solo valores alfabéticos.");
        valid = false;
    }

    // Validación de la descripción
    if (!descripcion.value) {
        alert("Por favor, indique la descripción del item.");
        valid = false;
    }

    // Validación de archivo
    if (imagen.files.length === 0) {
        alert("Por favor, seleccione una imagen.");
        valid = false;
    } else {
        const file = imagen.files[0];
        const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];

        if (!allowedTypes.includes(file.type)) {
            alert("Solo se permiten archivos de tipo imagen (PNG, JPG, JPEG).");
            valid = false;
        }
    }

    if (valid) {
        // Convertimos la cadena de texto siendo la primera letra mayúsculas y el resto minúsculas
        function primeraEnMayusculas(cadena){
            return cadena.charAt(0).toUpperCase() + cadena.slice(1).toLowerCase();
        }
        //EL input text de continente lo pasamos por la función
        const nombreItem = primeraEnMayusculas(nombreItem.value);

        const formData = new FormData();
        formData.append('nombreItem', nombreItem);
        formData.append('descripcion', descripcion);
        formData.append('imagen', imagen);

        try {
            // Si no existe, procedemos a enviar el formulario para dar de alta el continente
            const insertResponse = await fetch('altaItem.php', {
                method: 'POST',
                body: formData
            });

                const result = await insertResponse.text();
                
                // Crear elementos para mostrar los datos enviados
                const h2 = document.createElement('h2');
                h2.textContent = 'Datos enviados:';
                h2.style.margin = '4%';

                const p = document.createElement('p');
                p.textContent = `Continente insertado: ${nombreContinente}`;
                p.style.margin = '4%';

                const main = document.querySelector('main');
                main.appendChild(h2);
                main.appendChild(p);

        } catch (error){
            console.error('Error:', error);
            alert('Hubo un error al procesar la solicitud.');
        }
    }
});
