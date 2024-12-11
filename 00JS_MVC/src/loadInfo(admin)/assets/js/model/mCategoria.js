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
        console.log(formData.get('categoria'));
        console.log(formData.get('idCat'));
        const response = await fetch ('index.php?controlador=Categoria&accion=modificarCategoria',{
            method: 'POST',
            body: formData,
        });
    
        return response;
    
    } catch (error) {
        return false;
    }
}

async function verificarCategoria(formData) {
    try {
        const response = await fetch('index.php?controlador=Categoria&accion=csuCategoria', {
            method: 'POST',
            body: formData
        });
    
        console.log('mCatg');
        console.log(response);
        console.log(response.json());
        if(!response.ok) {
            return false;
        }

        return response;
    
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}
