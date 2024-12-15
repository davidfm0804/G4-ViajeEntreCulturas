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

// Cargar Chinchetas
async function obtenerInfo(formData) {
    try {
        console.log('formData: ' + formData.get('idCont'));
        const response = await fetch('index.php?controller=Juego&action=obtenerInfoPartida', {
            method: 'POST',
            body: formData
        });
        const infoPartida = await response.json();
        return infoPartida;
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}