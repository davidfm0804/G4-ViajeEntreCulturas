// Alta Pais | Promesa -> Fetch + FormData
async function mAltaCategoria(formData) {
    try {
        const response = await fetch('index.php?controlador=Categoria&accion=insertDatos', {
            method: 'POST',
            body: formData
        });

        return response;

    } catch (error) {
        return false;
    }
}

// Borrar Categoria | Promesa -> Fetch + FormData
async function mBorrarCategoria(formData) {
    try {
        console.log(formData.get('id'));
        const response = await fetch ('index.php?controlador=Categoria&accion=borrarCategoria',{
            method: 'POST',
            body: formData,
        });
    
        return response;
    
    } catch (error) {
        return false;
    }
}

// Modificar Categoría | Promesa -> Fetch + FormData
async function mModificarCategoria(formData) {
    try {
        const response = await fetch ('index.php?controlador=Categoria&accion=modificarCategoria',{
            method: 'POST',
            body: formData
        });

        return response;

    } catch (error) {
        return false;
    }
}

async function verificarCategoria(formData) {
    try {
        console.log("Enviando solicitud para verificar categoría...");
        const response = await fetch('index.php?controlador=Categoria&accion=csuCategoria', {
            method: 'POST',
            body: formData
        });
    
        const data = await response.json();
        console.log("Respuesta del servidor:", data);
        return data.exists;
    
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}
