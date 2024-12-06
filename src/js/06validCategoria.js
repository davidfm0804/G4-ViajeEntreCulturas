document.querySelector('.update').addEventListener('click', function (event) {
    const nombreCatg = document.querySelector('[name="nombreCatg"]');
    const form = document.getElementById('categoriaForm');

    /*-- Declaración de Variables --*/
    let valid = true;

    /*-- Validaciones --*/
    // Validar que el campo no esté vacío
    if (!nombreCatg.value.trim()) {
        alert("Por favor, ingrese el nombre de la categoría.");
        valid = false;
    } else {
        // Validar que solo contenga letras y espacios
        const regex = /^[A-Za-záéíóúÁÉÍÓÚüÜ\s]+$/;
        if (!regex.test(nombreCatg.value.trim())) {
            alert("El nombre de la categoría solo puede contener letras y espacios.");
            valid = false;
        }
    }

    /*-- Si no es válido, prevenir el envío del formulario --*/
    if (!valid) {
        event.preventDefault();
    } else {
        console.log("Formulario válido. Procediendo al envío...");
        form.submit();
    }
});
