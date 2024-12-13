document.getElementById('formRegPunt').addEventListener('submit', async function (event) {
    event.preventDefault();

    formData = new FormData();
    formData.append('nombre', document.querySelector('[name="nombreJug"]'));
    formData.append('puntos', $_GET['puntos']);
    formData.append('tiempo', $_GET['tiempo']);
    formData.append('numFallos', $_GET['numFallos']);
    formData.append('idContinente', $_GET['idCont']);
    
    try {
        const response = await fetch('index.php?contoller=Juego&action=insertarPuntuacion', {
            method: 'POST',
            body: formData,
        });
        if (response.ok) {
            const result = await response.text();
            alert(result);
            this.reset();
        } else {
            alert('Error al registrar el puntaje');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en la conexión con el servidor');
    }

    window.location.href = './index.php?controller=Juego&action=verRanking';
});