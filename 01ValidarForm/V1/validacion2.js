document.getElementById("formCultura").addEventListener('submit', async function(event){
    // Deshabilitar Submit
    event.preventDefault();
    
    const form = document.getElementById('formCultura');
    const pais = form.pais.value;
    const descrip = form.descrip.value;
    const img = form.img;
    const coordX = form.coordX.value;
    const coordY = form.coordY.value;
    
    if (!pais) {
        alert("Por favor selecciona un país.");
        return false;
    }

    if (!descrip) {
        alert("Por favor ingresa una descripción.");
        return false;
    }

    if (!vImagen(img)) {
        alert("Por favor selecciona un archuivo válido.");
        return false;
    } else if (!img.type.startsWith('image/')) {
        alert("El archivo seleccionado no es una imagen.");
        return false;
    }

    if (!coordX || !coordY) {
        alert("Por favor ubica la cultura en el mapa.");
        return false;
    }

    try {
        const response = await fetch ('mostrarDatos.php',{
            method: 'POST',
            body: formData,
        });

        // Verificamos si la respuesta del server es correcta
        if(response.ok){
            const result = await response.text();
            document.getElementById('resultado').innerText = `Datos: ${result}`;
        }else
            document.getElementById('resultado').innerText = `Error al enviar los datos`;
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('resultado').innerText = 'Error de conexión';
    }
})
function vImagen(imagen){
    const formatoAdmitido = ['.jpg', '.png', '.jpeg'];

    if(!imagen)
        console.log('Archivo No Adjuntado');

    const extensionImg = imagen.substring(imagen.lastIndexOf('.')).toLowerCase();

    if(!formatoAdmitido.includes(extensionImg))
        console.log('Formato Archivo Incorrecto');
    else
        console.log('Formato Correcto');

}