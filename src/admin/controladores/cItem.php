<?php

require_once MODELOS.'mItem.php';

class cItem {

    public $tituloPagina;
    public $vista;

    public function __construct() {
        $this->vista = ''; //Hay que cambiarle el nombre. Es la vista por defecto que mostraremos de la pagina index.php
        $this->tituloPagina = '';
        $this->objItem = new mItem(); //objPais es el nombre del objeto instanciado de la clase modelo Pais (mPais). Creamos objeto
    }

    public function cListadoPaises(){ //Este método devuelve el listado de países
        $this->tituloPagina = 'Listado de países de '.$_GET['nombreCont'];
        $this->vista = 'itemListadoPaises';
        return $this->objItem->mListadoPaises();
    }

    public function cFormModItems(){
        $this->tituloPagina = 'Listado de items de '.$_GET['nombrePais'];
        $this->vista = 'formModItems';
        return $this->objItem->mFormModItems();
    }

    public function cCargarCategorias(){
        $categorias = $this->objItem->mCargarCategorias();
        header('Content-Type: application/json');
        echo json_encode($categorias);
    }

    public function cActualizarItems(){
        $valido = true;
        $error = '';

        //Validar que los item de un país no repiten categoría
        $categorias = array($_POST['categoriaItem1'], $_POST['categoriaItem2'], $_POST['categoriaItem3'], $_POST['categoriaItem4']);
        if (count($categorias) !== count(array_unique($categorias))) {
            $valido = false; //array_unique(array) devuelve un array que no repite valores. Si no coincide la longitud del array es porque se repite un valor
            $error = "No se pueden repetir categorías";
        } 

        //Validar el formato de imgItems
        $formatoValido = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        for ($i =1; $i < 5; $i++){
            $campo = 'imgItem'.$i;
            if(isset($_FILES[$campo])){
                $archivo = $_FILES[$campo];
                //Comprobar si el tipo de archivo es válido
                if (!in_array($archivo['type'], $formatoValido)) {
                    $error = "Formato no válido. Solo se permiten JPEG, JPG, PNG o GIF.";
                    $valido = false;
                    break; 
                }
            }
        }
// Llamar a mActualizarItems, que devuelve un string con el formato "success|Mensaje" o "error|Mensaje"
$resultado = $this->objItem->mActualizarItems();
    
echo $resultado;
exit;
   }



        
 }   
?>