/*-- Añadir Evento Recoger Coordenadas -> IMG - Click --*/
document.getElementById('mapa').addEventListener('click', function(event) {
    const mapa = document.getElementById('mapa');
    const rect = mapa.getBoundingClientRect();
    const nav = document.querySelector('nav').getBoundingClientRect();
    const x = parseFloat((((event.clientX - rect.left) / rect.width) * 100).toFixed(6));
    const y = parseFloat((((event.clientY - rect.top) / rect.height) * 100).toFixed(6));
    
    document.getElementById('coordenadas').textContent = `(${x}, ${y})`;
    
    // Guardar Coordenadas Navegador - [2 Deciamles]
    localStorage.setItem('coordX', x);
    localStorage.setItem('coordY', y);

    // Eliminar la chincheta anterior si existe
    const chinchetaAnterior = document.getElementById('chincheta');
    if (chinchetaAnterior) 
        chinchetaAnterior.remove();

    // Crear y posicionar la imagen en las coordenadas del click
    const img = document.createElement("img");
    img.id = "chincheta";
    img.src = "./img/chincheta.png";
    img.style.position = "absolute";
    img.style.left = `${x}%`;
    img.style.top = `${y}%`;
    img.style.transform = "translate(-15%, -88%)";
    document.querySelector('main').appendChild(img);
});

/*-- Añadir Event -> Tecla Enter --*/
document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        window.location.href = './02form.html';
    }
});