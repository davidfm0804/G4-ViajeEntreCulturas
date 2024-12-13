document.getElementById('startGame').addEventListener('click', function() {
  startGame();
});

let timer;
let time = 0;
let flippedCards = [];
let matchedCards = [];

const cardPairs = {
  'assets/img/espana.jpg': 'assets/img/tortilla.jpg',    
  'assets/img/alemania.jpg': 'assets/img/cerveza.jpg',   
  'assets/img/holanda.jpg': 'assets/img/zueco.jpg',      
  'assets/img/francia.jpg': 'assets/img/croisan.jpg',    
  'assets/img/portugal.jpg': 'assets/img/bacalao.jpg',   
  'assets/img/polonia.jpg': 'assets/img/vodka.jpg',      
};

function startGame() {
  document.getElementById('startGame').style.display = 'none';
  document.getElementById('tablero').classList.remove('hidden');

  // Inicializar el tablero de cartas
  generateBoard();

  // Iniciar el temporizador
  timer = setInterval(function() {
    time++;
    document.getElementById('contador').textContent = time;
  }, 1000);
}

function generateBoard() {
  const cards = [...Object.keys(cardPairs), ...Object.values(cardPairs)];

  // Mezclar las cartas
  let shuffled = shuffle(cards);

  const board = document.getElementById('tablero');
  board.innerHTML = ''; 

  // Crear las cartas
  shuffled.forEach((cardValue, index) => {
    const card = document.createElement('button');
    card.classList.add('card');
    card.id = index;
    card.value = cardValue; 
    card.addEventListener('click', flipCard);
    board.appendChild(card);
  });

  // Mostrar todas las cartas con la imagen visible durante 2 segundos
  const allCards = document.querySelectorAll('.card');
  allCards.forEach(card => {
    const cardValue = card.value;
    card.style.backgroundImage = `url(${cardValue})`; 
    card.classList.add('flipped');
  });

  // Después de 2 segundos, voltear todas las cartas
  setTimeout(function() {
    allCards.forEach(card => {
      card.style.backgroundImage = ''; 
      card.classList.remove('flipped'); 
    });
  }, 2000); // 2 segundos
}

// Mezclar las cartas aleatoriamente
function shuffle(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]]; 
  }
  return array;
}

// Función para voltear las cartas
function flipCard() {
  const card = this;
  if (card.classList.contains('flipped') || flippedCards.length === 2) return;

  const cardValue = card.value;
  card.style.backgroundImage = `url(${cardValue})`; 
  card.classList.add('flipped');
  flippedCards.push(card);

  // Verificar si las dos cartas coinciden
  if (flippedCards.length === 2) {
    const [card1, card2] = flippedCards;

    const card1Value = card1.value;
    const card2Value = card2.value;

    // Comprobar si las cartas son una pareja (bandera y su objeto correspondiente)
    if (cardPairs[card1Value] === card2Value || cardPairs[card2Value] === card1Value) {
      matchedCards.push(card1, card2);
      flippedCards = [];
  
      if (matchedCards.length === Object.keys(cardPairs).length * 2) {
        setTimeout(() => {
          alert('¡Juego Terminado!');
          stopGame();
        }, 100);
      }
    } else {
      setTimeout(function() {
        card1.style.backgroundImage = ''; // Ocultar la imagen
        card2.style.backgroundImage = ''; 
        card1.classList.remove('flipped');
        card2.classList.remove('flipped');
        flippedCards = [];
      }, 1000);
    }
  }
}

function stopGame() {
  clearInterval(timer);
  // document.getElementById('startGame').style.display = 'block';
  // document.getElementById('tablero').classList.add('hidden');
  // window.location.href = 'index.html?controller=Juego&action=regPunt';
  window.location.href = './view/registroPuntuacion.html';
}
