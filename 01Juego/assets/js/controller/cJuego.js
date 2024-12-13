// Insert Puntuacion
async function guardarPuntuacion(formData) {
    // Validaciones
    const response = await insertarPuntuacion(formData);

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