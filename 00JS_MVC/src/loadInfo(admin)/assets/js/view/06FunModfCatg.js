/*-- Añadir Evento | Botón Borrar --*/
document.querySelector('button:nth-of-type(1)').addEventListener('click', function () {
    document.querySelector('[name="nombreCatg"]').value = '';
});

/*-- Añadir Evento | Botón Cancelar --*/
document.querySelector('button:nth-of-type(2)').addEventListener('click', function () {
    window.location.href = 'index.php?controlador=MenuPrincipal&accion=ListadoCategorias';
});

/*-- Añadir Evento | Botón Enviar --*/
document.querySelector('button:nth-of-type(3)').addEventListener('click', async function () {
    /*-- Crear FormData --*/
    const formData = new FormData();
    formData.append('idCat', document.querySelector('[name="idCat"]').value);
    formData.append('categoria', document.querySelector('[name="categoria"]').value);
    console.log(formData.get('categoria'));
    console.log(formData.get('idCat'));

    /*-- Llamada Controlador | Modifcar Categoría --*/
    const result = await modificarCategoria(formData); // Esperar el resultado de la promesa
    console.log(result);
    alert(result);
    window.location.href = 'index.php?controlador=MenuPrincipal&accion=ListadoCategorias'; 
});