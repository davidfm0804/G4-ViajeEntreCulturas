document.getElementById('continentes').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=Continente&accion=cListadoContinentes';
});

document.getElementById('paises').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=MenuPrincipal&accion=cPaisSelecContinente';
});

document.getElementById('items').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=MenuPrincipal&accion=cItemSelecContinente';
});

document.getElementById('categorias').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=MenuPrincipal&accion=ListadoCategorias';
});

document.getElementById('ranking').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=MenuPrincipal&accion=cRankingSelecContinente';
});

document.getElementById('valoraciones').addEventListener('click', function(){
    window.location.href = 'index.php?controlador=Valoracion&accion=cListadoCorreos';
});