/*-- Ajustes DOM --*/
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = 'index.php';
});

document.querySelector('#elcor').style.display = 'none';

/*-- Dar Valor Elementos Form --*/
document.querySelector('[name="pais"]').value = localStorage.getItem('nombrePais');
document.querySelector("[name='banderaActual']").value = localStorage.getItem('imgBanderaActual');
document.querySelector('[name="idPais"]').value = localStorage.getItem('idPais');

/*-- Añadir Evento -> Form --*/
document.querySelector('.update').addEventListener('click', async function(event){

    /*-- Recoger Elementos --*/
    const pais = document.querySelector('[name="pais"]').value;
    const imgBanderaInput = document.querySelector('[name="subirBandera"]') ? document.querySelector('[name="subirBandera"]') : localStorage.getItem('imgBanderaInput');
    const coordX = localStorage.getItem('coordX');
    const coordY = localStorage.getItem('coordY');
    const idPais = document.querySelector('[name="idPais"]').value;

    /*-- Create FormData + Add Datos + Mostrar Datos By Promesa --*/
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