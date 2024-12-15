<?php
    require_once MODELOS.'mCategoria.php';

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
            if (!isset($_POST['categoria'])) {
                echo "Error al registrar la categoría";
                exit;
            }

            $categoria = $_POST['categoria'];
            $valid = $this->validarCategoria($categoria);

            if ($valid['valid']) {
                $result = $this->objCatg->insertCategoria($categoria);
                if ($result)
                    echo "Categoria registrada correctamente";
                else
                    echo "Error al registrar la categoría";
            } else {
                echo $valid['error'];
            }

            exit;
        }

        public function modificarCategoria(){
            if (!isset($_POST['idCat']) || !isset($_POST['categoria'])) {
                echo "Error al modificar el registro";
                exit;
            }

            $idCatg = $_POST['idCat'];
            $nombreCat = $_POST['categoria'];

            $valid = $this->validarCategoria($nombreCat);

            if ($valid['valid']) {
                $result = $this->objCatg->updateCategoria($idCatg, $nombreCat);
                if ($result)
                    echo "Registro modificado correctamente";
                else
                    echo "Error al modificar la categoría";
            } else {
                echo $valid['error'];
            }

            exit;
        }

        public function borrarCategoria(){
            if (!isset($_POST['id']) || empty($_POST['id'])) {
                echo "Error al eliminar el registro: ID no proporcionado.";
                exit;
            }

            $idCat = $_POST['id'];
            $result = $this->objCatg->eliminarCategoria($idCat);

            if ($result)
                echo "Registro eliminado correctamente";
            else
                echo "Error al eliminar el registro";
            
            exit;
        }

        /*-- Modificar | Vista [formModCatg] + Modelo [selectModCatg]  --*/
        public function formModCatg(){
            $this->view = 'formModCatg';
            return $this->objCatg->selectModCatg();   
        }

        // Verificar si la categoría ya existe en la base de datos
        public function csuCategoria(){
            if (isset($_POST['categoria'])) {
                $nombreCat = $_POST['categoria'];
                $result = $this->objCatg->verificarCategoria($nombreCat);
                echo json_encode(['exists' => $result]);
            } else {
                echo json_encode(['exists' => false]);
            }
            
            exit;
        }

        // Validar Nombre Categoría
        private function validarCategoria($categoria) {
            /*-- Inicializar variables --*/
            $valid = true;
            $error = '';

            /*-- Validaciones --*/

            // 1. Verificar si el campo está vacío
            if (empty(trim($categoria))) {
                $valid = false;
                $error = "Por favor, indique el nombre de la categoría.";
            }

            // 2. Verificar si el campo solo contiene letras y espacios
            // ^ -> Inicio de la cadena
            // [A-Za-záéíóúÁÉÍÓÚüÜ\s] -> Letras Mayus && Minsc | Vocales Tilde | ü | Espacios || [Solo Permitidos]
            // $ -> Fin de la cadena
            if ($valid && !preg_match('/^[A-Za-záéíóúÁÉÍÓÚüÜ\s]+$/', trim($categoria))) {
                $valid = false;
                $error = "El nombre de la categoría solo puede contener letras y espacios.";
            }

            // 3. Verificar si el campo tiene entre 3 y 50 caracteres
            if ($valid && (strlen(trim($categoria)) < 3 || strlen(trim($categoria)) > 50)) {
                $valid = false;
                $error = "El nombre de la categoría debe tener entre 3 y 50 caracteres.";
            }

            // 4. Verificar si el campo no está compuesto solo por espacios
            if ($valid && strlen(trim($categoria)) === 0) {
                $valid = false;
                $error = "El nombre de la categoría no puede estar compuesto solo por espacios.";
            }

            // 5. Verificar si el campo contiene palabras no permitidas
            $palabrasProhibidas = ["imbecil", "tonto"];
            foreach ($palabrasProhibidas as $palabra) {
                if ($valid && stripos(trim($categoria), $palabra) !== false) {
                    $valid = false;
                    $error = "El nombre contiene palabras no permitidas.";
                }
            }

            // 6. Verificar si la categoría ya existe
            if ($valid && $this->objCatg->verificarCategoria($categoria)) {
                $valid = false;
                $error = "La categoría ya existe.";
            }

            return ['valid' => $valid, 'error' => $error];
        }
    }
?>