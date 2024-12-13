document.getElementById('formRegPunt').addEventListener('submit', async function (event) {
    event.preventDefault();
    
    try {
        const response = await fetch('../02registrarPunt.php', {
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