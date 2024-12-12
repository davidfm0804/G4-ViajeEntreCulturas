document.getElementById('paises').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=MenuPrincipal&accion=cPaisSelecContinente';
});

document.getElementById('continentes').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=Continente&accion=cListadoContinentes';
});

document.getElementById('categorias').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=MenuPrincipal&accion=ListadoCategorias';
});