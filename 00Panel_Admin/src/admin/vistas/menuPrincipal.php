<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viaje entre culturas</title>
    <link rel="icon" href="<?php echo IMG.'mapa.jpg';?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo CSS.'estiloHugoAdmin.css'; ?>">
</head>
<body>
    <header>
        <img src="<?php echo IMG.'logo.png'; ?>" alt="Logo de Viaje entre Culturas">
        <h1>Viaje entre Culturas</h1>
    </header>
        <main>
            <h2>Elige una opcion</h2><br/><br/>
            <div class="menu">
            <button id="continentes" class="menu-item">
                <img src="<?php echo IMG.'continentes.png'; ?>" alt="Continentes">
                <span>Continentes</span>
            </button>
            <button id="paises" class="menu-item">
                <img src="<?php echo IMG.'paises.png'; ?>" alt="Países">
                <span>Países</span>
            </button>
            <button id="items" class="menu-item">
                <img src="<?php echo IMG.'items.png'; ?>" alt="Items">
                <span>Items</span>
            </button>
            <button id="categorias" class="menu-item">
                <img src="<?php echo IMG.'categorias.png'; ?>" alt="Categorías">
                <span>Categorías</span>
            </button>
            <button id="ranking" class="menu-item">
                <img src="<?php echo IMG.'ranking.png'; ?>" alt="Ranking">
                <span>Ranking</span>
            </button>
        </div>
    </main>
    <script src="<?php echo JS.'menuPrincipal.js'; ?>"></script>
</body>
</html>