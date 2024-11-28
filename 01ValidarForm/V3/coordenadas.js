/*-- Añadir Evento Recoger Coordenadas -> Main - Click --*/
document.getElementById('mainMapa').addEventListener('click', function(event) {
    const x = event.clientX;
    const y = event.clientY;
    document.getElementById('coordenadas').textContent = `(${x}, ${y})`;
    
    // Guardar Coordenadas Navegador
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
    img.style.left = `${x}px`;
    img.style.top = `${y}px`;
    img.style.transform = "translate(-17%, -83%)";
    document.body.appendChild(img);
});

/*-- Añadir Event -> Tecla Enter --*/
document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        window.location.href = './form.html';
    }
});