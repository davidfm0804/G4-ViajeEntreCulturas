/*document.addEventListener("DOMContentLoaded", function () {
    const borrarButton = document.querySelector("a[href*='borrarRankings.php']");

    borrarButton.addEventListener("click", function (event) {
        const confirmation = confirm("¿Estás seguro de que deseas borrar las puntuaciones de este continente?");
        if (!confirmation) {
            aevent.preventDefault(); // Evita que se haga la acción de borrar si el usuario cancela
        }
    });
});*/
document.getElementById('borrar').addEventListener('click', async function () {
    const confirmation = confirm("¿Estás seguro de que deseas borrar las puntuaciones de este continente?");
    if (!confirmation) {
        return;
    }
    const valid=true;
    if (valid) {
    const idContinente=document.getElementById('idContinente').value;

    let formData = new FormData();
    formData.append('idContinente', idContinente);
    try {
        const response = await fetch ('index.php?controlador=Ranking&accion=cBorrarPuntuacion',{
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
           const result = await response.text();
           alert(result);
           location.reload();
        }else{
            alert("Error al Borrar el Ranking");
        }
    } catch (error) {
        console.error('Error al hacer la solicitud:', error);
        alert('Hubo un error al realizar la solicitud al servidor. Intenta de nuevo.');
    }
}
});
