document.addEventListener('click', function(event) {
    const x = event.clientX;
    const y = event.clientY;
    document.getElementById('coordenadas').textContent = `Coordenadas: (${x}, ${y})`;
});