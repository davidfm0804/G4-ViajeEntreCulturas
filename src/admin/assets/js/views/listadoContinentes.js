/*-- Añadir Evento | Botón Alta Pais --*/
document.getElementById('altaPais').addEventListener('click', function () {
    window.location.href = 'index.php?controlador=Continente&accion=cFormAltaContinente';
});

/*-- Añadir Evento | Botones Modificar --*/
document.querySelectorAll('.modificar').forEach(button => {
    button.addEventListener('click', function () {
        // Obtener Nombre Pais || closest -> Accede al 'tr' más cercano
        const nombreCont = button.closest('tr').querySelector('.colNombre').textContent;
        const idContinente = button.closest('tr').id;
        window.location.href = `index.php?controlador=Continente&accion=cFormModContinente&id=${idContinente}`;
    });
});

document.querySelectorAll('.borrar').forEach(button => {
    button.addEventListener('click', async function () {
        // Obtener ID Pais || closest -> Accede al 'tr' más cercano | id -> Accede al atributo id definido en el 'tr'
        const idContinente = button.closest('tr').id;
        const formData = new FormData();
        formData.append('idContinente', idContinente);
        if (confirm('¿Está seguro de que desea borrar este país?')) {
            // Promesa | Fetch + FormData -> Borrar Pais
            try {
                const response = await fetch (`index.php?controlador=Continente&accion=cBorrarContinente`,{
                    method: 'POST',
                    body: formData,
                });
        
                //Verificamos si la respuesta del server es correcta
                if(response.ok){
                    const result = await response.text();
                    location.reload();
                    alert(result);
                }else
                    alert('Error al borrar el país');
            } catch (error) {
                console.error('Error:', error);
                alert('Error en la conexión con el servidor');
            }
        }
    });
});