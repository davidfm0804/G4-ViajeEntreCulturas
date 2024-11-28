/*-- Añadir Evento Recoger Coordenadas -> Main - Click --*/
document.getElementById('mainMapa').addEventListener('click', function(event) {
    const x = event.clientX;
    const y = event.clientY;
    document.getElementById('coordenadas').textContent = `(${x}, ${y})`;
    
    // Guardar Coordenadas Navegador
    localStorage.setItem('coordX', x);
    localStorage.setItem('coordY', y);

    // Eliminar la chincheta anterior si existe
    const chinchetaAnterior = document.getElementById('chincheta');
    if (chinchetaAnterior) 
        chinchetaAnterior.remove();

    // Paso de px a REM
    $medidaRem = [];
    $medidaRem = calculoRem(x,y);
    console.log($medidaRem);

    // Crear y posicionar la imagen en las coordenadas del click
    const img = document.createElement("img");
    img.id = "chincheta";
    img.src = "./img/chincheta.png";
    img.style.position = "absolute";
    img.style.left = `${medidaRem[0]}rem`;
    img.style.top = `${medidaRem[1]}rem`;
    img.style.transform = "translate(-17%, -83%)";
    document.body.appendChild(img);
});

/*-- Añadir Event -> Tecla Enter --*/
document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        window.location.href = './form.html';
    }
});

/*-- Paso de PX a REM --*/
function calculoRem ($Xpx, $Ypx){
    $coordRem = [];
    $coordRem[0] = $Xpx*0.063;
    $coordRem[1] = $Ypx*0.063;
    return $coordRem;
}