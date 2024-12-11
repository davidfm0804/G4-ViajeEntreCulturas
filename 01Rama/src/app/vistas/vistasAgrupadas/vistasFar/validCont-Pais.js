// -------------------------------------------- VALIDACIONES CONTINENTES EN FORM PAIS------------------------------------------------

// Evento al hacer click en la clase update (validaciones)
document.querySelector('.update').addEventListener('click', /*async*/ function(event){
    
    event.preventDefault();
    //Variable que apunta al elemento cuyo name es continente (input text ingreso de continente)
    const continente = document.querySelector('[name="continente"]');

    let valid = true;

    // Validaciones

    // El input Continente es NOT NULL
    if(!continente.value){
        alert("Por favor, seleccione un continente.");
        valid = false;
    }
})