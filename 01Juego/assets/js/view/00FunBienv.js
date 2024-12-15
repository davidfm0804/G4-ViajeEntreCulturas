// addEventListener | Button Borrar
document.querySelector('[type="reset"]').addEventListener('click', function() {
    
    // Seleccionar el option en blanco y hacer que aparezca
    const select = document.querySelector('select');
    const opcWhite = select.querySelector('option[disabled]');
    
    // Seleccionar el option en blanco
    select.value = opcWhite.value;

});

// AddEventListeners | Button ¡A JUGAR!
document.querySelector('[type="submit"]').addEventListener('click', function() {
    valorSelect = document.querySelector('select').value;
    if (valorSelect == 0) {
        alert('Debes seleccionar una opción');
    } else {
        window.location.href = `index.php?controller=Juego&action=mapa&q=${valorSelect}`;
    }
});