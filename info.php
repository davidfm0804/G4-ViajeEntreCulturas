<?php
// filepath: /e:/xampp/htdocs/PRYCTgit/G4-ViajeEntreCulturas/01Juego/api/getParesCartas.php

// Configuración de la base de datos
require_once '../config/config.php';

$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener los pares de cartas
$sql = "
    SELECT img1.ruta AS imagen1, img2.ruta AS imagen2
    FROM tabla_imagenes1 AS img1
    JOIN tabla_imagenes2 AS img2 ON img1.id_pais = img2.id_pais
";
$result = $conexion->query($sql);

$paresCartas = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $paresCartas[$row['imagen1']] = $row['imagen2'];
    }
}

$conexion->close();

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($paresCartas);
?>

<?php
// filepath: /e:/xampp/htdocs/PRYCTgit/G4-ViajeEntreCulturas/info.php

// Configuración de la base de datos
require_once 'config/config.php';

$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener las banderas
$sqlBanderas = "SELECT id_pais, ruta AS imagen FROM banderas";
$resultBanderas = $conexion->query($sqlBanderas);

$banderas = [];
if ($resultBanderas->num_rows > 0) {
    while ($row = $resultBanderas->fetch_assoc()) {
        $banderas[$row['id_pais']] = $row['imagen'];
    }
}

// Consulta para obtener los ítems
$sqlItems = "SELECT id_pais, ruta AS imagen FROM items";
$resultItems = $conexion->query($sqlItems);

$items = [];
if ($resultItems->num_rows > 0) {
    while ($row = $resultItems->fetch_assoc()) {
        $items[$row['id_pais']] = $row['imagen'];
    }
}

// Combinar los datos basados en el id_pais
$paresCartas = [];
foreach ($banderas as $id_pais => $imagenBandera) {
    if (isset($items[$id_pais])) {
        $paresCartas[$imagenBandera] = $items[$id_pais];
    }
}

$conexion->close();

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($paresCartas);


/*
let paresCartas = {};

// Función para obtener los pares de cartas desde la base de datos
async function obtenerParesCartas() {
  try {
    const response = await fetch('info.php');
    if (!response.ok) {
      throw new Error('Error al obtener los pares de cartas');
    }
    paresCartas = await response.json();
    iniciarJuego(); // Llamar a la función para iniciar el juego después de obtener los datos
  } catch (error) {
    console.error('Error:', error);
  }
}

// Llamar a la función para obtener los pares de cartas al cargar la página
document.addEventListener('DOMContentLoaded', obtenerParesCartas);

// Función para iniciar el juego
function iniciarJuego() {
  // Aquí puedes poner el código para iniciar el juego usando los datos de paresCartas
  console.log(paresCartas);
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
      score += 10; // Incrementar la puntuación
      updateScore(); // Actualizar la visualización de la puntuación

      if (cartasEmparejadas.length === Object.keys(paresCartas).length * 2) {
        setTimeout(() => {
          alert(`¡Felicidades! Has completado el juego con una puntuación de ${score}`);
          // Redirigir a la página de registro de puntuación
          window.location.href = './view/registroPuntuacion.php';
        }, 500);
      }
    } else {
      setTimeout(() => {
        carta1.classList.remove('flipped');
        carta2.classList.remove('flipped');
        carta1.style.backgroundImage = '';
        carta2.style.backgroundImage = '';
        cartasVolteadas = [];
      }, 1000);
    }
  }
}*/
?>