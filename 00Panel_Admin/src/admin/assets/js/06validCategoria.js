document.querySelector('.update').addEventListener('click', async function (event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del botón

    const nombreCatg = document.querySelector('[name="nombreCat"]');
    const form = document.getElementById('categoriaForm');

    /*-- Declaración de Variables --*/
    let valid = true;

    /*-- Validaciones --*/
    // 1. Validar que el campo no esté vacío
    if (!nombreCatg.value.trim()) {
        alert("Por favor, ingrese el nombre de la categoría.");
        valid = false;
    } 
    // 2. Validar que solo contenga letras y espacios
    else {
        const regex = /^[A-Za-záéíóúÁÉÍÓÚüÜ\s]+$/;
        if (!regex.test(nombreCatg.value.trim())) {
            alert("El nombre de la categoría solo puede contener letras y espacios.");
            valid = false;
        }
    }

    // 3. Validar la longitud mínima y máxima
    if (nombreCatg.value.trim().length < 3 || nombreCatg.value.trim().length > 50) {
        alert("El nombre de la categoría debe tener entre 3 y 50 caracteres.");
        valid = false;
    }

    // 4. Validar que no sea solo espacios
    if (nombreCatg.value.trim().replace(/\s/g, '').length === 0) {
        alert("El nombre de la categoría no puede estar compuesto solo por espacios.");
        valid = false;
    }

    // 5. Validar palabras prohibidas (opcional)
    const palabrasProhibidas = ["inapropiado", "ofensivo"];
    if (palabrasProhibidas.some((palabra) => nombreCatg.value.toLowerCase().includes(palabra))) {
        alert("El nombre contiene palabras no permitidas.");
        valid = false;
    }

    // Si no es válido, salir sin hacer nada más
    if (!valid) {
        return;
    }

    /*-- Confirmación del Usuario --*/
    const confirmar = confirm("¿Está seguro de que desea registrar esta categoría?");
    if (!confirmar) {
        return;
    }

    /*-- Comprobar si la Categoría ya Existe en el Servidor --*/
    try {
        const formData = new FormData();
        formData.append('nombreCat', nombreCatg.value.trim());

        // Realizar la solicitud al servidor
        const response = await fetch('comprobarCategoria.php', {
            method: 'POST',
            body: formData,
        });

        // Verificar si la respuesta es válida
        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.status);
        }

        // Obtener los datos del servidor como JSON
        const data = await response.json();

        // Verificar si la categoría ya existe
        if (data.existe) {
            alert("Esta categoría ya existe.");
            return; // Salir si la categoría ya existe
        }

        /*-- Si no existe, Enviar el Formulario --*/
        console.log("Formulario válido. Procediendo al envío...");
        form.submit();

    } catch (error) {
        console.error("Error:", error);
        alert("Hubo un error al procesar la solicitud.");
    }
});
