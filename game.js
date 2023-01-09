const buttonPlay = document.getElementById('playButton')
const windowJ = document.getElementById('fenetre')
const allButtons = document.getElementsByClassName('button');
const nextButton = document.getElementById('5');
const home = document.getElementById('home');
const text = document.getElementById('text');
const path = [];
const years = ['2022', '2032', '2035', '2039', '2043', '2050', '2056', '2068'];
var opt = [];

buttonPlay.addEventListener('click', openWindow);

function createClickPromiseAnswer(){
    return new Promise((resolve, reject) => {
        allButtons[0].addEventListener("click", () => {
            path.push(parseInt(allButtons[0].getAttribute('id')));
            resolve();
        });
        allButtons[1].addEventListener("click", () => {
            path.push(parseInt(allButtons[1].getAttribute('id')));
            resolve();
        });
        allButtons[2].addEventListener("click", () => {
            path.push(parseInt(allButtons[2].getAttribute('id')));
            resolve();
        });
        allButtons[3].addEventListener("click", () => {
            path.push(parseInt(allButtons[3].getAttribute('id')));
            resolve();
        });
    })
}

function createClickPromiseNext(){
    return new Promise((resolve, reject) => {
        nextButton.addEventListener("click", () => {
            nextButton.style.visibility = 'visible';
            resolve();
        });
    });
}

async function openWindow() {
    let status = await getData();
    if (status === true) {
        game();
    }
}


function setButtonVisibility(value, nb){
    let vis;
    if(value === false) vis = 'hidden';
    else vis = 'visible';
    document.getElementById('3').style.visibility = vis;
    document.getElementById('4').style.visibility = vis;
    text.style.visibility = vis;
    if (nb === 4) {
        document.getElementById('1').style.visibility = vis;
        document.getElementById('2').style.visibility = vis;
    }
}

function setTextButton(options) {
    setButtonVisibility(true, 4)
    let buttons = allButtons;
    if(options.length !== 4) {
        let twoButtons = []; // a aranger
        twoButtons.push(document.getElementById('1'));
        twoButtons.push(document.getElementById('2'));
        buttons = twoButtons;
    }
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].innerHTML = options[i];
    }
}

async function displayChoice(choiceNumber, opt) {
    setButtonVisibility(true, 4);
    windowJ.style.backgroundImage = "url('./Picture/visuels-jeu/" + years[0] + "/choix_" + years[0] + "_" + choiceNumber + ".jpg')";
    text.innerText = opt[0];
    setTextButton(opt[1]);
    let clickPromise = createClickPromiseAnswer();
    await clickPromise;
}

async function displayTextSup(textNumber, opt) {
    setButtonVisibility(false, 4);
    text.style.visibility = 'visible';
    windowJ.style.backgroundImage = "url('./Picture/visuels-jeu/" + years[0] + "/choix_" + years[0] + "_" + textNumber + ".jpg')";
    text.innerText = opt[0];
    let clickPromise = createClickPromiseNext();
    await clickPromise;
    nextButton.style.visibility = 'hidden';
}

async function consequence(opt) {
    let firstYear = /^1\d*$/;
    if (firstYear.test(path.toString())) {
        await displayChoice("1_1", opt[2]);
    }else{
        await displayTextSup("1_1", opt[4]);
    }

}

async function year(opt) {
    console.log(opt);
    await displayTextSup(1, opt[3]);
    await displayChoice(1, opt[1]);
    await consequence(opt);
    years.shift();
    console.log(years);
}

function context(){
    setButtonVisibility(false, 4);
    windowJ.style.backgroundImage = "url('./Picture/années/" + years[0] + ".png')";
    setTimeout(function(){
        nextButton.style.visibility = 'visible';
        windowJ.style.backgroundImage = "url('./Picture/journal/journal" + years[0] + ".png')";
        return true;
    }, 2000);
}

function next(btn){ //utilité ?
    path.push(parseInt(btn));
    //opt.shift();
    switch (years[0]) {
        case '2032' :
            year(opt[0]);
            break;
        case '2035' :
            year(opt[0]);
            break;
        case '2039' :
            year(opt[0]);
            break;
        case '2043' :
            year(opt[0]);
            break;
        case '2050' :
            year(opt[0]);
            break;
        case '2056' :
            year(opt[0]);
            break;
        case '2068' :
            year(opt[0]);
            break;
    }
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
    let clickPromise = createClickPromiseNext();
    await clickPromise;

    year(opt[1]);
}

function game(){
    windowJ.style.visibility = 'visible';
    console.log(opt);
    context();
    start();
}