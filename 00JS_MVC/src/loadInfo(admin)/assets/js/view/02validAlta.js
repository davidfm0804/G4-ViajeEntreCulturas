/*-- Ajustes DOM --*/
document.querySelector('main').style.position = "relative";
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = 'index.php';
});

/*-- Dar Valor Inputs Coordenadas [localStorage] --*/
document.querySelector('[name="coordenada_x"]').value = localStorage.getItem('coordX');
document.querySelector('[name="coordenada_y"]').value = localStorage.getItem('coordY');

/*-- Añadir Evento -> Form --*/
document.querySelector('.update').addEventListener('click', async function(event){
    event.preventDefault(); // Evitar el envío del formulario por defecto

    /*-- Recoger Elementos --*/
    const pais = document.querySelector('[name="pais"]');
    const imgBandera = document.querySelector('[name="bandera"]');
    const coordX = document.querySelector('[name="coordenada_x"]');
    const coordY = document.querySelector('[name="coordenada_y"]');

    /*-- FormData --*/
    const formData = new FormData();
    formData.append('pais', pais.value);
    formData.append('imgBandera', imgBandera.files[0]);
    formData.append('coordX', coordX.value);
    formData.append('coordY', coordY.value);
    
    /*-- Llamada Controlador | Alta Pais --*/
    const result = await altaPais(formData); // Esperar el resultado de la promesa
    console.log(result);
    if (result){
        // Crear elementos
        const h2 = document.createElement('h2');
        h2.textContent = 'Datos enviados:';
        h2.style.margin = '4%';

        const pre = document.createElement('pre');
        pre.textContent = "Nuevo registro creado exitosamente";
        pre.style.margin = '1% 0 4% 6%';

        const buttonMostrarMapa = document.createElement('button');
        buttonMostrarMapa.id = 'mostrarMapa';
        buttonMostrarMapa.style.margin = '2%';
        buttonMostrarMapa.className = 'update';
        buttonMostrarMapa.textContent = 'Mostrar paises en el mapa';

        const buttonAddCultura = document.createElement('button');
        buttonAddCultura.id = 'addCultura';
        buttonAddCultura.style.margin = '2%';
        buttonAddCultura.className = 'update';
        buttonAddCultura.textContent = 'Añadir Pais';

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
        document.body.appendChild(buttonMostrarMapa);
        document.body.appendChild(buttonAddCultura);
        document.body.appendChild(buttonVolver);

        /*-- Funcionalidad Botón Mostrar Mapa --*/
        document.getElementById('mostrarMapa').addEventListener('click', function() {
            window.location.href = 'index.php?controlador=Pais&accion=mapaChincheta&script=03cargarCoord.js';
        });
        
        /*-- Funcionalidad Botón Añadir Cultura --*/
        document.getElementById('addCultura').addEventListener('click', function() {
            window.location.href = 'index.php?controlador=Pais&accion=mapaChincheta';
        });
        
        /*-- Funcionalidad Botón Volver --*/
        document.getElementById('volver').addEventListener('click', function() {
            window.location.href = 'index.php';
        });
        
    }
            
    // Borrar Coordenadas localStorage
    localStorage.removeItem('coordX');
    localStorage.removeItem('coordY');

});