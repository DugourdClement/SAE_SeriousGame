const buttonPlay = document.getElementById('playButton')
const windowJ = document.getElementById('fenetre')
const nextButton = document.getElementById('5');
const body = document.querySelector("body");
const text = document.getElementById('text');
let path = [];
let years = ['2022', '2032', '2035', '2039', '2043', '2050', '2056', '2068'];
let yearData = {};

const allButtons = [];
for (let i = 1; i < 5; i++) {
    allButtons.push(document.getElementById(i.toString()));
}

let isMaried = false;
let hasGoodJob = false;
let hasChildren = false;
let GouvWork = false;
let hasNewJob = false;
let isChipped = false;
let prison = false;
let armsUp = false;
let hardWork = false;

buttonPlay.addEventListener('click', openWindow);

/**
 * Crée une promesse qui se résout lorsqu'un bouton est cliqué.
 *
 * @returns {Promise} Une promesse qui se résout lorsqu'un bouton est cliqué.
 */
function createClickPromiseAnswer() {
    return new Promise((resolve) => {
        function handleClick() {
            path.push(parseInt(this.getAttribute('id')));
            resolve();
            for (let i = 0; i < allButtons.length; i++) {
                allButtons[i].removeEventListener("click", handleClick);
            }
        }

        for (let i = 0; i < allButtons.length; i++) {
            allButtons[i].addEventListener("click", handleClick);
        }
    })
}

/**
 * Crée une promesse qui est résolue lorsque le bouton "Next" est cliqué.
 * Le bouton "Next" devient visible dès l'appel de cette fonction.
 * @return Promise Une promesse qui est résolue lorsqu'on clique sur le bouton "Next".
 */
function createClickPromiseNext() {
    nextButton.style.visibility = 'visible';
    return new Promise((resolve) => {
        nextButton.addEventListener("click", () => {
            resolve();
            nextButton.style.visibility = 'hidden';
        });
    });
}

/**
 * Réinitialise les variables et les éléments de l'interface graphique à leur état initial.
 * Utile pour recommencer le jeu à partir de zéro...
 *
 * @return void
 */
function reset() {
    windowJ.style.backgroundImage = "none";
    windowJ.style.visibility = 'hidden';
    text.style.visibility = 'hidden';
    body.style.overflow = "visible";
    years = ['2022', '2032', '2035', '2039', '2043', '2050', '2056', '2068'];
    path = [];
    isMaried = false;
    hasGoodJob = false;
    hasChildren = false;
    GouvWork = false;
    hasNewJob = false;
    isChipped = false;
    prison = false;
    armsUp = false;
    hardWork = false;
}

/**
 * Ouvre la fenêtre de jeu et affiche un message de chargement. ( utile pour quand le chargement à la bd est long )
 * Récupère les données nécessaires via getData() avant de lancer la partie.
 */
async function openWindow() {
    yearData = await getData();
    console.log(yearData);

    windowJ.style.visibility = 'visible';
    text.style.visibility = 'visible';
    text.innerText = "Chargement...";

    body.style.overflow = "hidden";
    await game();

}

/**
 Modifie la visibilité des boutons et du texte.
 @param {string} value - La valeur de visibilité pour le texte et les boutons.
 @param {number} nb - Le nombre de boutons à modifier.
 @returns {void}
 */
function setButtonVisibility(value, nb) {
    setElementEmpty(nb);
    text.style.visibility = value;
    for (let i = 0; i < nb; i++) {
        allButtons[i].style.visibility = value;
    }
}

/**
 Efface le contenu des éléments texte et boutons.
 @param {number} nb - Le nombre de boutons à modifier.
 @returns {void}
 */
function setElementEmpty(nb) {
    text.innerHTML = '';
    for (let i = 0; i < nb; i++) {
        allButtons[i].innerHTML = '';
    }
}

/**
 Cette fonction permet de modifier le texte et la visibilité des boutons en fonction des options passées en paramètre.
 @param nbOpt
 @param {Array} options - Les options qui seront affichées sur les boutons.
 */
function setTextButton(nbOpt, options) {
    setButtonVisibility('hidden', 4);
    let buttons = [];
    for (let i = 0; i < nbOpt; i++) {
        buttons.push(allButtons[i]);
    }
    setButtonVisibility('visible', nbOpt);

    for (let i = 0; i < nbOpt; i++) {
        buttons[i].innerHTML = options[i];
    }
}

/**
 * Affiche le choix de l'utilisateur et les options qui lui sont proposées.
 * @param choiceNumber
 * @param choiceDetails
 * @returns {Promise<void>}
 */
async function displayChoice(choiceNumber, choiceDetails) {
    windowJ.style.backgroundImage = "url('/sae/gui/Picture/visuels-jeu/" + years[0] + "/choix_" + years[0] + "_" + choiceNumber + ".jpg')";
    setTextButton(choiceDetails.nbOpt, choiceDetails.opt);
    text.innerText = choiceDetails.choice;
    await createClickPromiseAnswer();
}

/**
 * Affiche le texte supplémentaire et les options qui lui sont proposées.
 * @param textNumber
 * @param textSup
 * @returns {Promise<void>}
 */
async function displayTextSup(textNumber, textSup) {
    setButtonVisibility('hidden', 4);
    text.style.visibility = 'visible';
    windowJ.style.backgroundImage = "url('/sae/gui/Picture/visuels-jeu/" + years[0] + "/choix_" + years[0] + "_" + textNumber + ".jpg')";
    text.innerText = textSup;
    await createClickPromiseNext();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2022.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2022() {
    await displayTextSup(1, yearData[0].textSup[1]);
    console.log(yearData[0].choice);
    await displayChoice(1, yearData[0].choice[0]);

    if (/^1\d*$/.test(path.toString())) {
        await displayChoice(1, yearData[0].choice[1]);
        /*  function for open a popup when an option is clicked but do not work
        function openPopup(rs) {
            return new Promise((resolve) => {
                let opened = window.open("CGU/cgu" + rs + ".html", "Popup", "width=800,height=700");
                opened.onunload = () => {
                    resolve();
                };
            });
        }

            if (choice.slice(-1)[0] === 1) await openPopup("twitter");
            else if (choice.slice(-1)[0] === 2) await openPopup("insta");
            else if (choice.slice(-1)[0] === 3) await openPopup("fb");
            else if (choice.slice(-1)[0] === 4) await openPopup("snap");
         */

    } else {
        await displayTextSup("1_1", yearData[0].textSup[0]);
    }

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2032.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2032() {
    await displayTextSup(1, yearData[1].textSup[1]);
    await displayChoice(1, yearData[1].choice[0]); //netoyer son profil
    if (path.slice(-1)[0] === 1) hasGoodJob = true;
    await displayTextSup(2, yearData[1].textSup[0]);
    await displayChoice(2, yearData[1].choice[1]); //colect données rs + intenet

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2035.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2035() {
    if (hasGoodJob) await displayTextSup(1, yearData[2].textSup[1]); //taf bien
    else await displayTextSup(2, yearData[2].textSup[0]); //taf nul

    await displayTextSup(3, yearData[2].textSup[3]); //google

    text.style.bottom = '29%';
    await displayChoice(3, yearData[2].choice[1]);
    text.style.bottom = '25%';

    await displayTextSup(4, yearData[2].textSup[2]); //reco facial
    await displayChoice(4, yearData[2].choice[0]); //reco facial

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2036.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2039() {
    await displayTextSup(1, yearData[3].textSup[2]);
    await displayChoice(1, yearData[3].choice[0]);
    if (path.slice(-1)[0] === 1) isMaried = true;

    await displayTextSup(1, yearData[3].textSup[3]);
    if (/^(\d+,){3}\d+,1.*$/.test(path.toString())) await displayTextSup(2, yearData[3].textSup[0]);
    else await displayTextSup(2, yearData[3].textSup[4]);

    if (/^\d+,\d+,2.*$/.test(path.toString())) await displayTextSup(4, yearData[3].textSup[1]);

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2043.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2043() {
    if (isMaried) {
        await displayTextSup(1, yearData[4].textSup[2]);
        if (hasGoodJob) await displayTextSup(1, yearData[4].textSup[5]);
        else await displayTextSup(1, yearData[4].textSup[4]);
    }

    if (/^(\d+,){3}\d+,1.*$/.test(path.toString())) await displayTextSup(2, yearData[4].textSup[3]); // publicité dans la rue

    let faceRecognitionData = /^\d+,\d+,2.*$/.test(path.toString()) && /^(\d+,){3}\d+,1.*$/.test(path.toString());
    if (isMaried && hasGoodJob && faceRecognitionData) hasChildren = true;

    if (faceRecognitionData) await displayTextSup(3, yearData[4].textSup[6]);
    if (isMaried) {
        if (faceRecognitionData) await displayTextSup(4, yearData[4].textSup[7]);
        else await displayTextSup(4, yearData[4].textSup[8]);

        if (hasChildren) {
            await displayTextSup(5, yearData[4].textSup[1]);
        } else await displayTextSup(6, yearData[4].textSup[0]);
    }

    if (!isMaried) {
        if (hasGoodJob) await displayChoice(8, yearData[4].choice[1]);
        else await displayChoice(7, yearData[4].choice[0]);
        if (path.slice(-1)[0] === 1) GouvWork = true;
    }

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2050.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2050() {
    if (hasChildren) {
        await displayTextSup(1, yearData[5].textSup[5]);
        await displayChoice(2, yearData[5].choice[4]);
        if (path.slice(-1)[0] === 1) hasNewJob = true;
    } else if (isMaried) {
        await displayTextSup(3, yearData[5].textSup[4]);
        await displayChoice(2, yearData[5].choice[3]);
        if (path.slice(-1)[0] === 1) hasNewJob = true;
    }

    if (GouvWork && !hasGoodJob) {
        await displayChoice(2, yearData[5].choice[6]); // opération bras

        if (path.slice(-1)[0] === 1) armsUp = true;
    } else if (!GouvWork && !isMaried) {
        await displayTextSup(6, yearData[5].textSup[6]);
        await displayChoice(7, yearData[5].choice[1]); // tribunal

        if (path.slice(-1)[0] === 2) hardWork = true;
        else prison = true;
    }

    if (hasNewJob) {
        await displayTextSup(4, yearData[5].textSup[1]);
        await displayChoice(4, yearData[5].choice[0]);

        if (path.slice(-1)[0] === 1) isChipped = true;
    } else if (!hasGoodJob && !hardWork) {
        await displayTextSup(5, yearData[5].textSup[0]);
        await displayChoice(5, yearData[5].choice[5]); // voisin

        if (path.slice(-1)[0] === 1) {
            await displayTextSup(6, yearData[5].textSup[3]);
            await displayChoice(7, yearData[5].choice[2]); // prison 4ans

            if (path.slice(-1)[0] === 1) prison = true;
        } else {
            await displayTextSup(6, yearData[5].textSup[2]);
            await displayChoice(7, yearData[5].choice[2]); //prison 2ans

            if (path.slice(-1)[0] === 1) prison = true;
        }
    }
    if (GouvWork && hasGoodJob) await displayTextSup(3, yearData[5].textSup[7]);

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2056.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2056() {
    if (isChipped) {
        await displayTextSup(1, yearData[6].textSup[1]);
        await displayChoice(1, yearData[5].choice[0]);
    } else {
        await displayTextSup(1, yearData[6].textSup[0]);
        await displayChoice(1,  yearData[5].choice[1]);
    }
    if (hardWork) await displayTextSup(2, yearData[6].textSup[3]);
    if (armsUp) await displayTextSup(3, yearData[6].textSup[4]);

    await displayTextSup(4, yearData[6].textSup[2]);

    async function end(nb) {
        setButtonVisibility('hidden', 4);
        windowJ.style.backgroundImage = "url('./Picture/visuels-jeu/" + years[0] + "/end_" + nb + ".jpg')";
        await createClickPromiseNext();
    }

    if (isMaried) {
        if (isChipped) await end(1);
        else await end(2);
    } else if (isChipped) await end(3);
    else if (hardWork) await end(5);
    else if (!prison || !armsUp || !hasGoodJob) await end(4);
    else if (prison) await end(5);
}

/**

 Fonction asynchrone qui affiche le contexte du jeu et crée une promesse de clic sur le bouton suivant.
 @returns {Promise} Une promesse résolue une fois que l'utilisateur a cliqué sur le bouton suivant.
 */
async function context() {
    setButtonVisibility('hidden', 4);
    let clickPromise = createClickPromiseNext();
    nextButton.style.visibility = "hidden";
    windowJ.style.backgroundImage = "url('/sae/gui/Picture/années/" + years[0] + ".png')";

    setTimeout(async function () {
        windowJ.style.backgroundImage = "url('/sae/gui/Picture/journal/journal" + years[0] + ".png')";
        nextButton.style.visibility = "visible";
    }, 2000);
    await clickPromise;

    if (years[0] !== '2043' && years[0] !== '2056') {
        windowJ.style.backgroundImage = "url('/sae/gui/Picture/journal/journalSup" + years[0] + ".jpg')";
    }
    await createClickPromiseNext();
}

/**
 * Fonction asynchrone qui récupère les données du jeu.
 * @returns {Promise<boolean>} - Une promesse résolue une fois que les données ont été récupérées.
 */
async function getData() {
    try {
        const response = await fetch('/sae/data/cache_YearsData.json');
        const data = await response.text();
        return JSON.parse(data);
    } catch (error) {
        console.error('Error: ' + error);
        return null;
    }
}

/**
 * Fonction asynchrone qui lance le jeu.
 * @returns {Promise<void>} - Une promesse résolue une fois que le jeu est terminé.
 */
async function game() {
    console.log(yearData);
    await context();
    await year2022();
    await context();
    await year2032();
    await context();
    await year2035();
    await context();
    await year2039();
    await context();
    await year2043();
    await context();
    await year2050();
    await context();
    await year2056();
    reset();
}