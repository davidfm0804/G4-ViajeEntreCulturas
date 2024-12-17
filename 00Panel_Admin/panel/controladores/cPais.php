<?php

require_once MODELOS.'mPais.php';

class cPais {

    public $tituloPagina;
    public $vista;

    public function __construct() {
        $this->vista = ''; // Vista por defecto
        $this->tituloPagina = '';
        $this->objPais = new mPais(); // Instanciamos el objeto del modelo Pais
    }

    public function cListadoPaises() {
        $this->tituloPagina = 'Listado de países de '.$_GET['nombreCont'];
        $this->vista = 'listadoPaises';
        return $this->objPais->mListadoPaises();
    }

    public function cMapaChincheta() {
        $this->vista = 'mapaChincheta'; 
    }

    public function cFormAltaPais() {
        $this->vista = 'formAltaPais';
        return $this->objPais->mFormAltaPais(); // Vista del formulario para dar de alta un país
    }

    public function cAltaPais() {
        return $this->objPais->mAltaPais();
    }

    public function cFormModPais() {
        $this->vista = 'formModPais';
        return $this->objPais->mFormModPais();
    }
    
    public function cCambiarChincheta() {
        $this->vista = 'cambiarChincheta';
    }

    public function cMapaChinchetas() {
        $this->vista = 'mapaChinchetas';
    }

    public function cMostrarChinchetas() {
        $coordenadas = $this->objPais->mMostrarChinchetas();
        header('Content-Type: application/json');
        echo json_encode($coordenadas);
    }

    public function cUpdatePais(){
        // Iniciar el flag de validación
        $valid = true;
        $error = '';
    
        // 1. Validar el nombre del país (no debe ser vacío, ni contener números o espacios)
        $pais = trim($_POST['pais']);
        if (empty($pais)) {
            $valid = false;
            $error = "El nombre del país es obligatorio.";
        } elseif (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚüÜ\s]+$/', $pais)) {
            $valid = false;
            $error = "El nombre del país solo puede contener letras y espacios.";
        }
    
        // 2. Validación de contenido ofensivo en el nombre del país
        $palabrasOfensivas = ["imbecil", "tonto", "estupido", "idiota", "loco"]; // Puedes añadir más palabras aquí
        foreach ($palabrasOfensivas as $palabra) {
            if (stripos($pais, $palabra) !== false) {
                $valid = false;
                $error = "El nombre del país contiene palabras ofensivas.";
                break;
            }
        }
    
        // 3. Validar las coordenadas X y Y (deben ser números decimales)
        $coordX = $_POST['coordX'];
        $coordY = $_POST['coordY'];
        if (!is_numeric($coordX) || !is_numeric($coordY)) {
            $valid = false;
            $error = "Las coordenadas deben ser números válidos.";
        }
    
        // 4. Validación para el archivo de la imagen (JPEG, PNG, GIF, JPG)
        if (isset($_FILES['imgBandera']) && $_FILES['imgBandera']['error'] == 0) {
            // Definir las extensiones permitidas
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            // Obtener la extensión del archivo subido
            $fileExtension = strtolower(pathinfo($_FILES['imgBandera']['name'], PATHINFO_EXTENSION));
    
            // Verificar si la extensión del archivo es válida
            if (!in_array($fileExtension, $allowedExtensions)) {
                $valid = false;
                $error = "El archivo de la bandera debe ser una imagen de tipo JPEG, PNG, GIF o JPG.";
            }
    
            // Validación del tamaño del archivo 
            $fileSize = $_FILES['imgBandera']['size'];
            if ($fileSize > 2 * 1024 * 1024) {  // 2MB máximo
                $valid = false;
                $error = "El archivo de la bandera no puede exceder los 2MB.";
            }
        }
    
        // Si la validación falla, se termina la función y se muestra el error
        if (!$valid) {
            echo $error;
            exit;
        }
    
        // Si todo es válido, proceder con el update en la base de datos
        $idPais = $_POST['idPais'];
        $imgBandera = isset($_FILES['imgBandera']['name']) ? $_FILES['imgBandera']['name'] : ''; // Imagen bandera
    
        // Si la imagen ha sido cargada, moverla a su destino
        if ($imgBandera) {
            $imgBanderaTmp = $_FILES['imgBandera']['tmp_name'];
            $imgBanderaPath = BANDERAS . basename($imgBandera);
            if (!move_uploaded_file($imgBanderaTmp, $imgBanderaPath)) {
                echo "Error al subir la imagen de la bandera.";
                exit;
            }
        } else {
            $imgBandera = $_POST['imgBanderaOriginal']; // Usar la imagen original si no se ha subido una nueva
        }
    
        // Llamar al método para actualizar el país
        $result = $this->objPais->mUpdatePais($pais, $coordX, $coordY, $imgBandera, $idPais);
    
        if ($result) {
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
