
document.getElementById("formCultura").addEventListener('submit', async function(event){
    // Deshabilitar Submit
    event.preventDefault();

    // Obtener Datos
    const pais = document.getElementById('selectPais').value;
    const descrip = document.getElementById('descripcion').value;
    const img = document.getElementById('imagen').value;
    const cordX = document.getElementById('coordX');
    const cordY = document.getElementById('coordY');

    // Crear Objeto -> Datos Form Validados
    const formData = new FormData();

    // Validar Datos Obtenidos
    if(pais == null || pais == 0){
        console.log('Pais No Seleccionado');
        alert('Pais No Seleccionado');
    }
    else{
        console.log(pais);
        formData.append('pais',pais);
    }

    if(descrip == null || descrip == 0){
        console.log('TextArea Vacia');
        alert('Descripción Vacia');
    }else{
        console.log(descrip);
        formData.append('descrip',descrip);
    }

    vImagen(img);
        
    formData.append('img',img);


    
    /*formData.append('imagen',blob,`Cult${pais}.jpg`);
    formData.append('cordX',cordX);
    formData.append('cordY',cordY);*/

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

    if(!imagen){
        console.log('Archivo No Adjuntado');
        alert('Archivo No Adjuntado');
    }
    else{
        const extensionImg = imagen.substring(imagen.lastIndexOf('.')).toLowerCase();

        if(!formatoAdmitido.includes(extensionImg)){
            console.log('Formato Archivo Incorrecto');
            alert('Formato Archivo Incorrecto');
        }else{
            console.log('Archico Correcto');
        }
            
    }
    

}
