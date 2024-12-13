async function altaCategoria(formData) {
    const validation = validarCategoria(formData);

    if (!validation.valid) {
        alert(validation.error);
        return;
    }

    if (confirm("¿Está seguro de que desea registrar esta categoría?")) {
        console.log("Validaciones pasadas, verificando existencia de la categoría...");
        console.log(formData.get('categoria'));
        
        // Comprobar si la Categoría ya Existe en el Servidor
        const exists = await verificarCategoria(formData);
        console.log("Resultado de la verificación:", exists);
        if (exists) {
            alert('La categoría ya existe.');
            return;
        }
        
        console.log("Categoría no existe, procediendo a registrar...");
        const response = await mAltaCategoria(formData);

        if (response && response.ok) {
            const text = await response.text();
            if (text.includes("Categoria registrada correctamente")) {
                console.log(text);
                return "Categoria registrada correctamente";
            } else {
                alert(text);
                return "Error al registrar la categoría";
            }
        } else {
            console.log("Error al registrar la categoría");
            return "Error al registrar la categoría";
        }
    }
}
    


async function modificarCategoria(formData) {
    const validation = validarCategoria(formData);

    if (!validation.valid) {
        alert(validation.error);
        return;
    }

    if (confirm("¿Está seguro de que desea modificar esta categoría?")) {
        console.log("Validaciones pasadas, verificando existencia de la categoría...");
        console.log(formData.get('categoria'));
        
        // Comprobar si la Categoría ya Existe en el Servidor
        const exists = await verificarCategoria(formData);
        console.log("Resultado de la verificación:", exists);
        if (exists) {
            alert('La categoría ya existe.');
            return;
        }

        console.log("Categoría no existe, procediendo a modificar...");
        const response = await mModificarCategoria(formData);

        if (response && response.ok) {
            const text = await response.text();
            if (text.includes("Registro modificado correctamente")) {
                console.log(text);
                return "Categoria Modificada Correctamente";
            } else {
                alert(text);
                return "Error al modificar la categoría";
            }
        } else {
            console.log("Error al modificar la categoría");
            return "Error al modificar la categoría";
        }
    }
}

function validarCategoria(formData) {
    let valid = true;
    let error = '';

    // 1. Validar que el campo no esté vacío
    if (!formData.get('categoria').trim()) {
        error = "Por favor, indique el nombre de la categoría.";
        valid = false;
    }
    
    // 2. Validar que solo contenga letras y espacios
    else {
        const regex = /^[A-Za-záéíóúÁÉÍÓÚüÜ\s]+$/;
        if (!regex.test(formData.get('categoria').trim())) {
            error = "El nombre de la categoría solo puede contener letras y espacios.";
            valid = false;
        }
    }

    // 3. Validar la longitud mínima y máxima
    if (valid && (formData.get('categoria').trim().length < 3 || formData.get('categoria').trim().length > 50)) {
        error = "El nombre de la categoría debe tener entre 3 y 50 caracteres.";
        valid = false;
    }

    // 4. Validar que no sea solo espacios
    if (valid && (formData.get('categoria').trim().replace(/\s/g, '').length === 0)) {
        error = "El nombre de la categoría no puede estar compuesto solo por espacios.";
        valid = false;
    }

    // 5. Validar palabras prohibidas (opcional)
    const palabrasProhibidas = ["imbecil", "tonto"];
    if (valid && (palabrasProhibidas.some((palabra) => formData.get('categoria').trim().toLowerCase().includes(palabra)))) {
        error = "El nombre contiene palabras no permitidas.";
        valid = false;
    }

    return { valid, error };
}
 
async function borrarCategoria(formData) {
    if (!formData.has('id') || !formData.get('id')) {
        alert("Error: ID de la categoría no proporcionado");
        return "Error al borrar la categoría";
    }

    const response = await mBorrarCategoria(formData);

    if (response && response.ok) {
        const text = await response.text();
        if (text.includes("Registro eliminado correctamente")) {
            console.log(text);
            return "Categoria borrada correctamente";
        } else {
            return "Error al borrar la categoría";
        }
    } else {
        console.log("Error al borrar la categoría");
        return "Error al borrar la categoría";
    }

}