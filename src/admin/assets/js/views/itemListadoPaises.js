const idContinente = document.getElementById('idContinente').value;
    const nombreCont = document.getElementById('nombreCont').value;

document.querySelectorAll('tr').forEach(row => {
    const modificarButton = row.querySelector('td:nth-of-type(3) button');
    
    if (modificarButton) {
        modificarButton.classList.add('modificar');
    }
    
});

/*-- Añadir Evento | Botones Modificar --*/
document.querySelectorAll('.modificar').forEach(button => {
    button.addEventListener('click', function () {
        // Obtener Nombre Pais || closest -> Accede al 'tr' más cercano
        const nombrePais = button.closest('tr').querySelector('.colNombre').textContent;
        const idPais = button.closest('tr').id;
        window.location.href = `index.php?controlador=Item&accion=cFormModItems&nombre=${nombrePais}&idPais=${idPais}&idContinente=${idContinente}&nombreCont=${nombreCont}`;
    });
});

