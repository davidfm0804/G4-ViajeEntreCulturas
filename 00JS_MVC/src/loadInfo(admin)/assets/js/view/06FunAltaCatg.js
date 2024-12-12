/*-- Añadir Evento | Botón Borrar --*/
document.querySelector('button:nth-of-type(1)').addEventListener('click', function () {
    document.querySelector('[name="categoria"]').value = '';
});

/*-- Añadir Evento | Botón Cancelar --*/
document.querySelector('button:nth-of-type(2)').addEventListener('click', function () {
    window.location.href = 'index.php?controlador=MenuPrincipal&accion=ListadoCategorias';
});

/*-- Añadir Evento | Botón Enviar --*/
document.querySelector('button:nth-of-type(3)').addEventListener('click', async function () {
    /*-- Crear FormData --*/
    const formData = new FormData();
    formData.append('categoria', document.querySelector('[name="categoria"]').value);
    console.log(formData.get('categoria'));

    /*-- Llamada Controlador | Alta Categoría --*/
    const result = await altaCategoria(formData); // Esperar el resultado de la promesa
    console.log(result);
    if (result === "Categoria registrada correctamente") {
        // Crear elementos
        const h2 = document.createElement('h2');
        h2.textContent = 'Datos enviados:';
        h2.style.margin = '4%';

        const pre = document.createElement('pre');
        pre.textContent = result;
        pre.style.margin = '1% 0 4% 6%';

        const buttonAddCategoria = document.createElement('button');
        buttonAddCategoria.id = 'addCatg';
        buttonAddCategoria.style.margin = '2%';
        buttonAddCategoria.className = 'update';
        buttonAddCategoria.textContent = 'Añadir Categoría';

        const buttonVolver = document.createElement('button');
        buttonVolver.id = 'volver';
        buttonVolver.style.display = 'block';
        buttonVolver.style.margin = '2% auto';
        buttonVolver.className = 'cancel';
        buttonVolver.textContent = 'Volver';

        /*-- Sobreescibir Body | Add Elements --*/
        document.body.innerHTML = '';
        document.body.appendChild(h2);
        document.body.appendChild(pre);
        document.body.appendChild(buttonAddCategoria);
        document.body.appendChild(buttonVolver);
        
        /*-- Funcionalidad Botón Añadir Categoría --*/
        document.getElementById('addCatg').addEventListener('click', function() {
            window.location.href = 'index.php?controlador=Categoria&accion=formAltaCatg';
        });
        
        /*-- Funcionalidad Botón Volver --*/
        document.getElementById('volver').addEventListener('click', function() {
            window.location.href = 'index.php?controlador=MenuPrincipal&accion=ListadoCategorias';
        });
        
    }
});