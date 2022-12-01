const bouttonPlay = document.getElementById('playButton')
const windowJ = document.getElementById('fenetre')
const allButtons = document.getElementsByClassName('button');
const nextButton = document.getElementById('5');
const text = document.getElementById('text');
const path = [];
const years = ['2022', '2032'];

bouttonPlay.addEventListener('click', openWindow)

function addEventL(){
    for (let i = 0; i < allButtons.length; i++) {
        allButtons[i].addEventListener("click", () => next(allButtons[i].getAttribute('id')));
    }
    nextButton.addEventListener("click", function() {
        nextButton.style.visibility = 'hidden';
        windowJ.style.backgroundImage = "url('./Picture/back" + years[0] + ".png')";
        setButtonVisibility(true, 4);
        years.shift();
    });
}

function openWindow(){
    windowJ.style.visibility = 'visible';
    game();
}

function setButtonVisibility(value, nb){
    let vis;
    if(value === false) vis = 'hidden';
    else vis = 'visible';

    document.getElementById('3').style.visibility = vis;
    document.getElementById('4').style.visibility = vis;
    if (nb !== 0) {
        document.getElementById('1').style.visibility = vis;
        document.getElementById('2').style.visibility = vis;
    }
}

function setTextButton(options, nbButton = 0) {
    let buttons = allButtons;
    if(nbButton !== 0) {
        let twoButtons = [];
        twoButtons.push(document.getElementById('1'));
        twoButtons.push(document.getElementById('2'));
        setButtonVisibility(false);
        buttons = twoButtons;
    }
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].innerHTML = options[i];
    }
}

function year(opt, picture){
    //opt = opt.then(value =>console.log(value));
    context(picture, years[0])
    setTextButton([opt[2], opt[3], opt[4], opt[5]]);
    text.innerText = opt[1];
}

function context(picture, year){
    setButtonVisibility(false, 4);
    windowJ.style.backgroundImage = "url('./Picture/" + year + ".png')";
    setTimeout(function(){
        nextButton.style.visibility = 'visible';
        windowJ.style.backgroundImage = picture;
        return true;
    }, 2000);
}

function next(btn){
    path.push(parseInt(btn));
    switch (years[0]) {
        case '2032' :
            year(opt);
            break;
        case '2035' :
            year(opt);
            break;
        case '2039' :
            year(opt);
            break;
        case '2043' :
            year(opt);
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
            for (let j = 0; j < 6; ++j) {
                chunk.push(json[0]);
                json.shift();
            }
            array.push(chunk);
        }
        console.log(array);
        year(array[0], "url('./Picture/journal2022r.png')");
        return array;
    } else {
        console.log("HTTP-Error: " + response.status);
    }
}

function game(){
    addEventL();
    getData();
    //year(opt[0], "url('./Picture/journal2022r.png')");
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