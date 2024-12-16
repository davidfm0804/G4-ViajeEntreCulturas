document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const selectContinente = document.getElementById("EligeContinente");

    form.addEventListener("submit", function (event) {
        if (selectContinente.value.trim()=="") {
            event.preventDefault(); 
            alert("Elige un Continente");
        }
    });
});
document.getElementById('verRanking').addEventListener('click', function (event) {
    event.preventDefault(); // Prevenir el envío del formulario
    const selectElement = document.querySelector('select[name="idContinente"]');
    const idContinente = selectElement.value; // Obtiene el valor del option seleccionado
    const nombreCont = selectElement.selectedOptions[0].text; // Obtiene el texto del option seleccionado
    window.location.href = `index.php?controlador=Ranking&accion=cListadoRanking&idContinente=${idContinente}&nombreCont=${nombreCont}`;
});