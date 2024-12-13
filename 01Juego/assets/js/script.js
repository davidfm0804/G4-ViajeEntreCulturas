document.getElementById('startGame').addEventListener('click', function() {
  iniciarJuego();
});

let temporizador;
let tiempo = 0;
let cartasVolteadas = [];
let cartasEmparejadas = [];
let puntuacion = 0;
let numFallos = 0;

const paresCartas = {
  'assets/img/espana.jpg': 'assets/img/tortilla.jpg',    
  'assets/img/alemania.jpg': 'assets/img/cerveza.jpg',   
  'assets/img/holanda.jpg': 'assets/img/zueco.jpg',      
  'assets/img/francia.jpg': 'assets/img/croisan.jpg',    
  'assets/img/portugal.jpg': 'assets/img/bacalao.jpg',   
  'assets/img/polonia.jpg': 'assets/img/vodka.jpg',      
};

function iniciarJuego() {
  document.getElementById('startGame').style.display = 'none';
  document.getElementById('tablero').classList.remove('hidden');

  // Inicializar el tablero de cartas
  generarTablero();

  // Iniciar el temporizador
  temporizador = setInterval(function() {
    tiempo++;
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
  }, 2000); // 2 segundos
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
        setTimeout(() => {
          alert('¡Juego Terminado!');
          detenerJuego(tiempo, puntuacion, numFallos);
        }, 100);
      }
    } else {
      setTimeout(function() {
        carta1.style.backgroundImage = ''; // Ocultar la imagen
        carta2.style.backgroundImage = ''; 
        carta1.classList.remove('flipped');
        carta2.classList.remove('flipped');
        cartasVolteadas = [];
        numFallos ++;
        document.getElementById('intentos').textContent = numFallos;
      }, 1000);
    }
  }
}

function detenerJuego(tiempo, puntuacion, numFallos) {
  formData = new FormData();
  formData.append('tiempo',tiempo);
  formData.append('puntuacion',puntuacion);
  formData.append('numFallos',numFallos);

  clearInterval(temporizador);  

  window.location.href = `index.php?controller=Juego&action=registrarPuntuacion&fd=${formData}`;
}
