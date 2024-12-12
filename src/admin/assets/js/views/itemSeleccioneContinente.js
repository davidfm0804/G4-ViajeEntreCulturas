document.querySelectorAll('tr').forEach(row => {
    const modificarButton = row.querySelector('td:nth-of-type(2) button');
    
    if (modificarButton) {
        modificarButton.classList.add('modificar');
    }
});

document.querySelectorAll('.modificar').forEach(button => {
    button.addEventListener('click', function () {
        // Obtener Nombre Pais || closest -> Accede al 'tr' más cercano
        const nombreCont = button.closest('tr').querySelector('.colNombre').textContent;
        const idContinente = button.closest('tr').id;
        window.location.href = `index.php?controlador=Item&accion=cListadoPaises&id=${idContinente}&nombreCont=${nombreCont}`;
    });
});