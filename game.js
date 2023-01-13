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
let goodJob = false;
let hasChildren = false;
let newJob = false;
let chipped = false;

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

    let choice = /^1\d*$/;
    if (choice.test(path.toString())) {
        await displayChoice(1, opt[2]);
        function openPopup(rs) {
            return new Promise((resolve) => {
                let opened = window.open("CGU/cgu" + rs + ".html", "Popup", "width=800,height=700");
                opened.onunload = () => {
                    resolve();
                };
            });
        }
        let choiceTwitter = /^1,1$/;
        let choiceInsta = /^1,2$/;
        let choiceFacebook = /^1,3$/;
        let choiceSnap= /^1,4$/;
        if(choiceTwitter.test(path.toString())) await openPopup("twitter");
        else if(choiceInsta.test(path.toString())) await openPopup("insta");
        else if(choiceFacebook.test(path.toString())) await openPopup("fb");
        else if(choiceSnap.test(path.toString())) await openPopup("snap");
    }else{
        await displayTextSup("1_1", opt[3][1]);
    }

    years.shift();
    console.log(years);
}

async function year2032(opt) {
    await displayTextSup(1, opt[3][0]);
    await displayChoice(1, opt[1]);
    if(path.slice(-1)[0] === 2) goodJob = true;
    await displayTextSup(2, opt[3][1]);
    await displayChoice(2, opt[2]);

    years.shift();
    console.log(years);
}

async function year2035(opt) {
    let choice = /^(\d+,\d+)*0$/;
    if (choice.test(path.toString())) {
        await displayTextSup(1, opt[3][0]);
    }else{
        await displayTextSup(2, opt[3][1]);
    }
    await displayTextSup(3, opt[3][2]);
    text.style.bottom = '29%';
    await displayChoice(3, opt[2]);
    text.style.bottom = '25%';
    await displayChoice(4, opt[1]);

    years.shift();
    console.log(years);
}

async function year2039(opt){
    await displayTextSup(1, opt[2][0]);
    await displayChoice(1, opt[1]);
    if(path.slice(-1)[0] === 1) isMaried = true;
    await displayTextSup(1, opt[2][1]);
    let choice = /^(\d+,\d+){2}1$/;
    if(choice.test(path.toString())){
        await displayTextSup(2, opt[2][2]);
    }else await displayTextSup(2, opt[2][3]);
    choice = /^\d+,\d+,2.*$/;
    if(choice.test(path.toString())){
        await displayTextSup(4, opt[2][4]);
    }

    years.shift();
    console.log(years);
}

async function year2043(opt){
    if (isMaried) {
        await displayTextSup(1, opt[2][0]);
        if (goodJob) await displayTextSup(1, opt[2][1]);
        else await displayTextSup(1, opt[2][2]);
    }
    let choice = /^(\d+,\d+){2}1$/;
    if(choice.test(path.toString())) await displayTextSup(2, opt[2][3]);
    choice = /^\d+,\d+,2.*$/;
    if(choice.test(path.toString())) await displayTextSup(3, opt[2][4]); //manque une condition
    if(isMaried) {
        if (choice.test(path.toString())) await displayTextSup(4, opt[2][5]);
        else await displayTextSup(4, opt[2][6]);
        if (goodJob) {
            await displayTextSup(5, opt[2][7]);
            hasChildren = true;
        }
        else await displayTextSup(6, opt[2][8]);
    }

    years.shift();
    console.log(years);
}

async function year2050(opt){
    if(hasChildren) {
        await displayTextSup(1, opt[7][1]);
        await displayChoice(2, opt[2]);
        if(path.slice(-1)[0] === 1) newJob = true;
    }
    else {
        await displayTextSup(3, opt[7][0]);
        await displayChoice(2, opt[1]);
        if(path.slice(-1)[0] === 1) newJob = true;
    }
    if(newJob){
        await displayTextSup(4, opt[7][2]);
        await displayChoice(4, opt[3]);
        if(path.slice(-1)[0] === 1) chipped = true;
    } else {
        await displayTextSup(5, opt[7][3]);
        await displayChoice(5, opt[4]);
        if(path.slice(-1)[0] === 1) {
            await displayTextSup(6, opt[7][4]);
            await displayChoice(7, opt[5]);
        } else {
            await displayTextSup(6, opt[7][5]);
            await displayChoice(7, opt[6]);
        }
    }

    years.shift();
    console.log(years);
}

async function year2056(opt){
    if (chipped){
        await displayTextSup(1, opt[3][0]);
        await displayChoice(1, opt[1]);
    } else {
        await displayTextSup(1, opt[3][1]);
        await displayChoice(1, opt[2]);
    }

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
        //console.log(opt);
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