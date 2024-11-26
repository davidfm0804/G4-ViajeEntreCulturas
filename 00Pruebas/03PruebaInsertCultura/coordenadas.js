

/* ADD EVENT | Capturar && Enviar Coordenadas + PUT | Chincheta + [REMOVE | Chincheta]*/
document.addEventListener('click', function(event) {
    const x = event.clientX;
    const y = event.clientY;
    document.getElementById('coordenadas').textContent = `(${x}, ${y})`;

    // Eliminar la chincheta anterior si existe
    const chinchetaAnterior = document.getElementById('chincheta');
    if (chinchetaAnterior) 
        chinchetaAnterior.remove();

    // Crear y posicionar la imagen en las coordenadas del click
    const img = document.createElement("img");
    img.id = "chincheta";
    img.src = "../chincheta.png";
    img.style.position = "absolute";
    img.style.left = `${x}px`;
    img.style.top = `${y}px`;
    img.style.transform = "translate(-17%, -83%)";
    document.body.appendChild(img);
});

/* PUT | Chincheta - Ultimas Coordenadas
document.getElementById("addChincheta").addEventListener('click',function(event){
    const xy = document.getElementById('coordenadas').textContent;

    const img = document.createElement("img");
    img.src = "./chincheta.png";
    img.style.position = "absolute";
    img.style.left = `${x}px`;
    img.style.top = `${y}px`;
    img.style.transform = "translate(-50%, -50%)";
    document.body.appendChild(img);
});*/