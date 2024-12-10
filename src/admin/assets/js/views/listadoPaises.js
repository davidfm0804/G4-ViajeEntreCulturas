document.getElementById('altaPais').addEventListener('click', function () {
    const idContinente = document.getElementById('idContinente').value;
    const nombreCont = document.getElementById('nombreCont').value;

    window.location.href = `index.php?controlador=Pais&accion=cMapaChincheta&id=${idContinente}&nombreCont=${nombreCont}`;
});