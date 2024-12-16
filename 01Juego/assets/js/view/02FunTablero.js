document.getElementById('startGame').addEventListener('click', function() {
  iniciarJuego();
});

const infoPartida = JSON.parse(localStorage.getItem('infoPartida'));
console.log(infoPartida);
const rutaBanderas = 'assets/img/banderas/';
const rutaFotos = 'assets/img/fotos/';
const tiempoDefinido = 60;
const tiempoMostrarCartas = 4;

let temporizador;
let tiempo = tiempoDefinido;
let cartasVolteadas = [];
let cartasEmparejadas = [];
let puntuacion = 0;
let numFallos = 0;

const paresCartas = {};
for (const idPais in infoPartida) {
  if (infoPartida.hasOwnProperty(idPais)) {
    const pais = infoPartida[idPais];
    paresCartas[`${rutaBanderas}${pais.bandera}`] = `${rutaFotos}${pais.imagen}`;
  }
}

function iniciarJuego(infoPartida) {
  document.getElementById('startGame').style.display = 'none';
  document.getElementById('tablero').classList.remove('hidden');

  // Inicializar el tablero de cartas
  generarTablero();

  // Iniciar el temporizador
  temporizador = setInterval(function() {
    tiempo--;
    if (tiempo === 0) gameOver(); 
    document.getElementById('contador').textContent = tiempo;
  }, 1000);

  puntuacion = 0;
  document.getElementById('puntuacion').textContent = puntuacion;
}

function generarTablero() {
  const cartas = [...Object.keys(paresCartas), ...Object.values(paresCartas)];

  // Mezclar las cartas
  let cartasMezcladas = mezclar(cartas);

  const tablero = document.getElementById('tablero');
  tablero.innerHTML = ''; 

  // Crear las cartas
  cartasMezcladas.forEach((value, id) => {
    const carta = document.createElement('button');
    carta.classList.add('card');
    carta.id = id;
    carta.value = value; 
    carta.addEventListener('click', voltearCarta);
    tablero.appendChild(carta);
  });

  // Mostrar todas las cartas con la imagen visible durante 2 segundos
  const todasLasCartas = document.querySelectorAll('.card');
  todasLasCartas.forEach(carta => {
    const valorCarta = carta.value;
    carta.style.backgroundImage = `url(${valorCarta})`; 
    carta.classList.add('flipped');
  });

  // Después de 2 segundos, voltear todas las cartas
  setTimeout(function() {
    todasLasCartas.forEach(carta => {
      carta.style.backgroundImage = ''; 
      carta.classList.remove('flipped'); 
    });
  }, tiempoMostrarCartas*1000); // 2 segundos
}

// Mezclar las cartas aleatoriamente
function mezclar(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]]; 
  }
  return array;
}

// Función para voltear las cartas
function voltearCarta() {
  const carta = this;
  if (carta.classList.contains('flipped') || cartasVolteadas.length === 2) return;

  const valorCarta = carta.value;
  carta.style.backgroundImage = `url(${valorCarta})`; 
  carta.classList.add('flipped');
  cartasVolteadas.push(carta);

  // Verificar si las dos cartas coinciden
  if (cartasVolteadas.length === 2) {
    const [carta1, carta2] = cartasVolteadas;

    const valorCarta1 = carta1.value;
    const valorCarta2 = carta2.value;

    // Comprobar si las cartas son una pareja (bandera y su objeto correspondiente)
    if (paresCartas[valorCarta1] === valorCarta2 || paresCartas[valorCarta2] === valorCarta1) {
      cartasEmparejadas.push(carta1, carta2);
      cartasVolteadas = [];
      puntuacion += 100;
      document.getElementById('puntuacion').textContent = puntuacion;
  
      if (cartasEmparejadas.length === Object.keys(paresCartas).length * 2) {
        deshabilitarTablero();
        h1WinnerGameOver('¡Winner!');
        setTimeout(() => {
          stopJuego(tiempo, puntuacion, numFallos);
        }, 3500);
      }
    } else {
      setTimeout(function() {
        carta1.style.backgroundImage = ''; // Ocultar la imagen
        carta2.style.backgroundImage = ''; 
        carta1.classList.remove('flipped');
        carta2.classList.remove('flipped');
        cartasVolteadas = [];
        numFallos ++;
        if (puntuacion > 0) puntuacion -= 50;
        document.getElementById('intentos').textContent = numFallos;
        document.getElementById('puntuacion').textContent = puntuacion;
      }, 1000);
    }
  }
}

function stopJuego(tiempo, puntuacion, numFallos) {
  // Contraseña -> Encriptar Datos
  const secretKey = "DWEC2024";

  // Calcular el tiempo que ha tardado en completar el juego
  tiempo = tiempoDefinido - tiempo;

  // Encriptar Datos
  const encryptedTiempo = CryptoJS.AES.encrypt(tiempo.toString(), secretKey).toString();
  const encryptedPuntuacion = CryptoJS.AES.encrypt(puntuacion.toString(), secretKey).toString();
  const encryptedNumFallos = CryptoJS.AES.encrypt(numFallos.toString(), secretKey).toString();
  const encryptedIdCont = CryptoJS.AES.encrypt(localStorage.getItem('idCont'), secretKey).toString();

  clearInterval(temporizador);

  // encodeURIComponent -> "nombre jugador" - "nombre%20jugador"
  window.location.href = `index.php?controller=Juego&action=registrarPuntuacion&tiempo=${encodeURIComponent(encryptedTiempo)}&puntos=${encodeURIComponent(encryptedPuntuacion)}&numFallos=${encodeURIComponent(encryptedNumFallos)}&idCont=${encodeURIComponent(encryptedIdCont)}`;
}

function gameOver() {
  clearInterval(temporizador);

  deshabilitarTablero();
  h1WinnerGameOver('¡Game Over!');

  const btnReiniciar = document.createElement('button');
  btnReiniciar.textContent = 'Nueva Partida';
  btnReiniciar.style.padding = '1%';
  btnReiniciar.addEventListener('click', function() {
    document.body.removeChild(document.getElementById('h1WinGmOv'));
    document.body.removeChild(btnReiniciar);
    document.body.removeChild(btnRanking);
    inicializarJuego();
    iniciarJuego();
  });

  const btnRanking = document.createElement('button');
  btnRanking.textContent = 'Ver Ranking';
  btnRanking.style.padding = '1%';
  btnRanking.addEventListener('click', function() {
    window.location.href = 'index.php?controller=Juego&action=verRanking&idCont=5';
  });

  document.body.appendChild(btnReiniciar);
  document.body.appendChild(btnRanking);
}

function inicializarJuego() {
  clearInterval(temporizador);
  tiempo = tiempoDefinido;
  puntuacion = 0;
  numFallos = 0;
  cartasVolteadas = [];
  cartasEmparejadas = [];
  document.getElementById('contador').textContent = tiempo;
  document.getElementById('puntuacion').textContent = puntuacion;
  document.getElementById('intentos').textContent = numFallos;
  document.getElementById('tablero').classList.add('hidden');
  document.getElementById('startGame').style.display = 'block';
}

function h1WinnerGameOver(title){
  const h1 = document.createElement('h1');
  h1.textContent = title;
  h1.id = 'h1WinGmOv';
  h1.style.fontSize = '3rem';
  h1.style.textShadow = '2px 2px 5px red';
  h1.style.position = 'absolute';
  h1.style.top = '50%';
  h1.style.left = '50%';
  h1.style.transform = 'translate(-50%, -50%)';
  h1.style.animation = 'parapadeo 1s infinite'; // Añadir animación de parpadeo
  document.body.appendChild(h1);
}

function deshabilitarTablero(){
  const todasLasCartas = document.querySelectorAll('.card');
  todasLasCartas.forEach(carta => {
    carta.classList.add('disabled');
  });
}