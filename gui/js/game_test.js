// // Importer la fonction à tester
// const createClickPromiseAnswer = require('./createClickPromiseAnswer');
// const reset = require('./reset');
//
// // Créer un objet "mock" pour simuler le comportement des boutons
// const mockButton = {
//     addEventListener: jest.fn(),
//     removeEventListener: jest.fn()
// };
//
// // Définir les tests
// describe('createClickPromiseAnswer', () => {
//     beforeEach(() => {
//         // Réinitialiser les objets mock avant chaque test
//         mockButton.addEventListener.mockReset();
//         mockButton.removeEventListener.mockReset();
//     });
//
//     it('retourne une promesse', () => {
//         // Appeler la fonction et tester le type de retour
//         const promise = createClickPromiseAnswer(mockButton);
//         expect(promise).toBeInstanceOf(Promise);
//     });
//
//     it('ajoute un gestionnaire d\'événements click pour chaque bouton', () => {
//         // Appeler la fonction
//         createClickPromiseAnswer(mockButton);
//
//         // Vérifier que la méthode addEventListener a été appelée pour chaque bouton
//         expect(mockButton.addEventListener).toHaveBeenCalledTimes(4);
//     });
//
//     it('supprime les gestionnaires d\'événements click après que la promesse a été résolue', async () => {
//         // Appeler la fonction
//         const promise = createClickPromiseAnswer(mockButton);
//
//         // Simuler un clic sur un bouton pour résoudre la promesse
//         mockButton.addEventListener.mock.calls[0][1]();
//
//         // Attendre que la promesse soit résolue
//         await promise;
//
//         // Vérifier que la méthode removeEventListener a été appelée pour chaque bouton
//         expect(mockButton.removeEventListener).toHaveBeenCalledTimes(4);
//     });
// });
//
// // Définir les tests
// describe('reset', () => {
//     let windowJ;
//     let text;
//     let body;
//
//     beforeEach(() => {
//         // Créer un DOM virtuel avant chaque test
//         document.body.innerHTML = `
//       <div id="fenetre" style="background-image: url('some-image.jpg'); visibility: visible;"></div>
//       <div id="text" style="visibility: visible;"></div>
//     `;
//         windowJ = document.getElementById('fenetre');
//         text = document.getElementById('text');
//         body = document.querySelector('body');
//         body.style.overflow = 'hidden';
//     });
//
//     it('réinitialise le style de la fenêtre', () => {
//         // Appeler la fonction
//         reset();
//
//         // Vérifier que les propriétés CSS ont été réinitialisées
//         expect(windowJ.style.backgroundImage).toBe('none');
//         expect(windowJ.style.visibility).toBe('hidden');
//     });
//
//     it('cache le texte', () => {
//         // Appeler la fonction
//         reset();
//
//         // Vérifier que la propriété CSS a été réinitialisée
//         expect(text.style.visibility).toBe('hidden');
//     });
//
//     it('réinitialise la propriété overflow du body', () => {
//         // Appeler la fonction
//         reset();
//
//         // Vérifier que la propriété CSS a été réinitialisée
//         expect(body.style.overflow).toBe('visible');
//     });
//
//     it('réinitialise les variables globales', () => {
//         // Appeler la fonction
//         reset();
//
//         // Vérifier que les variables ont été réinitialisées
//         expect(years).toEqual(['2022', '2032', '2035', '2039', '2043', '2050', '2056', '2068']);
//         expect(path).toEqual([]);
//         expect(isMaried).toBe(false);
//         expect(hasGoodJob).toBe(false);
//         expect(hasChildren).toBe(false);
//         expect(GouvWork).toBe(false);
//         expect(hasNewJob).toBe(false);
//         expect(isChipped).toBe(false);
//         expect(prison).toBe(false);
//         expect(armsUp).toBe(false);
//         expect(hardWork).toBe(false);
//     });
// });

const { JSDOM } = require("jsdom");
const fs = require("fs");
const path = require("path");

const html = fs.readFileSync(path.resolve(__dirname, "index.html"), "utf8");

let dom;
let container;

beforeEach(() => {
    dom = new JSDOM(html, { runScripts: "dangerously" });
    container = dom.window.document;
});

test("Vérifie si les éléments initiaux sont correctement initialisés", () => {
    const buttonPlay = container.getElementById("playButton");
    const windowJ = container.getElementById("fenetre");
    const nextButton = container.getElementById("5");
    const body = container.querySelector("body");
    const text = container.getElementById("text");

    expect(buttonPlay).not.toBeNull();
    expect(windowJ).not.toBeNull();
    expect(nextButton).not.toBeNull();
    expect(body).not.toBeNull();
    expect(text).not.toBeNull();
});

test("Vérifie si la fonction reset() réinitialise les éléments et les variables", () => {
    const reset = dom.window.reset;

    // Initialisation des valeurs
    dom.window.isMaried = true;
    dom.window.hasGoodJob = true;
    dom.window.hasChildren = true;
    dom.window.GouvWork = true;
    dom.window.hasNewJob = true;
    dom.window.isChipped = true;
    dom.window.prison = true;
    dom.window.armsUp = true;
    dom.window.hardWork = true;

    reset();

    // Vérification des valeurs après réinitialisation
    expect(dom.window.isMaried).toBe(false);
    expect(dom.window.hasGoodJob).toBe(false);
    expect(dom.window.hasChildren).toBe(false);
    expect(dom.window.GouvWork).toBe(false);
    expect(dom.window.hasNewJob).toBe(false);
    expect(dom.window.isChipped).toBe(false);
    expect(dom.window.prison).toBe(false);
    expect(dom.window.armsUp).toBe(false);
    expect(dom.window.hardWork).toBe(false);
});



function getDataTest() {
    getData().then(data => console.log(data)).catch(error => console.error(error));
}

function createClickPromiseNextTest() {
    const { JSDOM } = require('jsdom');
    const { window } = new JSDOM('<!doctype html><html><body></body></html>');
    global.window = window;
    global.document = window.document;

    const createClickPromiseNext = require('./createClickPromiseNext');

    describe('createClickPromiseNext', () => {
        it('should return a promise that resolves when the next button is clicked', async () => {
            // Create a dummy next button
            const nextButton = document.createElement('button');
            nextButton.id = 'next-button';
            document.body.appendChild(nextButton);

            // Call the function and wait for the promise to resolve
            const promise = createClickPromiseNext();
            nextButton.click();
            await promise;

            // Check that the promise resolved successfully
            expect(promise).resolves.toBeUndefined();

            // Check that the next button is hidden after the promise resolves
            expect(nextButton.style.visibility).toBe('hidden');
        });
    });

}

function openWindowTest() {

}


function createClickPromiseAnswerTest() {

}