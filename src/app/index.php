<?php
    require_once 'config/config.php'; //Constantes config php
    require_once MODELO.'connBD.php'; //Clase BBDD

if(!isset($_GET["controlador"])){$_GET["controlador"] = DEFAULT_CONTROLADOR;}
if(!isset($_GET["accion"])){$_GET["accion"] = DEFAULT_ACCION;}

$rutaControlador = CONTROLLER.'c'.$_GET["controlador"].'.php'; // 'controller/cControlador.php'

if(!file_exists($rutaControlador)){$rutaControlador = CONTROLLER.'c'.DEFAULT_CONTROLADOR.'.php';} // 'controller/cPais.php'

require_once $rutaControlador;

$nombreControlador = 'c'.$_GET["controlador"]; //nombre de la clase controlador (Ejemplo: cPais)
$controlador = new $nombreControlador(); //Instanciamos objeto de la clase controlador

$dataToView["data"] = array();
if(method_exists($controlador,$_GET["accion"])){
    $dataToView["data"] = $controlador->{$_GET["accion"]}();
}


// if($controlador->view === 'mapaChincheta' || $controlador->view === 'cambiarChincheta'){require_once 'view/template/headerMapa.php'; }
// else if($controlador->view === 'formAlta'){require_once 'view/template/headerFormAlta.php'; }
// else if($controlador->view === 'formModPais'){require_once 'view/template/headerFormModPais.php'; }
// else{require_once 'view/template/headersimple.php';}
require_once 'view/'.$controlador->view.'.php';