<?php

require_once MODELOS.'mPais.php';

class cPais {

    public $tituloPagina;
    public $vista;

    public function __construct() {
        $this->vista = ''; 
        $this->tituloPagina = '';
        $this->objPais = new mPais(); 
    }

    public function cListadoPaises(){ 
        $this->tituloPagina = 'Listado de países de '.$_GET['nombreCont'];
        $this->vista = 'listadoPaises';
        return $this->objPais->mListadoPaises();
    }

    public function cMapaChincheta(){ 
        $this->vista = 'mapaChincheta'; 
    }

    public function cFormAltaPais(){
        $this->vista = 'formAltaPais';
        return $this->objPais->mFormAltaPais(); 
    }

    public function cAltaPais() {
        $valido = true;
        $error = '';

        //Validar nombrePais vacio
        if(empty($_POST['pais'])){
            $valido = false;
            $error = 'El nombre del país no puede estar vacío';
            echo $error;
            return;
        }

        //Funcion buscar nombrePais repetido
        if(isset($_POST['pais'])){
            $nombreRepetido = $this->objPais->mNombrePaisRepetido($_POST['pais']);
            if($nombreRepetido == false){
                $valido = false;
                $error = 'Este nombre ya está inscrito';
                echo $error;
                return;
            } 
        }
       
        //Validar caracteres permitidos nombrePais
        if(!preg_match('/^[A-Za-záéíóúÁÉÍÓÚüÜ\s]+$/', trim($_POST['pais']))){
            $valido = false;
            $error = "El nombre de país no puede contener números ni símbolos";
            echo $error;
            return;
        }

        //Validar imgBandera no está vacío
        if(!isset($_FILES['imgBandera'])){
            $valido = false;
            $error = "No se ha subido la bandera del país";
            echo $error;
            return;
        } else {
             //Validar el formato de imgBandera
            $formatoValido = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['imgBandera']['type'], $formatoValido)) {
                $valido = false;
            $error = "Formato no válido. Solo se permiten JPEG, JPG, PNG o GIF.";
            echo $error;
            return;
            }
        }
  
        //Validar campo categoría no esté vacío
        for($i = 1; $i < 5; $i++){
            $campo = 'categoria'.$i;
            if(empty($_POST[$campo])){
                $valido=false;
                $error= "Campo categoría vacío";
                echo $error;
                return;
            }
        }

        //Validar que los item de un país no repiten categoría. 
        $categorias = array($_POST['categoria1'], $_POST['categoria2'], $_POST['categoria3'], $_POST['categoria4']);
        if (count($categorias) !== count(array_unique($categorias))) {  
            $valido=false;
            $error =  "No se pueden repetir categorías";  
            echo $error;
            return;      
        } 

        //Validar que las fotos de los item no estén vacías
        for($i = 1; $i < 5; $i++){
            $campo = 'imgItem'.$i;
            if(empty($_FILES[$campo])){
                $valido = false;
                $error= "Foto de Item no subida";
                echo $error;
                return;
            } else {
        //Validar el formato de fotos
                $formatoValido = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!in_array($_FILES[$campo]['type'], $formatoValido)) {
                    $valido = false;
                    $error= "Formato no válido. Solo se permiten JPEG, JPG, PNG o GIF.";
                    echo $error;
                    return;
                }
            }
        }

        //Validar campo descripcion no esté vacío
        for($i = 1; $i < 5; $i++){
            $campo = 'descripcion'.$i;
            if(empty($_POST[$campo])){
                $valido = false;
                $error= "Campo descripción vacío";
                echo $error;
                return;
            }
        }

        //Validar campo descripcion >500 caracteres
        for($i = 1; $i < 5; $i++){
            $campo = 'descripcion'.$i;
            if(strlen($_POST[$campo]) > 500){
                $valido = false;
                $error = "Campo descripción supera 500 caracteres";
                echo $error;
                return;
            }
        }

        //Superadas las validaciones
        if($valido){
            $resultado = $this->objPais->mAltaPais(); 
            echo $resultado;
            exit;
        } else {
            echo $error;
            exit;
        }
    }

    public function cFormModPais(){
        $this->vista = 'formModPais';
        return $this->objPais->mFormModPais();
    }
    
    public function cCambiarChincheta(){
        $this->vista = 'cambiarChincheta';
    }

    public function cMapaChinchetas(){
        $this->vista = 'mapaChinchetas';
    }

    public function cMostrarChinchetas(){
        $coordenadas = $this->objPais->mMostrarChinchetas();
        header('Content-Type: application/json');
        echo json_encode($coordenadas);
    }

    public function cUpdatePais(){
        $resultado = $this->objPais->mUpdatePais();
        if ($resultado) {
            echo "Registro modificado correctamente";
         } else {
             echo "Error al modificar el registro";
         }
         exit;
    }

    public function cBorrarPais(){
        $resultado = $this->objPais->mBorrarPais();
        
        if ($resultado) {
           echo "Registro eliminado correctamente";
        } else {
            echo "Error al eliminar el registro";
        }
        exit;
    }
}
?>