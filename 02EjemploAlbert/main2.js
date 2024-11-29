const btn = document.getElementById('btnFetchCharacters');
const div = document.getElementById('characters');

btn.addEventListener('click', () => {
    fetch('https://rickandmortyapi.com/api/character')
    .then((response) => response.json())
    .then((data) => rendersCharacters(data.results))
    .catch(error => {
        div.innerHTML = `<p>Ocurrió un error: ${error.message}</p>`;
    });
});

function rendersCharacters(characters) {
    div.innerHTML = ""; // Limpiar el contenedor
    characters.forEach(character => {
        // Crear un elemento div para cada personaje
        const characterDiv = document.createElement("div");
        characterDiv.classList.add("character");
        
        // Crear el contenedor de la carta
        const card = document.createElement("div");
        card.classList.add("card");

        // Agregar el contenido de la imagen (frontal) y la información (trasera)
        card.innerHTML = `
            <img src="${character.image}" alt="${character.name}">
            <div class="character-info">
                <p><strong>${character.name}</strong></p>
                <p>Especie: ${character.species}</p>
                <p>Estado: ${character.status}</p>
            </div>
        `;

        // Agregar evento de clic para alternar la animación de volteo
        card.addEventListener("click", () => {
            card.classList.toggle("active");
        });

        // Añadir la carta al div del personaje
        characterDiv.appendChild(card);
        div.appendChild(characterDiv);
    });
}