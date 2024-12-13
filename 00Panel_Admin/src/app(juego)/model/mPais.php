<?php

class mPais {

    private $tabla = 'paises'; //Nombre de la tabla donde buscamos información
    private $conexion;

    public function __construct() {

    }

    public function conectar(){
        $objetoBD = new bbdd(); //Conectamos a la base de datos. Creamos objeto $objetoBD
        $this->conexion = $objetoBD->conexion; //Llamamos al metodo que realiza la conexion a la BBDD
    }

    public function selectPaises(){
        $this->conectar(); //Llamo al metodo conectar de arriba
        $sql = 'SELECT codPais, nombrePais, bandera FROM '.$this->tabla; //Escribimos la consulta
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetchAll(MYSQLI_ASSOC);
    }
}
?>
