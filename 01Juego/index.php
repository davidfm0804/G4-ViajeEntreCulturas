<?php
    require_once 'controlador/GameController.php';

    $action = isset($_GET['action']) ? $_GET['action'] : '';

    $controller = new GameController();

    switch ($action) {
        case 'iniciarJuego':
            $controller->iniciarJuego();
            break;
        default:
            require_once 'vista/vista_inicio.php'; // Pantalla de inicio
            break;
    }
?>