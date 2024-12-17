const idContinente = document.getElementById('idContinente').value;
const nombreCont = document.getElementById('nombreCont').value;

// Evento para redirigir a la página de añadir chinchetas
document.getElementById('altaPais').addEventListener('click', function () {
    window.location.href = `index.php?controlador=Pais&accion=cMapaChincheta&id=${idContinente}&nombreCont=${nombreCont}`;
});

// Evento para redirigir a la página de mostrar chinchetas
document.getElementById('mostrarChinchetas').addEventListener('click', function () {
    window.location.href = `index.php?controlador=Pais&accion=cMapaChinchetas&idContinente=${idContinente}&nombreCont=${nombreCont}`;
});

// Añadir clases 'modificar' y 'borrar' a los botones de cada fila de la tabla
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

// Añadir evento para los botones de modificar
document.querySelectorAll('.modificar').forEach(button => {
    button.addEventListener('click', function () {
        const nombrePais = button.closest('tr').querySelector('.colNombre').textContent;
        const idPais = button.closest('tr').id;
        window.location.href = `index.php?controlador=Pais&accion=cFormModPais&nombre=${nombrePais}&idPais=${idPais}&idContinente=${idContinente}&nombreCont=${nombreCont}`;
    });
});

// Añadir evento para los botones de borrar
document.querySelectorAll('.borrar').forEach(button => {
    button.addEventListener('click', async function () {
        const idPais = button.closest('tr').id;
        const formData = new FormData();
        formData.append('id', idPais);

        // Aquí se elimina la confirmación
        // if (confirm('¿Está seguro de que desea borrar este país?')) {  <-- Esta línea se comenta o elimina

        // Promesa | Fetch + FormData -> Borrar Pais
        try {
            const response = await fetch(`index.php?controlador=Pais&accion=cBorrarPais`, {
                method: 'POST',
                body: formData,
            });

            // Verificamos si la respuesta del servidor es correcta
            if (response.ok) {
                const result = await response.text();
                location.reload();
                alert(result);
            } else {
                alert('Error al borrar el país');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error en la conexión con el servidor');
        }
    });
});
