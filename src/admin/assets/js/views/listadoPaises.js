const idContinente = document.getElementById('idContinente').value;
    const nombreCont = document.getElementById('nombreCont').value;

document.getElementById('altaPais').addEventListener('click', function () {
    window.location.href = `index.php?controlador=Pais&accion=cMapaChincheta&id=${idContinente}&nombreCont=${nombreCont}`;
});

document.querySelectorAll('tr').forEach(row => {
    const modificarButton = row.querySelector('td:nth-of-type(3) button');
    const borrarButton = row.querySelector('td:nth-of-type(4) button');
    
    if (modificarButton) {
        modificarButton.classList.add('modificar');
    }
    
    if (borrarButton) {
        borrarButton.classList.add('borrar');
    }
});

/*-- Añadir Evento | Botones Modificar --*/
document.querySelectorAll('.modificar').forEach(button => {
    button.addEventListener('click', function () {
        // Obtener Nombre Pais || closest -> Accede al 'tr' más cercano
        const nombrePais = button.closest('tr').querySelector('.colNombre').textContent;
        const idPais = button.closest('tr').id;
        window.location.href = `index.php?controlador=Pais&accion=cFormModPais&nombre=${nombrePais}&idPais=${idPais}&idContinente=${idContinente}&nombreCont=${nombreCont}`;
    });
});

/*-- Añadir Evento | Botones Borrar [Borrado ID] --*/
document.querySelectorAll('.borrar').forEach(button => {
    button.addEventListener('click', async function () {
        // Obtener ID Pais || closest -> Accede al 'tr' más cercano | id -> Accede al atributo id definido en el 'tr'
        const codPais = button.closest('tr').id;
        const formData = new FormData();
        formData.append('id', codPais);
        if (confirm('¿Está seguro de que desea borrar este país?')) {
            // Promesa | Fetch + FormData -> Borrar Pais
            try {
                const response = await fetch ('../04borrarPais.php',{
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