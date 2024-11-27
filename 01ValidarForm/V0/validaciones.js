document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const opciones = document.getElementById('selectPais');
    const archivo = document.getElementById('img');
    const comentarios = document.getElementById('comentarios');

    form.addEventListener('submit', function(event) {
        let valid = true;
        const allowedExtensions = ['image/jpeg', 'image/png', 'image/gif'];

        // Validar select
        if (opciones.value === "") {
            alert("Por favor, selecciona un país.");
            valid = false;
        }

        // Validar input file
        if (archivo.files.length === 0) {
            alert("Por favor, sube una imagen.");
            valid = false;
        } else if (!allowedExtensions.includes(archivo.files[0].type)) {
            alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF).");
            valid = false;
        }

        // Validar textarea
        if (comentarios.value.trim() === "") {
            alert("Por favor, ingresa tus comentarios.");
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }
    });
});