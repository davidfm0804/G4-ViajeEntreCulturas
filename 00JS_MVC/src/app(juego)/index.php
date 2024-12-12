<?php
    require_once 'config/config.php'; //Constantes config php
    require_once MODELO.'connBD.php'; //Clase BBDD

if(!isset($_GET["controlador"])){$_GET["controlador"] = DEFAULT_CONTROLLER;}
if(!isset($_GET["accion"])){$_GET["accion"] = DEFAULT_ACTION;}

$rutaControlador = CONTROLLER.'c'.$_GET["controlador"].'.php'; // 'controller/cControlador.php'

if(!file_exists($rutaControlador)){$rutaControlador = CONTROLLER.'c'.DEFAULT_CONTROLLER.'.php';} // 'controller/cPais.php'

require_once $rutaControlador;

$nombreControlador = 'c'.$_GET["controlador"]; //nombre de la clase controlador (Ejemplo: cPais)
$controlador = new $nombreControlador(); //Instanciamos objeto de la clase controlador

$dataToView["data"] = array();
if(method_exists($controlador,$_GET["accion"])){
    $dataToView["data"] = $controlador->{$_GET["accion"]}();
}

require_once 'view/template/headersimple.php';
require_once 'view/'.$controlador->view.'.php';