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

// Modificar Pais | Promesa -> Fetch + FormData
async function mModificarCategoria(formData) {
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
