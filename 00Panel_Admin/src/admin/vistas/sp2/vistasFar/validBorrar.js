// Script para confirmar antes de borrar
document.addEventListener('DOMContentLoaded', function() {
    // Seleccionamos todos los enlaces con la clase 'borrar'
    const borrar = document.querySelectorAll('.borrar a');
    
    // Añadimos el event listener para cada enlace de borrar
    borrar.forEach(function(link) {
        link.addEventListener('click', function(event) {
            // Evita que el enlace se ejecute inmediatamente
            event.preventDefault();
            
            // Mostramos el cuadro de confirmación
            let mensaje = "Confirme que desea borrar";
            if (confirm(mensaje) === true) {
                // Si el usuario confirma, redirigimos al enlace
                window.location.href = link.href;
            } else {
                // Si el usuario cancela, no hacemos nada
                alert("Cancelado");
            }
        });
    });
});