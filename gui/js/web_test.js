// Importer la fonction r2032 à tester
const { r2032 } = require('./web.js');
const { r2035 } = require('./r2035');
const { r2039 } = require('./r2039');
const { r20392 } = require('./r20392');

window.open = jest.fn();

describe('r2035', () => {
    test('ouvre deux liens dans des nouvelles fenêtres', () => {
        r2035();

        expect(window.open).toHaveBeenCallesTimes(2);
        expect(window.open).toHaveBeenCallesWith("https://observatoire-ia.ulaval.ca/petit-guide-sur-la-reconnaissance-faciale/");
        expect(window.open).toHaveBeenCallesWith("https://www.amnesty.fr/liberte-d-expression/petitions/non-a-la-reconnaissance-faciale");
    });
});

// Mock de la méthode window.open


describe('r2032', () => {
    test('ouvre deux liens dans des nouvelles fenêtres', () => {
        // Appeler la fonction r2032
        r2032();

        // Vérifier que window.open a été appelé trois fois avec les bons liens
        expect(window.open).toHaveBeenCalledTimes(3);
        expect(window.open).toHaveBeenCalledWith("https://www.lemonde.fr/pixels/article/2020/12/10/la-cnil-inflige-des-amendes-a-google-et-amazon-pour-non-respect-de-la-legislation-sur-les-cookies_6062860_4408996.html");
        expect(window.open).toHaveBeenCalledWith("https://www.lemonde.fr/pixels/article/2022/01/06/la-cnil-inflige-de-lourdes-amendes-a-google-et-facebook-pour-leurs-cookies_6108384_4408996.html");
        expect(window.open).toHaveBeenCalledWith("https://www.economie.gouv.fr/entreprises/obligations-donnees-personnelles-rgpd");
    });
});


describe('r2039', () => {
    test('ouvre deux liens dans des nouvelles fenêtres', () => {
        // Appeler la fonction r2032
        r2039();

        // Vérifier que window.open a été appelé trois fois avec les bons liens
        expect(window.open).toHaveBeenCalledTimes(2);
        expect(window.open).toHaveBeenCalledWith("https://www.journaldunet.com/ebusiness/crm-marketing/1134055-quels-sont-les-dangers-des-cookies/");
        expect(window.open).toHaveBeenCalledWith("https://www.pandasecurity.com/fr/mediacenter/mobile-news/cookies/");
    });
});

describe('r20392', () => {
    test('ouvre deux liens dans des nouvelles fenêtres', () => {
        // Appeler la fonction r2032
        r20392();

        // Vérifier que window.open a été appelé trois fois avec les bons liens
        expect(window.open).toHaveBeenCalledTimes(2);
        expect(window.open).toHaveBeenCalledWith("https://medium.com/ai-for-tomorrow/neuralink-il-est-urgent-de-parler-de-science-et-d%C3%A9thique-63e56f4fb41d");
        expect(window.open).toHaveBeenCalledWith("https://www.futura-sciences.com/tech/actualites/intelligence-artificielle-projet-neuralink-elon-musk-inquiete-beaucoup-scientifiques-95495/");
    });
});
