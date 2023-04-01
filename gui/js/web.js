// hamburger for mobile
let big_wrapper;
let hamburger_menu;

function declare() {
    big_wrapper = document.querySelector(".big-wrapper");
    hamburger_menu = document.querySelector(".hamburger-menu");
}

declare();

function events() {
    hamburger_menu.addEventListener("click", () => {
        big_wrapper.classList.toggle("active");
    });
}


events();

//resources
function r2032() {
    window.open("https://www.lemonde.fr/pixels/article/2020/12/10/la-cnil-inflige-des-amendes-a-google-et-amazon-pour-non-respect-de-la-legislation-sur-les-cookies_6062860_4408996.html");
    window.open("https://www.lemonde.fr/pixels/article/2022/01/06/la-cnil-inflige-de-lourdes-amendes-a-google-et-facebook-pour-leurs-cookies_6108384_4408996.html");
    window.open("https://www.economie.gouv.fr/entreprises/obligations-donnees-personnelles-rgpd ");
}

function r2035() {
    window.open("https://observatoire-ia.ulaval.ca/petit-guide-sur-la-reconnaissance-faciale/");
    window.open("https://www.amnesty.fr/liberte-d-expression/petitions/non-a-la-reconnaissance-faciale");
}

function r2039() {
    window.open("https://www.journaldunet.com/ebusiness/crm-marketing/1134055-quels-sont-les-dangers-des-cookies/");
    window.open("https://www.pandasecurity.com/fr/mediacenter/mobile-news/cookies/");
}

function r20392() {
    window.open("https://medium.com/ai-for-tomorrow/neuralink-il-est-urgent-de-parler-de-science-et-d%C3%A9thique-63e56f4fb41d");
    window.open("https://www.futura-sciences.com/tech/actualites/intelligence-artificielle-projet-neuralink-elon-musk-inquiete-beaucoup-scientifiques-95495/");
}


// get the active filter from localStorage or set it to null
let activeFilter = localStorage.getItem('activeFilter') || null;

// apply the active filter if it exists
if (activeFilter) {
    applyFilter(activeFilter);
}

// add event listeners to filter options
document.querySelectorAll('.filter-option').forEach(function (option) {
    option.addEventListener('click', function () {
        const filterId = option.getAttribute('data-filter');
        activeFilter = `url('/sae/gui/filters.svg#${filterId}')`;
        applyFilter(activeFilter);
        localStorage.setItem('activeFilter', activeFilter);
    });
});

// apply the given filter to the necessary elements
function applyFilter(filter) {
    if (filter == null) {
        activeFilter = null;
    }

    const elements = document.querySelectorAll('html');
    elements.forEach(function (element) {
        element.style.filter = filter;
    });
}