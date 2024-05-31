(function () {
    console.log("REST API");

    // Function to fetch data based on country
    function fetchData(countryId) {
        let url = `https://gftnth00.mywhc.ca/tim10/wp-json/wp/v2/posts?categories=${countryId}&orderby=title&order=asc`;
        fetch(url)
            .then(function (response) {
                if (!response.ok) {
                    throw new Error(
                        "La requête a échoué avec le statut " + response.status
                    );
                }
                return response.json();
            })
            .then(function (data) {
                let restapi = document.querySelector(".contenu__restapi");
                restapi.innerHTML = '';
                data.forEach(function (article) {
                    let titre = article.title.rendered;
                    let contenu = article.content.rendered;
                    let image = extractImageFromContent(contenu);
                    contenu = truncateContent(contenu, 50); // Assuming we want to show the first 50 words
                    let carte = document.createElement("div");
                    carte.classList.add("restapi__carte");
                    carte.innerHTML = `
                        <h2>${titre}</h2>
                        ${image}
                        <p>${contenu}</p>                
                    `;
                    restapi.appendChild(carte);
                });
            })
            .catch(function (error) {
                console.error("Erreur lors de la récupération des données :", error);
            });
    }

    // Function to extract image from content
    function extractImageFromContent(content) {
        let div = document.createElement('div');
        div.innerHTML = content;
        let imgElement = div.querySelector('img');
        if (imgElement) {
            imgElement.classList.add('uniform-image-size'); // Add class for uniform image size
            return imgElement.outerHTML;
        }
        return '';
    }

    // Function to truncate content
    function truncateContent(content, words) {
        return content.split(/\s+/).slice(0, words).join(" ");
    }

    // Add event listeners for country buttons
    let countryButtons = document.querySelectorAll(".country-button");
    countryButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            let countryName = button.getAttribute('data-country');
            let countryId = countryData[countryName];
            fetchData(countryId);
        });
    });

    // Fetch data by default for the first country when the page loads
    let defaultCountryButton = document.querySelector(".country-button");
    if (defaultCountryButton) {
        let defaultCountryName = defaultCountryButton.getAttribute('data-country');
        let defaultCountryId = countryData[defaultCountryName];
        fetchData(defaultCountryId);
    }
})();
