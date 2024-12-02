/*-- Ajustes DOM --*/
document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = './mainCrud.php';
});

/*-- Guardar Elementos | LocalStorage --*/
document.getElementById('elcor').addEventListener('click', function(event) {
    // Quitar Evento Default
    event.preventDefault();
    const pais = document.querySelector('[name="pais"]').value;
    const imgBandera = document.querySelector('[name="bandera"]').value;
    const idPais = document.querySelector('[name="idPais"]').value;
    localStorage.setItem('nombrePais', pais);
    localStorage.setItem('imgBandera', imgBandera);
    localStorage.setItem('idPais', idPais);
    window.location.href = '../html/mapaModf.html';
});