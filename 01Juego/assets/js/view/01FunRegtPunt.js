document.getElementById('btnEnviar').addEventListener('click', async function () {

    $formRecb = $_GET['fd'];

    formData = new FormData();
    formData.append('nombre', document.querySelector('[name="nombreJug"]'));
    formData.append('puntos', $formRecb.get('puntos'));
    formData.append('tiempo', $formRecb.get('tiempo'));
    formData.append('numFallos', $formRecb.get('numFallos'));
    formData.append('idContinente', $formRecb.get('idCont'));

    console.log(formData.get('nombre'));
    console.log(formData.get('puntos'));
    console.log(formData.get('tiempo'));
    console.log(formData.get('numFallos'));
    console.log(formData.get('idContinente'));
    
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