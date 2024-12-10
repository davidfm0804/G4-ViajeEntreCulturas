document.getElementById('paises').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=MenuPrincipal&accion=cPaisSelecContinente';
});

document.getElementById('continentes').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=MenuPrincipal&accion=cListadoContinentes';
});