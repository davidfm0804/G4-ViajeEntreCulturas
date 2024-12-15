const idContinente = document.getElementById('idContinente').value;
    const nombreCont = document.getElementById('nombreCont').value;

document.querySelector('main').style.position = "relative";
/*-- Funcion Ubicar Chinchetas -> Chinchetas - CargarDOM --*/
async function mostrarChinchetas() {
    // Obtener Coordenadas BBDD By Promesa
    try {
        const response = await fetch(`index.php?controlador=Pais&accion=cMostrarChinchetas&idContinente=${idContinente}&nombreCont=${nombreCont}`);
        const coordenadas = await response.json();
        const mainMapa = document.querySelector('main');
        coordenadas.forEach(coord => {
            const chincheta = document.createElement('img');
            chincheta.src = 'assets/img/chincheta.png';
            chincheta.classList.add('chincheta');
            chincheta.style.left = `${coord.coordX}%`;
            chincheta.style.top = `${coord.coordY}%`;
            chincheta.style.transform = "translate(-15%, -75%)";
            console.log(coord.coordX, coord.coordY);
            mainMapa.appendChild(chincheta);
        });
    } catch (error) {
        console.error('Error:', error);
    }
}

mostrarChinchetas();