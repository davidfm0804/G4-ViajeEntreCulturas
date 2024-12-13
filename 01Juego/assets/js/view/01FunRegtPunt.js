// AddEvent | Button Borrar [Borrar Texto Input]
document.querySelector('[type="reset"]').addEventListener('click', function () {
    document.querySelector('[name="nombreJug"]').value = '';
});

// AddEvent | Button Cancelar [Volver Inicio Sin Registrar Puntuación]
document.querySelector('[type="button"]').addEventListener('click', function () {
    window.location.href = './index.php?controller=Juego&action=juegoTablero';
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
    
    try {
        const response = await fetch('index.php?controller=Juego&action=insertarPuntuacion', {
            method: 'POST',
            body: formData,
        });
        if (response.ok) {
            const result = await response.text();
            alert(result);
        } else {
            alert('Error al registrar el puntaje');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en la conexión con el servidor');
    }

    window.location.href = './index.php?controller=Juego&action=verRanking';
});

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