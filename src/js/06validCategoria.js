document.querySelector('.update').addEventListener('click', async function (event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del botón

    const nombreCatg = document.querySelector('[name="nombreCat"]');
    const form = document.getElementById('categoriaForm');

    let valid = true;

    // Validaciones básicas
    if (!nombreCatg.value.trim()) {
        alert("Por favor, ingrese el nombre de la categoría.");
        valid = false;
    } else {
        const regex = /^[A-Za-záéíóúÁÉÍÓÚüÜ\s]+$/;
        if (!regex.test(nombreCatg.value.trim())) {
            alert("El nombre de la categoría solo puede contener letras y espacios.");
            valid = false;
        }
    }

    if (!valid) return;

    try {
        const formData = new FormData();
        formData.append('nombreCat', nombreCatg.value.trim());

        const response = await fetch('comprobarCategoria.php', {
            method: 'POST',
            body: formData,
        });

        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.status);
        }

        const data = await response.json();

        if (data.error) {
            alert("Error: " + data.error);
        } else if (data.existe) {
            alert("Esta categoría ya existe. Intente con otro nombre.");
        } else {
            // Enviar el formulario si todo está bien
            console.log("Formulario válido. Procediendo al envío...");
            form.submit();
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Hubo un error al procesar la solicitud.");
    }
});
