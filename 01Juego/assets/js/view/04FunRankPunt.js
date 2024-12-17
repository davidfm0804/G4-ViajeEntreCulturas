styleButton(document.querySelector("[type='button']"));
styleButton(document.querySelector("[type='reset']"));

document.querySelector("[type='button']").addEventListener("click", function () {
    window.location.href = "./index.php?controller=Juego&action=juegoMemory";
});

document.querySelector("[type='reset']").addEventListener("click", function () {
    window.location.href = "./index.php";
});

function styleButton(button) {
    button.style.position = "unset";
    button.style.display = "block";
    button.style.transform = "translate(0, 0)";
    button.style.margin = "0 auto";
    button.style.marginBottom = "2vh";
    button.style.width = "25vw";
}