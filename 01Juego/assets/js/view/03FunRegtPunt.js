//Poner Puntuación | Onload
document.addEventListener('DOMContentLoaded', function () {
    paramsURL = getParametrosURL();
    document.querySelector('#puntuacion').textContent = paramsURL['puntos'];
});

// AddEvent | Button Borrar [Borrar Texto Input]
document.querySelector('[type="reset"]').addEventListener('click', function () {
    document.querySelector('[name="nombreJug"]').value = '';
});

// AddEvent | Button Cancelar [Volver Inicio Sin Registrar Puntuación]
document.querySelector('[type="button"]').addEventListener('click', function () {
    window.location.href = './index.php?controller=Juego&action=juegoMemory';
});

// AddEvent | Button Enviar [Registrar Puntuación]
document.querySelector('[type="submit"]').addEventListener('click', async function () {

    const paramsURL = getParametrosURL();

    formData = new FormData();

    formData.append('nombre', document.querySelector('[name="nombreJug"]').value);
    console.log(formData.get('nombreJug'));
    
    for (const nameParam in paramsURL) {
        console.log(`Clave: ${nameParam}, Valor: ${paramsURL[nameParam]}`);
        formData.append(nameParam, paramsURL[nameParam]);
        console.log(formData.get(nameParam));
    }

    const validation = validarNombre(formData);

    if (!validation.valid) {
        alert(validation.error);
    }else{
        try {
            const response = await fetch('index.php?controller=Juego&action=insertarPuntuacion', {
                method: 'POST',
                body: formData,
            });
            if (!response.ok) {
                alert('Error al registrar el puntaje');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error en la conexión con el servidor');
        }
    
        window.location.href = `./index.php?controller=Juego&action=verRanking&idCont=${formData.get('idCont')}`;
    }
    
});

function validarNombre(formData) {
    let valid = true;
    let error = '';

    // 1. Validar que el campo no esté vacío
    if (!formData.get('nombre').trim()) {
        error = "Por favor, indique su nombre.";
        valid = false;
    }
    
    // 2. Validar que solo contenga letras y espacios
    else {
        const regex = /^[A-Za-záéíóúÁÉÍÓÚüÜ1234567890\s]+$/;
        if (!regex.test(formData.get('nombre').trim())) {
            error = "El nombre solo puede contener letras y espacios.";
            valid = false;
        }
    }

    // 3. Validar la longitud mínima y máxima
    if (valid && (formData.get('nombre').trim().length < 3 || formData.get('nombre').trim().length > 50)) {
        error = "El nombre debe tener entre 3 y 50 caracteres.";
        valid = false;
    }

    // 4. Validar que no sea solo espacios
    if (valid && (formData.get('nombre').trim().replace(/\s/g, '').length === 0)) {
        error = "El nombre no puede estar compuesto solo por espacios.";
        valid = false;
    }

    // 5. Validar palabras prohibidas (opcional)
    const palabrasProhibidas = ["imbecil", "tonto"];
    if (valid && (palabrasProhibidas.some((palabra) => formData.get('nombre').trim().toLowerCase().includes(palabra)))) {
        error = "El nombre contiene palabras no permitidas.";
        valid = false;
    }

    return { valid, error };
}

// Recoger Parametros URL
function getParametrosURL() {
    const secretKey = "DWEC2024";
    const params = {};

    // window.location.search -> "?key1=value1&key2=value2" | substring(1) -> "key1=value1&key2=value2"
    // ?controller=Juego&action=registrarPuntuacion&tiempo=14&puntos=500&numFallos=3&idCont=5
    const url = window.location.search.substring(1);

    // Quitar Controller y Action de URL
    // tiempo=14&puntos=500&numFallos=3&idCont=5

    // Encontrar la posición del primer &
    const posFirst = url.indexOf("&");

    // Encontrar la posición del segundo &
    const postSecond = url.indexOf("&", posFirst + 1);

    // Extraer la subcadena desde el segundo &
    urlParams = url.substring(postSecond + 1);
    console.log(urlParams); // "tiempo=14&puntos=500&numFallos=3&idCont=5"

    // "key1=value1&key2=value2" -> ["key1=value1", "key2=value2"]
    const keysValues = urlParams.split("&");

    // ["key1=value1", "key2=value2"] -> { key1: "value1", key2: "value2" }
    for (const keyValue of keysValues) {
        const [key, value] = keyValue.split("=");
        // decodeURIComponent -> "nombre%20jugador" - "nombre jugador"
        const decodedKey = decodeURIComponent(key);
        const decodedValue = decodeURIComponent(value || "");

        // Desencriptar Datos
        const decryptedValue = CryptoJS.AES.decrypt(decodedValue, secretKey).toString(CryptoJS.enc.Utf8);
        params[decodedKey] = decryptedValue;
    }

    return params;
}