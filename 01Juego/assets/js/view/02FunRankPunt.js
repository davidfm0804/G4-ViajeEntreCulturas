document.querySelector("[type='button']").style.position = "unset";
document.querySelector("[type='button']").style.display = "block";
document.querySelector("[type='button']").style.transform = "translate(0, 0)";
document.querySelector("[type='button']").style.margin = "0 auto";
document.querySelector("[type='button']").style.width = "25vw";

document.querySelector("[type='button']").addEventListener("click", function () {
    window.location.href = "./index.php?controller=Juego&action=juegoTablero";
});