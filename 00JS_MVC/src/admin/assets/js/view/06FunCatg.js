/*-- Añadir Evento | Botón Alta Categoría --*/
document.getElementById('altaPais').addEventListener('click', function () {
    window.location.href = 'index.php?controlador=Categoria&accion=formAltaCatg';
});

/*-- Añadir Class | Botones Modificar + Borrar --*/
document.querySelectorAll('tr').forEach(row => {
    const modificarButton = row.querySelector('td:nth-of-type(2) button');
    const borrarButton = row.querySelector('td:nth-of-type(3) button');
    
    if (modificarButton)
        modificarButton.classList.add('modificar');
    
    if (borrarButton)
        borrarButton.classList.add('borrar');

});

/*-- Añadir Evento | Botones Modificar --*/
document.querySelectorAll('.modificar').forEach(button => {
    button.addEventListener('click', function () {
        // Obtener Nombre Catg || closest -> Accede al 'tr' más cercano
        const nombreCatg = button.closest('tr').querySelector('.colNombre').textContent;
        const idCat = button.closest('tr').id;
        window.location.href = `index.php?controlador=Categoria&accion=formModCatg&id=${idCat}`;
    });
});

/*-- Añadir Evento | Botones Borrar [Borrado ID] --*/
document.querySelectorAll('.borrar').forEach(button => {
    button.addEventListener('click', async function () {
        // Obtener ID Catg || closest -> Accede al 'tr' más cercano | id -> Accede al atributo id definido en el 'tr'
        const idCatg = button.closest('tr').id;

        if (confirm('¿Está seguro de que desea borrar este país?')) {
            // Crear FormData | ID
            const formData = new FormData();
            formData.append('id', idCatg);
            console.log(formData.get('id'));

            // Borrar Catg | Promesa -> Fetch + FormData [Llamada Controlador]
            const result = await borrarCategoria(formData);
            if (result)
                location.reload();
            alert(result);
        }
    });
});