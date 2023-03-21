const buttonPlay = document.getElementById('playButton')
const windowJ = document.getElementById('fenetre')
const nextButton = document.getElementById('5');
const body = document.querySelector("body");
const text = document.getElementById('text');
let path = [];
let years = ['2022', '2032', '2035', '2039', '2043', '2050', '2056', '2068'];
let opt = [];
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
    await getData();
    windowJ.style.visibility = 'visible';
    text.style.visibility = 'visible';
    text.innerText = "Chargement...";
    if (typeof yearData === 'object' && Object.keys(yearData).length === 0) {
        body.style.overflow = "hidden";
        await game();
    }
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
 @param {Array} options - Les options qui seront affichées sur les boutons.
 */
function setTextButton(options) {
    setButtonVisibility('hidden', 4);
    let buttons = [];
    for (let i = 0; i < options.length; i++) {
        buttons.push(allButtons[i]);
    }
    setButtonVisibility('visible', buttons.length);

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].innerHTML = options[i];
    }
}

/**
 * Affiche le choix de l'utilisateur et les options qui lui sont proposées.
 * @param choiceNumber
 * @param opt
 * @returns {Promise<void>}
 */
async function displayChoice(choiceNumber, opt) {
    windowJ.style.backgroundImage = "url('./Picture/visuels-jeu/" + years[0] + "/choix_" + years[0] + "_" + choiceNumber + ".jpg')";
    setTextButton(opt[1]);
    text.innerText = opt[0];
    await createClickPromiseAnswer();
}

/**
 * Affiche le texte supplémentaire et les options qui lui sont proposées.
 * @param textNumber
 * @param opt
 * @returns {Promise<void>}
 */
async function displayTextSup(textNumber, opt) {
    setButtonVisibility('hidden', 4);
    text.style.visibility = 'visible';
    windowJ.style.backgroundImage = "url('./Picture/visuels-jeu/" + years[0] + "/choix_" + years[0] + "_" + textNumber + ".jpg')";
    text.innerText = opt;
    await createClickPromiseNext();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2022.
 * @param opt - Les options qui seront affichées sur les boutons.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2022(opt) {
    await displayTextSup(1, opt[3][0]);
    await displayChoice(1, opt[1]);

    if (/^1\d*$/.test(path.toString())) {
        await displayChoice(1, opt[2]);
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
        await displayTextSup("1_1", opt[3][1]);
    }

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2032.
 * @param opt - Les options qui seront affichées sur les boutons.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2032(opt) {
    await displayTextSup(1, opt[3][0]);
    await displayChoice(1, opt[1]); //netoyer son profil
    if (path.slice(-1)[0] === 1) hasGoodJob = true;
    await displayTextSup(2, opt[3][1]);
    await displayChoice(2, opt[2]); //colect données rs + intenet

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2035.
 * @param opt - Les options qui seront affichées sur les boutons.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2035(opt) {
    if (hasGoodJob) await displayTextSup(1, opt[3][0]); //taf bien
    else await displayTextSup(2, opt[3][1]); //taf nul

    await displayTextSup(3, opt[3][2]); //google
    text.style.bottom = '29%';
    await displayChoice(3, opt[2]);
    text.style.bottom = '25%';
    await displayChoice(4, opt[1]); //reco facial

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2036.
 * @param opt - Les options qui seront affichées sur les boutons.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2039(opt) {
    await displayTextSup(1, opt[2][0]);
    await displayChoice(1, opt[1]);
    if (path.slice(-1)[0] === 1) isMaried = true;

    await displayTextSup(1, opt[2][1]);
    if (/^(\d+,){3}\d+,1.*$/.test(path.toString())) await displayTextSup(2, opt[2][2]);
    else await displayTextSup(2, opt[2][3]);

    if (/^\d+,\d+,2.*$/.test(path.toString())) await displayTextSup(4, opt[2][4]);

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2043.
 * @param opt - Les options qui seront affichées sur les boutons.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2043(opt) {
    if (isMaried) {
        await displayTextSup(1, opt[3][0]);
        if (hasGoodJob) await displayTextSup(1, opt[3][1]);
        else await displayTextSup(1, opt[3][2]);
    }

    if (/^(\d+,){3}\d+,1.*$/.test(path.toString())) await displayTextSup(2, opt[3][3]);

    let faceRecognitionData = /^\d+,\d+,2.*$/.test(path.toString()) && /^(\d+,){3}\d+,1.*$/.test(path.toString());
    if (isMaried && hasGoodJob && faceRecognitionData) hasChildren = true;

    if (faceRecognitionData) await displayTextSup(3, opt[3][4]);
    if (isMaried) {
        if (faceRecognitionData) await displayTextSup(4, opt[3][5]);
        else await displayTextSup(4, opt[3][6]);
        if (hasChildren) {
            await displayTextSup(5, opt[3][7]);
        } else await displayTextSup(6, opt[3][8]);
    }

    if (!isMaried) {
        if (hasGoodJob) await displayChoice(8, opt[1]);
        else await displayChoice(7, opt[2]);
        if (path.slice(-1)[0] === 1) GouvWork = true;
    }

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2050.
 * @param opt - Les options qui seront affichées sur les boutons.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2050(opt) {
    if (hasChildren) {
        await displayTextSup(1, opt[9][1]);
        await displayChoice(2, opt[2]);
        if (path.slice(-1)[0] === 1) hasNewJob = true;
    } else if (isMaried) {
        await displayTextSup(3, opt[9][0]);
        await displayChoice(2, opt[1]);
        if (path.slice(-1)[0] === 1) hasNewJob = true;
    }
    if (GouvWork && !hasGoodJob) {
        await displayChoice(2, opt[7]);
        if (path.slice(-1)[0] === 1) armsUp = true;
    } else if (!GouvWork && !isMaried) {
        await displayTextSup(6, opt[9][6]);
        await displayChoice(7, opt[8]);
        if (path.slice(-1)[0] === 2) hardWork = true;
        else prison = true;
    }

    if (hasNewJob) {
        await displayTextSup(4, opt[9][2]);
        await displayChoice(4, opt[3]);
        if (path.slice(-1)[0] === 1) isChipped = true;
    } else if (!hasGoodJob && !hardWork) {
        await displayTextSup(5, opt[9][3]);
        await displayChoice(5, opt[4]);
        if (path.slice(-1)[0] === 1) {
            await displayTextSup(6, opt[9][4]);
            await displayChoice(7, opt[5]);
            if (path.slice(-1)[0] === 1) prison = true;
        } else {
            await displayTextSup(6, opt[9][5]);
            await displayChoice(7, opt[6]);
            if (path.slice(-1)[0] === 1) prison = true;
        }
    }
    if (GouvWork && hasGoodJob) await displayTextSup(3, opt[9][7]);

    years.shift();
}

/**
 * Affiche le texte de fin et les options qui lui sont proposées pour l'année 2056.
 * @param opt - Les options qui seront affichées sur les boutons.
 * @returns {Promise<void>} - Une promesse qui est résolue lorsque l'utilisateur clique sur le bouton "Next".
 */
async function year2056(opt) {
    if (isChipped) {
        await displayTextSup(1, opt[3][0]);
        await displayChoice(1, opt[1]);
    } else {
        await displayTextSup(1, opt[3][1]);
        await displayChoice(1, opt[2]);
    }
    if (hardWork) await displayTextSup(2, opt[3][2]);
    if (armsUp) await displayTextSup(3, opt[3][3]);

    async function end(nb) {
        setButtonVisibility('hidden', 4);
        windowJ.style.backgroundImage = "url('./Picture/visuels-jeu/" + years[0] + "/end_" + nb + ".jpg')";
        await createClickPromiseNext();
    }

    await displayTextSup(4, opt[3][4]);

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
    windowJ.style.backgroundImage = "url('./Picture/années/" + years[0] + ".png')";

    setTimeout(async function () {
        windowJ.style.backgroundImage = "url('./Picture/journal/journal" + years[0] + ".png')";
        nextButton.style.visibility = "visible";
    }, 2000);
    await clickPromise;

    if (years[0] !== '2043' && years[0] !== '2056') {
        windowJ.style.backgroundImage = "url('./Picture/journal/journalSup" + years[0] + ".jpg')";
    }
    await createClickPromiseNext();
}

/**
 * Fonction asynchrone qui récupère les données du jeu.
 * @returns {Promise<boolean>} - Une promesse résolue une fois que les données ont été récupérées.
 */
async function getData() {
    try {
        const response = await fetch('data/cache_YearData.txt');
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
    await year2022(opt[1]);
    await context();
    await year2032(opt[2]);
    await context();
    await year2035(opt[3]);
    await context();
    await year2039(opt[4]);
    await context();
    await year2043(opt[5]);
    await context();
    await year2050(opt[6]);
    await context();
    await year2056(opt[7]);
    reset();
}