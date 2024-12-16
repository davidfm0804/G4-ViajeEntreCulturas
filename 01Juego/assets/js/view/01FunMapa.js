// Obtener el popup, los botones de abrir y cerrar
const popup = document.getElementById('popup');
const closeBtn = document.getElementById('close-popup');
const openBtn = document.getElementById('open-popup'); // Seleccionamos el botón del interrogante

// Variable global para almacenar la info
let infoPartida = null;

// Función para abrir el popup [Info]
openBtn.addEventListener('click', () => {
  popup.style.display = 'flex'; // Muestra el popup
  document.body.style.overflow = 'hidden'; // Bloquea el scroll al abrir el popup
  document.getElementById('popup-title').textContent = "Ayuda";
  document.getElementById('popup-body').innerHTML = `
    <p>¡Bienvenido a la sección del Mapa!</p>
    <p>Descubre algunos datos curiosos sobre estos paises pulsando en las diferentes chinchetas.</p>
    <p>Una vez hayas terminado, podrás poner a prueba tus conocimientos con un Memory Game. ¡Suerte!</p>
  `;
});

// Cerrar el popup cuando se haga clic en el emoji
closeBtn.addEventListener('click', () => {
  popup.style.display = 'none'; // Oculta el popup
  document.body.style.overflow = 'auto'; // Permitir scroll de nuevo
});

// Bloquear scroll al cargar el popup
document.body.style.overflow = 'hidden';

/*-- Ajustes DOM--*/
document.querySelector('main').style.position = "relative";

/*-- Añadir Eventos - CargarDOM --*/
document.addEventListener('DOMContentLoaded', async function() {
    /*-- Cargar Chinchetas --*/
    // Obtener Coordenadas BBDD By Promesa
    infoPartida = await obtenerPaisesItems();
    console.log(infoPartida);
    // Añadir Chinchetas al DOM
    const mainMapa = document.querySelector('main');
    for (const idPais in infoPartida) {
      const pais = infoPartida[idPais];
      const chincheta = document.createElement('img');
      chincheta.src = './assets/img/web/chinchetaRoja.png';
      chincheta.classList.add('chincheta');
      chincheta.setAttribute('id', idPais);
      chincheta.setAttribute('alt', pais.nombrePais);
      chincheta.style.left = `${pais.coordX}%`;
      chincheta.style.top = `${pais.coordY}%`;
      chincheta.style.transform = "translate(-15%, -75%)";
      console.log(pais.coordX, pais.coordY);
      mainMapa.appendChild(chincheta);
    }
});

/*-- Funcion PopUp Info -> clic chincheta --*/
document.addEventListener('click', async (e) => {
    if(e.target.classList.contains('chincheta')){
        popup.style.display = 'flex'; // Muestra el popup
        document.body.style.overflow = 'hidden'; // Bloquea el scroll al abrir el popup
        const paisInfo = infoPartida[e.target.id];
        console.log(paisInfo.descripcion);
        document.getElementById('popup-title').textContent = `${paisInfo.nombrePais}`;
        document.getElementById('popup-body').innerHTML = `
            <img src="./assets/img/fotos/${paisInfo.imagen}" alt="${paisInfo.nombrePais}" style="width: 60%; height: auto; margin-top: 2%;">
            <p>${paisInfo.descripcion}</p>
        `;
        e.target.src = './assets/img/web/chinchetaVerde.png';
        e.target.style.width = '2.3%';
        e.target.style.transform = 'translate(5%,-90%)';
        comprobarChinchetas();
    }
});

function comprobarChinchetas(){
    let chinchetas = document.querySelectorAll('.chincheta');
    for (i=0; i<chinchetas.length && !chinchetas[i].src.includes('chinchetaRoja.png'); i++);
    if (i===chinchetas.length){
      const btnMemory = document.createElement('button');
      btnMemory.textContent = "Memory Game";
      btnMemory.classList.add('btnMemory');
      btnMemory.addEventListener('click', () => {
        // Almacenar infoPartida en localStorage
        localStorage.setItem('infoPartida', JSON.stringify(infoPartida));
        localStorage.setItem('idCont', getParam('q'));
        window.location.href = "index.php?controller=Juego&action=juegoMemory";
      });
      btnMemory.style.padding = "1%";
      btnMemory.style.display = "block";
      btnMemory.style.margin = "2% auto";
      btnMemory.style.transform = "translateX(0)";
      document.querySelector('main').appendChild(btnMemory);
    }
}

function getParam(param) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(param);
}