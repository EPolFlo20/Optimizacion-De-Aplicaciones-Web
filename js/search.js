document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.querySelector("[data-search]");
    const newsContainer = document.getElementById("div_noticias");

    searchInput.addEventListener("input", e => {
        const searchTerm = e.target.value.toLowerCase();
        const newsItems = newsContainer.getElementsByClassName("tabla_noticias");

        Array.from(newsItems).forEach(item => {
            const title = item.querySelector(".titulo").textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                console.log(item.value)
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    });
});
