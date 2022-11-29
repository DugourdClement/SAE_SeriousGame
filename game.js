const bouttonPlay = document.getElementById('playButton')
const windowJ = document.getElementById('fenetre')
const allButtons = document.getElementsByClassName('button');
const path = [];
const year = [2022, 2032];

bouttonPlay.addEventListener('click', openWindow)

function openWindow(){
    windowJ.style.visibility = 'visible';
    game();
}

function setButtonVisibility(){
    document.getElementById('3').style.visibility = 'hidden';
    document.getElementById('4').style.visibility = 'hidden';
}

function setTextButton(options, nbButton = 0) {
    let buttons = allButtons;
    if(nbButton != 0) {
        let twoButtons = [];
        twoButtons.push(document.getElementById('1'));
        twoButtons.push(document.getElementById('2'));
        setButtonVisibility();
        buttons = twoButtons;
    }
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].innerHTML = options[i];
    }
}

function addEventL(){
    for (let i = 0; i < allButtons.length; i++) {
        allButtons[i].addEventListener("click", () => next(allButtons[i].getAttribute('id')));
    }
}

function y2022(opt){
    year.shift();
    windowJ.style.backgroundImage = "url('./Picture/cellule.jpg')";
    setTextButton([opt[1], opt[2], opt[3], opt[4]]);
}

function y2032(opt) {
    year.shift();
    windowJ.style.backgroundImage = "url('./Picture/auberge.jpg')";
    setTextButton([opt[1], opt[2], opt[3], opt[4]]);
}

function y2035(btn) {
    year.shift();
    windowJ.style.backgroundImage = "url('./Picture/auberge.jpg')";
    setTextButton([opt[1], opt[2], opt[3], opt[4]]);
}

function y2039(btn) {
    year.shift();
    windowJ.style.backgroundImage = "url('./Picture/auberge.jpg')";
    setTextButton([opt[1], opt[2], opt[3], opt[4]]);
}

function y2043(btn) {
    year.shift();
    windowJ.style.backgroundImage = "url('./Picture/auberge.jpg')";
    setTextButton([opt[1], opt[2], opt[3], opt[4]]);
}

function next(btn){
    path.push(parseInt(btn));
    switch (year[0]) {
        case 2032 :
            y2032(opt);
            break;
        case 2035 :
            y2035(opt);
            break;
        case 2039 :
            y2039(opt);
            break;
        case 2043 :
            y2043(opt);
            break;
    }
}


/* Intéréssenant si possible de récupérer depuis la bd direcement dans la class
class year{
    constructor(text, options) {
        this._text = text;
        this._options = options;
    }
    get options(){
        return this._options;
    }
    get text(){
        return this._text;
    }
}
*/



async function getData() {
    let response = await fetch('connectionBd.php');

    if (response.ok) {
        let json = await response.json();
        console.log(json);
        const array = [];
        for (let i = 0; i < 7; ++i) {
            const chunk = [];
            for (let j = 0; j < 2; ++j) {
                chunk.push(json[0]);
                json.shift();
            }
            array.push(chunk);
        }
        console.log(array);
        y2022(array[0]);

    } else {
        console.log("HTTP-Error: " + response.status);
    }
}

function game(){
    getData();
    addEventL();
    //y2022();
}




/*Fonctionne pas*/
document.getElementById("2032ressources").onclick = function() {
    window.open("https://www.lemonde.fr/pixels/article/2020/12/10/la-cnil-inflige-des-amendes-a-google-et-amazon-pour-non-respect-de-la-legislation-sur-les-cookies_6062860_4408996.html");
    window.open("https://www.lemonde.fr/pixels/article/2022/01/06/la-cnil-inflige-de-lourdes-amendes-a-google-et-facebook-pour-leurs-cookies_6108384_4408996.html");
    window.open("https://www.economie.gouv.fr/entreprises/obligations-donnees-personnelles-rgpd ");
}

document.getElementById("2042ressources").onclick = function() {
    window.open("https://observatoire-ia.ulaval.ca/petit-guide-sur-la-reconnaissance-faciale/");
    window.open("https://www.amnesty.fr/liberte-d-expression/petitions/non-a-la-reconnaissance-faciale");
}