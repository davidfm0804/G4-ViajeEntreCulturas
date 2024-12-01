document.querySelector('main').style.position = "relative";
console.log('hola1');
/*-- Añadir Evento Ubicar Chinchetas -> Chinchetas - CargarDOM --*/
document.addEventListener('DOMContentLoaded', async function() {
    // Obtener Coordenadas BBDD By Promesa
    try {
        const response = await fetch('./03obtenerCoordenadas.php');
        const coordenadas = await response.json();
        const mainMapa = document.querySelector('main');
        coordenadas.forEach(coord => {
            const chincheta = document.createElement('img');
            chincheta.src = '../img/chincheta.png';
            chincheta.classList.add('chincheta');
            chincheta.style.left = `${coord.coordX}%`;
            chincheta.style.top = `${coord.coordY}%`;
            chincheta.style.transform = "translate(-15%, -75%)";
            console.log(coord.coordX, coord.coordY);
            mainMapa.appendChild(chincheta);
        });
        console.log('hola2');

    } catch (error) {
        console.error('Error:', error);
        console.log('hola2');
    }
});