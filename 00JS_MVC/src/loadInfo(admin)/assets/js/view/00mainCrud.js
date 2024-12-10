//import { borrarPais } from '../controller/cPais.js';

/*-- Añadir Evento | Botón Alta Pais --*/
document.getElementById('altaPais').addEventListener('click', function () {
    window.location.href = 'index.php?controlador=Pais&accion=mapaChincheta';
});

/*-- Añadir Class | Botones Modificar + Borrar --*/
document.querySelectorAll('tr').forEach(row => {
    const modificarButton = row.querySelector('td:nth-of-type(3) button');
    const borrarButton = row.querySelector('td:nth-of-type(4) button');
    
    if (modificarButton)
        modificarButton.classList.add('modificar');
    
    if (borrarButton)
        borrarButton.classList.add('borrar');

});

/*-- Añadir Evento | Botones Modificar --*/
document.querySelectorAll('.modificar').forEach(button => {
    button.addEventListener('click', function () {
        // Obtener Nombre Pais || closest -> Accede al 'tr' más cercano
        const nombrePais = button.closest('tr').querySelector('.colNombre').textContent;
        const codPais = button.closest('tr').id;
        window.location.href = `index.php?controlador=Pais&accion=formModPais&id=${codPais}`;
    });
});

/*-- Añadir Evento | Botones Borrar [Borrado ID] --*/
document.querySelectorAll('.borrar').forEach(button => {
    button.addEventListener('click', async function () {
        // Obtener ID Pais || closest -> Accede al 'tr' más cercano | id -> Accede al atributo id definido en el 'tr'
        const codPais = button.closest('tr').id;

        if (confirm('¿Está seguro de que desea borrar este país?')) {
            // Crear FormData | ID
            const formData = new FormData();
            formData.append('id', codPais);

            // Borrar Pais | Promesa -> Fetch + FormData [Llamada Controlador]
            const result = await borrarPais(formData);
            if (result)
                location.reload();
            alert(result);
        }
    });
});