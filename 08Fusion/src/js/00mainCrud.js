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

/*-- Añadir Evento | Botones Borrar --*/
document.querySelectorAll('.borrar').forEach(button => {
    button.addEventListener('click', function () {
        if (confirm('¿Está seguro de que desea borrar este país?')) {
            // Ejecutar acción de borrado
            window.location.href = '#.html';
        }
    });
});