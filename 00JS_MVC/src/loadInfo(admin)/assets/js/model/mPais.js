// Alta Pais | Promesa -> Fetch + FormData
async function mAltaPais(formData) {
    try {
        const response = await fetch('index.php?controlador=Pais&accion=insertDatos', {
            method: 'POST',
            body: formData
        });

        return response;

    } catch (error) {
        return false;
    }
}

// Borrar Pais | Promesa -> Fetch + FormData
async function mBorrarPais(formData) {
    try {
        const response = await fetch ('index.php?controlador=Pais&accion=borrarPais',{
            method: 'POST',
            body: formData,
        });
    
        return response;
    
    } catch (error) {
        return false;
    }
}

// Modificar Pais | Promesa -> Fetch + FormData
async function mModificarPais(formData) {
    try {
        const response = await fetch ('index.php?controlador=Pais&accion=modificarPais',{
            method: 'POST',
            body: formData,
        });
    
        return response;
    
    } catch (error) {
        return false;
    }

}
