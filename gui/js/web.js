// hamburger for mobile
let sidenav = document.getElementById("mySidenav");
let openBtn = document.getElementById("openBtn");
let closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

function openNav() {
    sidenav.classList.add("active");
}

function closeNav() {
    sidenav.classList.remove("active");
}

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