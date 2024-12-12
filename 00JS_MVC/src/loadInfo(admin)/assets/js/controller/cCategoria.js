// Alta Pais | Promesa -> Fetch + FormData
async function altaCategoria(formData) {

    /*-- Declaración Variables --*/
    let valid = true;

    /*-- Validaciones --*/

    // 1. Validar que el campo no esté vacío
    if (!formData.get('categoria').trim()) {
        alert("Por favor, indique el nombre de la categoría.");
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
    if (valid && (formData.get('categoria').trim().length < 3 || formData.get('categoria').trim().length > 50)) {
        alert("El nombre de la categoría debe tener entre 3 y 50 caracteres.");
        valid = false;
    }

    // 4. Validar que no sea solo espacios
    if (valid && (formData.get('categoria').trim().replace(/\s/g, '').length === 0)) {
        alert("El nombre de la categoría no puede estar compuesto solo por espacios.");
        valid = false;
    }

    // 5. Validar palabras prohibidas (opcional)
    const palabrasProhibidas = ["imbecil", "tonto"];
    if (valid && (palabrasProhibidas.some((palabra) => formData.get('categoria').trim().toLowerCase().includes(palabra)))) {
        alert("El nombre contiene palabras no permitidas.");
        valid = false;
    }

    /*-- Confirmación del Usuario --*/ 
    if(valid && confirm("¿Está seguro de que desea registrar esta categoría?")){
        console.log("Validaciones pasadas, verificando existencia de la categoría...");
        console.log(formData.get('categoria'));
        
        // Comprobar si la Categoría ya Existe en el Servidor
        const exists = await verificarCategoria(formData);
        console.log("Resultado de la verificación:", exists);
        if (exists) {
            alert('La categoría ya existe.');
            valid = false;
        }

        /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
        if (valid) {
            console.log("Categoría no existe, procediendo a registrar...");
            const response = await mAltaCategoria(formData);

            if (response && response.ok) {
                console.log("Categoría registrada correctamente");
                return "Categoria registrada correctamente";
            } else {
                console.log("Error al registrar la categoría");
                return "Error al registrar la categoría";
            }
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

    /*-- Declaración Variables --*/
    let valid = true;

    /*-- Validaciones --*/

     // 1. Validar que el campo no esté vacío
    if (!formData.get('categoria').trim()) {
        alert("Por favor, indique el nombre de la categoría.");
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
    if (valid && (formData.get('categoria').trim().length < 3 || formData.get('categoria').trim().length > 50)) {
        alert("El nombre de la categoría debe tener entre 3 y 50 caracteres.");
        valid = false;
    }

    // 4. Validar que no sea solo espacios
    if (valid && (formData.get('categoria').trim().replace(/\s/g, '').length === 0)) {
        alert("El nombre de la categoría no puede estar compuesto solo por espacios.");
        valid = false;
    }

    // 5. Validar palabras prohibidas (opcional)
    const palabrasProhibidas = ["imbecil", "tonto"];
    if (valid && (palabrasProhibidas.some((palabra) => formData.get('categoria').trim().toLowerCase().includes(palabra)))) {
        alert("El nombre contiene palabras no permitidas.");
        valid = false;
    }

    /*-- Confirmación del Usuario --*/ 
    if(valid && confirm("¿Está seguro de que desea registrar esta categoría?")){
        console.log("Validaciones pasadas, verificando existencia de la categoría...");
        console.log(formData.get('categoria'));
        
        // Comprobar si la Categoría ya Existe en el Servidor
        const exists = await verificarCategoria(formData);
        console.log("Resultado de la verificación:", exists);
        if (exists) {
            alert('La categoría ya existe.');
            valid = false;
        }

        /*-- Valid === TRUE | Create FormData + Add Datos + Mostrar Datos By Promesa --*/
        if (valid) {
            console.log("Categoría no existe, procediendo a registrar...");
            const response = await mModificarCategoria(formData);

            if (response && response.ok) {
                console.log("Categoría registrada correctamente");
                return true;
            } else {
                console.log("Error al registrar la categoría");
                return false;
            }
        }
    }
}