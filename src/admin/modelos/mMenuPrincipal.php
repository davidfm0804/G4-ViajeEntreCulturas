<?php

class mMenuPrincipal{

    private $tabla = '';
    private $conexion;

    public function __construct(){}

    public function conectar(){
        $objetoBD = new bbdd();
        $this->conexion = $objetoBD->conexion; //Llamamos al metodo que realiza la conexion a la BBDD
    }
    public function mPaisSelecContinente(){
        $this->tabla = 'continente';
        $this->conectar();
        $sql = 'SELECT * FROM '.$this->tabla;
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function mListadoContinentes(){
        $this->tabla = 'continente';
        $this->conectar();
        $sql = 'SELECT * FROM '.$this->tabla;
        $resultado = $this->conexion->query($sql); //La mandamos a la BBDD y recibimos el resultado
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}


?>