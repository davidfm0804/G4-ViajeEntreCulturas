// Botón de cancelar: Redirige al listado de continentes
document.querySelector('.cancel').addEventListener('click', function () {
    window.location.href = 'index.php?controlador=Continente&accion=cListadoContinentes';
});

// Evento al hacer clic en el botón de actualizar/inserción
document.querySelector('.update').addEventListener('click', async function (event) {
    event.preventDefault(); // Evitar que se recargue la página

    // Variable que apunta al elemento cuyo name es continente (input text)
    const continente = document.querySelector('[name="nombreContinente"]');
    let valid = true;

    // Validaciones
    // El input de continente no puede ser vacío
    if (!continente.value) {
        alert("Por favor, indique el nombre del continente.");
        valid = false;
    }

    // El input de continente sólo puede contener letras
    if (/[^a-zA-ZáéíóúÁÉÍÓÚñÑ]/.test(continente.value)) {
        alert("Por favor, inserte solo valores alfabéticos.");
        valid = false;
    }

    // Continuar sólo si las validaciones son correctas
    if (valid) {
        // Convertir la cadena a formato "Primera letra en mayúsculas"
        function primeraEnMayusculas(cadena) {
            return cadena.charAt(0).toUpperCase() + cadena.slice(1).toLowerCase();
        }

        // Aplicar el formato al nombre del continente
        const nombreContinente = primeraEnMayusculas(continente.value.trim());

        // Crear los datos del formulario para enviar
        const formData = new FormData();
        formData.append('nombreContinente', nombreContinente);

        try {
            // Realizar solicitud fetch para insertar el continente
            const response = await fetch('index.php?controlador=Continente&accion=cInsertarContinente', {
                method: 'POST',
                body: formData
            });

            // Verificar si la respuesta es válida
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }

            // Obtener la respuesta como JSON
            const data = await response.json();

            // Manejar la respuesta del servidor
            if (data.success) {
                alert("Continente insertado correctamente.");
                // Redirigir al listado de continentes
                window.location.href = 'index.php?controlador=MenuPrincipal&accion=cListadoContinentes';
            } else if (data.error === 'duplicado') {
                alert("Este continente ya existe.");
            } else {
                alert("Error al insertar el continente: " + data.error);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Hubo un error al procesar la solicitud.');
        }
    }
});
