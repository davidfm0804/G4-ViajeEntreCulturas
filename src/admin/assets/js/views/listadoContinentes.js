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