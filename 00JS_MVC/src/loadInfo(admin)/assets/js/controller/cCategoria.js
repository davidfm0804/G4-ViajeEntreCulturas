// Alta Pais | Promesa -> Fetch + FormData
async function altaCategoria(formData) {

    /*-- Declaración Variables --*/
    let valid = true;

    /*-- Validaciones --*/

    // Input Categoría | NOT NULL
    if (!formData.get('categoria')) {
        alert("Por favor, indique el nombre de la categoría.");
        valid = false;
    }

    // 1. Validar que el campo no esté vacío
    if (!formData.get('categoria').trim()) {
        alert("Por favor, ingrese el nombre de la categoría.");
        valid = false;
    } 

    // 2. Validar que solo contenga letras y espacios
    else {
        const regex = /^[A-Za-záéíóúÁÉÍÓÚüÜ\s]+$/;
        if (!regex.test(formData.get('categoria').trim())) {
            alert("El nombre de la categoría solo puede contener letras y espacios.");
            valid = false;
        }
    }

    // 3. Validar la longitud mínima y máxima
    if (formData.get('categoria').trim().length < 3 || formData.get('categoria').trim().length > 50) {
        alert("El nombre de la categoría debe tener entre 3 y 50 caracteres.");
        valid = false;
    }

    // 4. Validar que no sea solo espacios
    if (formData.get('categoria').trim().replace(/\s/g, '').length === 0) {
        alert("El nombre de la categoría no puede estar compuesto solo por espacios.");
        valid = false;
    }

    // 5. Validar palabras prohibidas (opcional)
    const palabrasProhibidas = ["inapropiado", "ofensivo"];
    if (palabrasProhibidas.some((palabra) => formData.get('categoria').toLowerCase().includes(palabra))) {
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

    /*-- Comprobar si la Categoría ya Existe en el Servidor
    // Realizar la solicitud al servidor
    const response = await verificarCategoria(formData);
    const result = await response.json(); // Acceder al resultado de la promesa

    if (!result.existe) {
        valid = false;
        return 'La categoría ya existe.';
    }

    console.log(data.existe);
    console.log(response);--*/ 

    /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
    if (valid) {
        const response = await mAltaCategoria(formData);

        if (response && response.ok) {
            return "Categoria registrada correctamente";
        } else {
            return "Error al registrar la categoría";
        }

    }
    
}

// Borrar Categoria | Promesa -> Fetch + FormData 
async function borrarCategoria(formData) {
    // Validación del formData [ID] || .has -> Comprueba si existe | .get -> Comprueba si tiene valor
    if (!formData.has('id') || !formData.get('id')) {
        console.error('Error: ID de la categoría no proporcionado');
        return false;
    }

    const response = await mBorrarCategoria(formData);

    if (response && response.ok) {
        return "Categoria borrada correctamente";
    } else {
        return "Error al borrar la categoría";
    }
}

// Modicar Categoria | Promesa -> Fetch + FormData 
async function modificarCategoria(formData) {

    // Input Categoria | NOT NULL | .has -> Comprueba si existe | .get -> Comprueba si tiene valor
    if (!formData.has('categoria') || !formData.get('categoria')) {
        alert("Por favor, indique el nombre de la categoría.");
        return false;
    }
    
    console.log(formData.get('categoria'));
    console.log(formData.get('id'));
    
    const response = await mModificarCategoria(formData);

    if (response && response.ok) {
        return "Categoria modificada correctamente";
    } else {
        return "Error al modificar la categoría";
    }
}