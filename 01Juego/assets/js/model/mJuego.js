// Insert Puntuacion
async function insertarPuntuacion(formData) {
    // Validaciones
    try {
        const response = await fetch('index.php?controller=Juego&action=insertarPuntuacion', {
            method: 'POST',
            body: formData
        });

        return response;

    } catch (error) {
        return false;
    }
}