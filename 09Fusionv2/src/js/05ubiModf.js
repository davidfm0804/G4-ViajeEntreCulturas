document.querySelector('main').style.position = "relative";
/*-- Añadir Evento Recoger Coordenadas -> IMG - Click --*/
document.getElementById('mapa').addEventListener('click', function(event) {
    const mapa = document.getElementById('mapa');
    const rect = mapa.getBoundingClientRect();
    const x = parseFloat((((event.clientX - rect.left) / rect.width) * 100).toFixed(6));
    const y = parseFloat((((event.clientY - rect.top) / rect.height) * 100).toFixed(6));
    console.log(x,y);
    // Guardar Coordenadas Navegador - [6 Decimales]
    localStorage.setItem('coordX', x);
    localStorage.setItem('coordY', y);

    // Eliminar la chincheta anterior si existe
    const chinchetaAnterior = document.getElementById('chincheta');
    if (chinchetaAnterior) 
        chinchetaAnterior.remove();

    // Crear y posicionar la imagen en las coordenadas del click
    const chincheta = document.createElement("img");
    chincheta.id = "chincheta";
    chincheta.classList.add('chincheta');
    chincheta.src = "../src/img/chincheta.png";
    chincheta.style.position = "absolute";
    chincheta.style.left = `${x}%`;
    chincheta.style.top = `${y}%`;
    chincheta.style.transform = "translate(-15%, -75%)";
    document.querySelector('main').append(chincheta);
});

/*-- Añadir Event -> Tecla Enter --*/
document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        window.location.href = './formModificar.php';
    }
});