/*-- Ajustes DOM --*/
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = 'index.php';
});

/*-- Guardar Elementos | LocalStorage --*/
document.getElementById('elcor').addEventListener('click', function(event) {
    // Quitar Evento Default
    event.preventDefault();
    localStorage.setItem('nombrePais', document.querySelector('[name="pais"]').value);
    localStorage.setItem('imgBanderaInput', document.querySelector('[name="subirBandera"]') ? document.querySelector('[name="subirBandera"]') : '');
    localStorage.setItem('imgBanderaActual', document.querySelector("[name='banderaActual']").value);
    localStorage.setItem('idPais', document.querySelector('[name="idPais"]').value);
    window.location.href = `index.php?controlador=Pais&accion=cambiarChincheta&id=${document.querySelector('[name="idPais"]').value}`;
});

/*-- Añadir Evento -> Form --*/
document.querySelector('.update').addEventListener('click', async function(event){

    /*-- Recoger Elementos --*/
    const pais = document.querySelector('[name="pais"]').value;
    const imgBanderaInput = document.querySelector('[name="subirBandera"]') ? document.querySelector('[name="subirBandera"]') : false;
    const coordX = document.querySelector('[name="coordX"]').value;
    const coordY = document.querySelector('[name="coordY"]').value;
    const idPais = document.querySelector('[name="idPais"]').value;

    /*--  Create FormData + Add Datos + Mostrar Datos By Promesa --*/
    const formData = new FormData();

    formData.append('idPais', idPais);
    formData.append('pais', pais);
    formData.append('imgBandera', imgBanderaInput.files[0]);
    formData.append('imgBanderaActual', document.querySelector("[name='banderaActual']").value);
    formData.append('coordX', coordX);
    formData.append('coordY', coordY);

    /*-- Mostrar FormData --*/
    console.log(imgBanderaInput);
    for (let [key, value] of formData.entries()) {
        console.log(key, value);
    }

    /*-- Llamada Controlador | Modificar Pais --*/
    const result = await modificarPais(formData); // Esperar el resultado de la promesa
    console.log(result);

    if (result){
        window.location.href = 'index.php';
        alert(result);
    }
       
});