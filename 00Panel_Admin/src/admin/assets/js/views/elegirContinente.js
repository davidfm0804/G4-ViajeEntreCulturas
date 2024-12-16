document.addEventListener("DOMContentLoaded", function () {
    const selectContinente = document.getElementById("EligeContinente");

    document.querySelector('.ver').addEventListener('click', async function(event){
        if (selectContinente.value.trim()=="") {
            event.preventDefault(); 
            alert(" Elige un Continente");
            window.location.href = `index.php?controlador=MenuPrincipal&accion=cRankingSelecContinente`;
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