document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.querySelector("[data-search]");
    const newsContainer = document.getElementById("div_noticias");

    searchInput.addEventListener("input", e => {
        const searchTerm = e.target.value.toLowerCase();
        const newsItems = newsContainer.getElementsByClassName("noticia");

        Array.from(newsItems).forEach(item => {
            const title = item.querySelector(".titulo a").textContent.toLowerCase(); // Actualiza el selector aquí
            if (title.includes(searchTerm)) {
                item.style.display = "flex"; // Cambia "block" a "flex" si tu contenedor de noticias está utilizando display: flex
            } else {
                item.style.display = "none";
            }
        });
    });
});