// AddEventListeners | Button ¡A JUGAR!
document.querySelector('[type="submit"]').addEventListener('click', function() {
    valorSelect = document.querySelector('select').value;
    if (valorSelect == 0) {
        alert('Debes seleccionar una opción');
    } else {
        window.location.href = `index.php?controller=Juego&action=mapa&q=${valorSelect}`;
    }
});