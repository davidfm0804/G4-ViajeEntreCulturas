// -------------------------------------------- VALIDACIONES CONTINENTES--------------------------------------------------------

// Evento al hacer click en la clase update (validaciones)
document.querySelector('input[type="submit"]').addEventListener('click', async function(event){
    
    event.preventDefault();
    //Variable que apunta al elemento cuyo name es continente (input text ingreso de continente)
    const continente = document.querySelector('[name="nombreContinente"]');

    let valid = true;

    // Validaciones

    // El input Continente es NOT NULL
    if(!continente.value){
        alert("Por favor, indique el nombre del continente.");
        valid = false;
    }

    // El input Continente sólo contiene letras
    if(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ]/.test(continente.value)){
        alert("Por favor, inserte solo valores alfabéticos.");
        valid = false;
    }

    if(valid){
        //Convertimos la cadena de texto siendo la primera letra mayúsculas y el resto minúsculas
        function primeraEnMayusculas(cadena){
            return cadena.charAt(0).toUpperCase() + cadena.slice(1).toLowerCase();
        }
        //EL input text de continente lo pasamos por la función
        const nombreContinente = primeraEnMayusculas(continente.value);

        if (valid) {
            // Realizar una solicitud fetch para comprobar si el continente ya existe en la base de datos
                const response = await fetch('comprobarContinente.php', {
                    method: 'POST',
                    body: new URLSearchParams({
                        'nombreContinente': nombreContinente
                    })
                });
    
                const data = await response.json();  // Parseamos la respuesta JSON
    
                // Verificamos si el continente ya existe
                if (data.existe) {
                    alert("Este continente ya existe.");
                    valid = false;
                }
        
        const formData = new FormData();
        formData.append('nombreContinente', nombreContinente);
        
        try{
            const response = await fetch('altaContinente.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.text();
            const h2 = document.createElement('h2');
            h2.textContent = 'Datos enviados:';
            h2.style.margin = '4%';

            const p = document.createElement('p');
            p.textContent = 'Continente insertado: '+nombreContinente;
            p.style.margin = '4%';

            const main = document.querySelector('main');

            // document.body.innerHTML = '';
            main.appendChild(h2);
            main.appendChild(p);
            
        }
        catch (error){
            console.error('Error:', error);
        }
    }
});