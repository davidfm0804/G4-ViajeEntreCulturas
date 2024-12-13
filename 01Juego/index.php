<?php
require_once 'config/config.php'; // Constantes config php
require_once MODELO.'conexion.php'; //Clase BBDD

if(!isset($_GET["controller"])){$_GET["controller"] = DEFAULT_CONTROLADOR;}
if(!isset($_GET["action"])){$_GET["action"] = DEFAULT_ACCION;}

$rutaControlador = CONTROLADOR.'c'.$_GET["controller"].'.php'; // 'controller/cControlador.php'

if(!file_exists($rutaControlador)){$rutaControlador = CONTROLADOR.'c'.DEFAULT_CONTROLADOR.'.php';} // 'controller/cPais.php'

require_once $rutaControlador;

$nombreControlador = 'c'.$_GET["controller"]; //nombre de la clase controlador (Ejemplo: cPais)
$controlador = new $nombreControlador(); //Instanciamos objeto de la clase controlador

$dataToView["data"] = array();
if(method_exists($controlador,$_GET["action"])){
    $dataToView["data"] = $controlador->{$_GET["action"]}();
} else {
    // Manejar el error cuando el método no existe
    die("Error: El método ".$_GET["action"]." no existe en el controlador ".$nombreControlador);
}

/*switch ($controlador->vista){
    case 'cMapaChincheta': require_once PLANTILLAVISTAS.'headerMapa.php'; break;
    case 'cCambiarChincheta': require_once PLANTILLAVISTAS.'headerMapa.php'; break;
    case 'cFormAlta': require_once PLANTILLAVISTAS.'headerFormAlta.php'; break;
    case 'cFormModPais': require_once PLANTILLAVISTAS.'headerFormModPais.php'; break;
    default: require_once PLANTILLAVISTAS.'headersimple.php'; break; 
}*/

require_once 'view/'.$controlador->view.'.php';
