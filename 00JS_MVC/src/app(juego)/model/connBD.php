<?php
    require_once CONFIG.'configDb.php'; //Archivo de configuración

    class bbdd {

        private $host;
        private $db;
        private $user;
        private $pass;
        public $conexion;
    
        public function __construct() {		
    
            $this->host = SERVIDOR;
            $this->db = BBDD;
            $this->user = USUARIO;
            $this->pass = PASSWORD;
    
            $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
            $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
            $controlador = new mysqli_driver();//Desactivar errores
            $controlador->report_mode = MYSQLI_REPORT_OFF;//Desactivar errores
            $texto_error=$conexion->errno;
    
        }  
    }
?>


