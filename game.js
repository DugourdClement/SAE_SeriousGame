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
    let status = await getData();
    if (status === true) {
        body.style.overflow = "hidden";
        game();
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
    //removeClickPromiseAnswer();
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
            opened =  window.open("CGU/cgu" + rs +".html", "Popup", "width=800,height=700");
        }
        let choiceTwitter = /^1,1\d*$/;
        let choiceInsta = /^1,2\d*$/;
        let choiceFacebook = /^1,3\d*$/;
        let choiceSnap= /^1,4\d*$/;
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
    await displayTextSup(2, opt[3][1]);
    await displayChoice(2, opt[2]);

    years.shift();
    console.log(years);
}

async function year2035(opt) {
    let choice = /^\d{2}0\d*$/;
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

async function start() {
    await context();
    await year2022(opt[1]);
    await context();
    await year2032(opt[2]);
    await context();
    await year2035(opt[3]);
}

function game(){
    windowJ.style.visibility = 'visible';
    console.log(opt);
    start();
}