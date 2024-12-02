/*-- Añadir Evento | Botón Alta Pais --*/
document.getElementById('altaPais').addEventListener('click', function () {
    window.location.href = './mapaUbiPais.html';
});

/*-- Añadir Class | Botones Modificar + Borrar --*/
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
        window.location.href = './formModificar.html';
    });
});

/*-- Añadir Evento | Botones Borrar [Borrado ID]--*/
document.querySelectorAll('.borrar').forEach(button => {
    button.addEventListener('click', async function () {
        // Obtener ID Pais || closest -> Accede al 'tr' más cercano | id -> Accede al atributo id
        const paisId = button.closest('tr').id;
        const formData = new FormData();
        formData.append('id', paisId);
        if (confirm('¿Está seguro de que desea borrar este país?')) {
            try {
                const response = await fetch ('../src/php/04borrarPais.php',{
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

/*-- Añadir Evento | Botones Borrar [Borrado Nombre]--
document.querySelectorAll('.borrar').forEach(button => {
    button.addEventListener('click', function () {
        const nombrePais = button.closest('tr').querySelector('.colNombre').textContent;
        if (confirm('¿Está seguro de que desea borrar este país?')) {
            window.location.href = `../src/php/vistas/mostrarEliminarPais.php?nombrePais=${nombrePais}`;
        }
    });
});*/