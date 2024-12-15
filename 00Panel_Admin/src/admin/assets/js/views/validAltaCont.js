// -------------------------------------------- VALIDACIONES CONTINENTES--------------------------------------------------------

document.querySelector('.cancel').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=Continente&accion=cListadoContinentes';
});
// Evento al hacer click en la clase update (validaciones)
document.querySelector('.update').addEventListener('click', async function(event){
    
    event.preventDefault();
    // Variable que apunta al elemento cuyo name es continente (input text ingreso de continente)
    const continente = document.querySelector('[name="nombreContinente"]');
    
    let valid = true;

    // Validaciones

    // El input Continente es NOT NULL
    if (!continente.value) {
        alert("Por favor, indique el nombre del continente.");
        valid = false;
    }

    // El input Continente sólo contiene letras y espacios en blanco
    if (/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/.test(continente.value)) {
        alert("Por favor, inserte solo valores alfabéticos.");
        valid = false;
    }

    if (valid) {
        // Convertimos la cadena de texto siendo la primera letra mayúsculas y el resto minúsculas
        function primeraEnMayusculas(cadena){
            return cadena.charAt(0).toUpperCase() + cadena.slice(1).toLowerCase();
        }
        //EL input text de continente lo pasamos por la función
        const nombreContinente = primeraEnMayusculas(continente.value);

        const formData = new FormData();
        formData.append('nombreContinente', nombreContinente);

        // Realizar una solicitud fetch para comprobar si el continente ya existe en la base de datos
        try {
            const response = await fetch('index.php?controlador=Continente&accion=cInsertarContinente', {
                method: 'POST',
                body: formData
            });

              // Verificamos si la respuesta es válida
              if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }

            // Intentamos obtener la respuesta como JSON
            const data = await response.json();  // Parseamos la respuesta JSON

            // Verificamos si el continente ya existe
            if (data.existe) {
                alert("Este continente ya existe.");
                return;  // Si existe, salimos de la función sin continuar
            }

            // Si no existe, procedemos a enviar el formulario para dar de alta el continente
            const insertResponse = await fetch('altaContinente.php', {
                method: 'POST',
                body: formData
            });

                const result = await insertResponse.text();
                
                // Crear elementos para mostrar los datos enviados
                const h2 = document.createElement('h2');
                h2.textContent = 'Datos enviados:';
                h2.style.margin = '4%';

                const p = document.createElement('p');
                p.textContent = `Continente insertado: ${nombreContinente}`;
                p.style.margin = '4%';

                const main = document.querySelector('main');
                main.appendChild(h2);
                main.appendChild(p);

        } catch (error){
            console.error('Error:', error);
            alert('Hubo un error al procesar la solicitud.');
        }
    }
});
