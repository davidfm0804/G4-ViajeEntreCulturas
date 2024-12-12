<?php
require_once MODELO.'mCategoria.php';

class cCategoria {

    public $tituloPagina;
    public $view;

    public function __construct() {
        $this->view = ''; 
        $this->tituloPagina = '';
        $this->objCatg = new MCategoria();
    }

    public function listadoCategorias(){
        $this->view = 'listadoCategorias';
        $this->tituloPagina = 'Listado de Categorías';
        return $this->objCatg->selectCategorias();
    }

    public function formAltaCatg(){
        $this->view = 'registroCategoria';
    }

    public function insertDatos(){
        $categoria = $_POST['categoria'];
        /*-- VALIDACIONES --*/
        return $this->objCatg->insertCategoria($categoria);
    }


    public function borrarCategoria(){
        $idCat = $_POST['id'];
        // VALIDACIONES
        $result = $this->objCatg->eliminarCategoria($idCat);
        
        if ($result) {
            echo "Registro eliminado correctamente";
        } else {
            echo "Error al eliminar el registro";
        }
        exit;
    }

    /*-- Modificar | Vista [formModCatg] + Modelo [selectModCatg]  --*/
    public function formModCatg(){
        $this->view = 'formModCatg';
        return $this->objCatg->selectModCatg();   
    }

    public function modificarCategoria(){
        $idCatg = $_POST['idCat'];
        $nombreCat = $_POST['categoria'];
        // VALIDACIONES
        $result = $this->objCatg->updateCategoria($idCatg, $nombreCat);

        if ($result) {
            echo "Registro modificado correctamente";
        } else {
             // Si hubo un error, establecemos otro mensaje en la sesión
            echo "Error al modificar el registro";
        }
        exit;
    }

    // Verificar si la categoría ya existe en la base de datos
    public function csuCategoria(){
        if (isset($_POST['nombreCat'])) {
            $nombreCat = $_POST['nombreCat'];
            $result = $this->objCatg->verificarCategoria($nombreCat);
            return $result;
        } else {
            return false;
        }
    }
}
?>