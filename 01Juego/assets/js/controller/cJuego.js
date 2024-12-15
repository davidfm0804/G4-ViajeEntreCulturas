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

// Cargar Chinchetas
async function obtenerPaisesItems() {
    function getParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    const formData = new FormData();
    formData.append('idCont', getParam('q'));
    console.log('formData: ' + formData.get('idCont'));

    const infoPartida = await obtenerInfo(formData);

    if (infoPartida) {
        return infoPartida;
    } else {
        console.log("Error al cargar las coordenadas");
        return false;
    }
}

// Cargar Item
async function datoItem(idPais) {
    const formData = new FormData();
    formData.append('idPais', idPais);

    const item = await obtenerItem(formData);

    if (item) {
        return item;
    } else {
        console.log("Error al cargar el item");
        return false;
    }
}