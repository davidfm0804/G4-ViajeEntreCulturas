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

    /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
    if (valid) {
        const response = await mAltaCategoria(formData);
        return response && response.ok ? true : false;
    }

    return false;
    
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