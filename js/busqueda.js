document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.querySelector("[data-search]");
    const newsContainer = document.getElementById("div_noticias");
    const noResultsMessage = document.querySelector("#no-results");

    searchInput.addEventListener("input", e => {
        console.log('Input event fired');
        const searchTerm = e.target.value.toLowerCase();
        const newsItems = newsContainer.getElementsByClassName("noticia");
        console.log(newsItems);
        let resultsCount = 0;

        Array.from(newsItems).forEach(item => {
            const title = item.querySelector(".titulo a").textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                item.style.display = "flex";
                resultsCount++;
                console.log(`Results count: ${resultsCount}`);
            } else {
                item.style.display = "none";
            }
        });

        if (resultsCount > 0) {
            noResultsMessage.style.display = "none";
        } else {
            noResultsMessage.innerHTML = `
            <img src="../img/no_results.png" alt="No se encontraron resultados">
            <h1>No se encontraron resultados</h1>
            `;
            noResultsMessage.style.display = "flex";
        }
        console.log(`Message display: ${noResultsMessage.style.display}`);
    });
});