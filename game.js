const buttonPlay = document.getElementById('playButton')
const windowJ = document.getElementById('fenetre')
const nextButton = document.getElementById('5');
const body = document.querySelector("body");
const text = document.getElementById('text');
const path = [];
const years = ['2022', '2032', '2035', '2039', '2043', '2050', '2056', '2068'];
var opt = [];

const allButtons = [];
for (let i = 1; i < 5; i++) {
    allButtons.push(document.getElementById(i.toString()));
}

let isMaried = false;
let hasGoodJob = false;
let hasChildren = false;
let hasNewJob = false;
let isChipped = false;
let prison = false;


buttonPlay.addEventListener('click', openWindow);

function createClickPromiseAnswer(){
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

function createClickPromiseNext(){
    nextButton.style.visibility = 'visible';
    return new Promise((resolve) => {
        nextButton.addEventListener("click", () => {
            resolve();
            nextButton.style.visibility = 'hidden';
        });
    });
}

async function openWindow() {
    windowJ.style.visibility = 'visible';
    text.style.visibility = 'visible';
    text.innerText = "Chargement...";
    let status = await getData();
    if (status === true) {
        body.style.overflow = "hidden";
        await game();
    }
}

function setButtonVisibility(value, nb){
    setElementEmpty(nb);
    text.style.visibility = value;
    for (let i = 0; i < nb; i++) {
        allButtons[i].style.visibility = value;
    }
}
function setElementEmpty(nb){
    text.innerHTML = '';
    for (let i = 0; i < nb; i++) {
        allButtons[i].innerHTML = '';
    }
}

function setTextButton(options) {
    setButtonVisibility('hidden', 4);
    let buttons = [];
    for (let i = 0; i < options.length; i++) {
        buttons.push(allButtons[i]);
    }
    setButtonVisibility('visible',  buttons.length);

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].innerHTML = options[i];
    }
}

async function displayChoice(choiceNumber, opt) {
    windowJ.style.backgroundImage = "url('./Picture/visuels-jeu/" + years[0] + "/choix_" + years[0] + "_" + choiceNumber + ".jpg')";
    setTextButton(opt[1]);
    text.innerText = opt[0];
    let clickPromise = createClickPromiseAnswer();
    await clickPromise;
}

async function displayTextSup(textNumber, opt) {
    setButtonVisibility('hidden', 4);
    text.style.visibility = 'visible';
    windowJ.style.backgroundImage = "url('./Picture/visuels-jeu/" + years[0] + "/choix_" + years[0] + "_" + textNumber + ".jpg')";
    text.innerText = opt;
    let clickPromise = createClickPromiseNext();
    await clickPromise;
}

async function year2022(opt) {
    await displayTextSup(1, opt[3][0]);
    await displayChoice(1, opt[1]);

    if (/^1\d*$/.test(path.toString())) {
        await displayChoice(1, opt[2]);
        function openPopup(rs) {
            return new Promise((resolve) => {
                let opened = window.open("CGU/cgu" + rs + ".html", "Popup", "width=800,height=700");
                path.shift();
                opened.onunload = () => {
                    resolve();
                };
            });
        }
        if(/^1,1$/.test(path.toString())) await openPopup("twitter");
        else if(/^1,2$/.test(path.toString())) await openPopup("insta");
        else if(/^1,3$/.test(path.toString())) await openPopup("fb");
        else if(/^1,4$/.test(path.toString())) await openPopup("snap");
    }else{
        await displayTextSup("1_1", opt[3][1]);
    }

    years.shift();
    console.log(years);
}

async function year2032(opt) {
    await displayTextSup(1, opt[3][0]);
    await displayChoice(1, opt[1]); //netoyer son profil
    if(path.slice(-1)[0] === 1) hasGoodJob = true;
    await displayTextSup(2, opt[3][1]);
    await displayChoice(2, opt[2]); //colect données rs + intenet

    years.shift();
    console.log(years);
}

async function year2035(opt) {
    if (hasGoodJob) await displayTextSup(1, opt[3][0]); //taf bien
    else await displayTextSup(2, opt[3][1]); //taf nul

    await displayTextSup(3, opt[3][2]); //google
    text.style.bottom = '29%';
    await displayChoice(3, opt[2]);
    text.style.bottom = '25%';
    await displayChoice(4, opt[1]); //reco facial

    years.shift();
    console.log(years);
}

async function year2039(opt){
    await displayTextSup(1, opt[2][0]);
    await displayChoice(1, opt[1]);
    if(path.slice(-1)[0] === 1) isMaried = true;

    await displayTextSup(1, opt[2][1]);
    if(/^(\d+,){3}\d+,1.*$/.test(path.toString())) await displayTextSup(2, opt[2][2]); //se fait appeler par son nom dans la rue
    else await displayTextSup(2, opt[2][3]); //ne se fait pas appeler par son nom dans la rue

    if(/^\d+,\d+,2.*$/.test(path.toString())) await displayTextSup(4, opt[2][4]); //ammende rs

    years.shift();
    console.log(years);
}

async function year2043(opt){
    if (isMaried) {
        await displayTextSup(1, opt[2][0]);
        if (hasGoodJob) await displayTextSup(1, opt[2][1]); //confiant pour enfant
        else await displayTextSup(1, opt[2][2]); //inquié pour enfant
    }

    if(/^(\d+,){3}\d+,1.*$/.test(path.toString())) await displayTextSup(2, opt[2][3]); //ammende car reco facial

    let faceRecognitionData = /^\d+,\d+,2.*$/.test(path.toString()) && /^(\d+,){3}\d+,1.*$/.test(path.toString()); //reco facial + colecte données
    if(isMaried && hasGoodJob && faceRecognitionData) hasChildren = true;

    if(faceRecognitionData) await displayTextSup(3, opt[2][4]); //lettre police
    if(isMaried) {
        if (faceRecognitionData) await displayTextSup(4, opt[2][5]);
        else await displayTextSup(4, opt[2][6]);
        if (hasChildren) {
            await displayTextSup(5, opt[2][7]); //enfant
        }
        else await displayTextSup(6, opt[2][8]); //pas enfant
    }

    years.shift();
    console.log(years);
}

async function year2050(opt){
    if(hasChildren) {
        await displayTextSup(1, opt[7][1]);
        await displayChoice(2, opt[2]);
        if(path.slice(-1)[0] === 1) hasNewJob = true;
    }
    else {
        await displayTextSup(3, opt[7][0]);
        await displayChoice(2, opt[1]);
        if(path.slice(-1)[0] === 1) hasNewJob = true;
    } //3eme option pas d'enfant, pas marrié mais on lui propose le newJob

    if(hasNewJob){
        await displayTextSup(4, opt[7][2]);
        await displayChoice(4, opt[3]);
        if(path.slice(-1)[0] === 1) isChipped = true;
    } else if (!hasGoodJob) {
        await displayTextSup(5, opt[7][3]);
        await displayChoice(5, opt[4]);
        if(path.slice(-1)[0] === 1) {
            await displayTextSup(6, opt[7][4]);
            await displayChoice(7, opt[5]);
            if(path.slice(-1)[0] === 1) prison = true;
        } else {
            await displayTextSup(6, opt[7][5]);
            await displayChoice(7, opt[6]);
            if(path.slice(-1)[0] === 1) prison = true;
        }
    } //textSup monotonie de la vie si 3eme option au dessus mais bon travail

    years.shift();
    console.log(years);
}

async function year2056(opt){
    if (isChipped){
        await displayTextSup(1, opt[3][0]);
        await displayChoice(1, opt[1]);
    } else {
        await displayTextSup(1, opt[3][1]);
        await displayChoice(1, opt[2]);
    }

    async function end(nb){
        setButtonVisibility('hidden', 4);
        windowJ.style.backgroundImage = "url('./Picture/visuels-jeu/" + years[0] + "/end_" + nb + ".jpg')";
        let clickPromise = createClickPromiseNext();
        await clickPromise;
    }

    await displayTextSup(1, opt[3][2]); //image de fond
    if(isMaried){
        if(isChipped)await end(1);
        else await end(2);
    } else if(isChipped) await end(3);
    else if (!prison) await end(4);
    else if(prison) await end(5);


}


async function context() {
    setButtonVisibility('hidden', 4);
    let clickPromise = createClickPromiseNext();
    nextButton.style.visibility = "hidden";
    windowJ.style.backgroundImage = "url('./Picture/années/" + years[0] + ".png')";
    setTimeout(function () {
        windowJ.style.backgroundImage = "url('./Picture/journal/journal" + years[0] + ".png')";
        nextButton.style.visibility = "visible";
        return true;
    }, 2000);
    await clickPromise.then();
}

async function getData() {
    let response = await fetch('game_data.php');
    if (response.ok) {
        opt = await response.json();
        return true;
    } else {
        console.log("HTTP-Error: " + response.status);
    }
}

async function game() {
    console.log(opt);
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
}