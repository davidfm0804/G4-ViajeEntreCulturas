// Alta Pais | Promesa -> Fetch + FormData
async function altaPais(formData) {

    /*-- Declaración Variables --*/
    let valid = true;
    const formatoValido = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

    /*-- Validaciones --*/

    // Select Pais | NOT NULL
    if (!formData.get('pais')) {
        alert("Por favor, indique el nombre del país.");
        valid = false;
    }

    // Input File [imgBandera] | NOT NULL && Formato IMG
    if (!formData.get('imgBandera')) {
        alert("Por favor, sube una imagen de la bandera.");
        valid = false;
    } else if (!formatoValido.includes(formData.get('imgBandera').type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }

    // Input Text [Coordenadas] | NOT NULL
    if (!formData.get('coordX') || !formData.get('coordY')) {
        alert("Por favor, localiza la cultura en el mapa.");
        valid = false;
    }

    /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
    if (valid) {
        const response = await mAltaPais(formData);
        return response && response.ok ? true : false;
    }

    return false;
    
}

// Borrar Pais | Promesa -> Fetch + FormData 
async function borrarPais(formData) {
    // Validación del formData [ID] || .has -> Comprueba si existe | .get -> Comprueba si tiene valor
    if (!formData.has('id') || !formData.get('id')) {
        console.error('Error: ID del país no proporcionado');
        return false;
    }

    const response = await mBorrarPais(formData);

    if (response && response.ok) {
        return "Pais borrado correctamente";
    } else {
        return "Error al borrar el país";
    }
}

// Modicar Pais | Promesa -> Fetch + FormData 
async function modificarPais(formData) {

    /*-- Declaración Variables --*/
    const formatoValido = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

    // Input Pais | NOT NULL | .has -> Comprueba si existe | .get -> Comprueba si tiene valor
    if (!formData.has('pais') || !formData.get('pais')) {
        alert("Por favor, indique el nombre del país.");
        return false;
    }

    // Input File [imgBandera] | if NOT NULL -> Formato IMG | .has -> Comprueba si existe | .get -> Comprueba si tiene valor
    if (formData.has('imgBandera') && formData.get('imgBandera').name) {
        if (!formatoValido.includes(formData.get('imgBandera').type)) {
            alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
            return false;
        }
    }

    const response = await mModificarPais(formData);

    if (response && response.ok) {
        return "Pais modificado correctamente";
    } else {
        return "Error al modificar el país";
    }
}