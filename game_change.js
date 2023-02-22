/**
 * fonction qui permet de changer le texte d'une question
 * @returns {string}
 */
function menu() {
    addEventListenerForm();
    let menu = document.getElementById("menu");
    menu.addEventListener("change", function() {
        hideAllOption();

        let selectedOption = this.value;
        switch (selectedOption) {
            case "option1" :
                document.getElementById("form1").style.display = "block";
                break;
            case "option2" :
                document.getElementById("form2").style.display = "block";
                break;
            case "option3" :
                document.getElementById("form3").style.display = "block";
                break;
            case "option4" :
                document.getElementById("form4").style.display = "block";
                break;
            case "option5" :
                document.getElementById("form5").style.display = "block";
                break;
            case "option6" :
                document.getElementById("form6").style.display = "block";
                break;
            case "option7" :
                document.getElementById("form7").style.display = "block";
                break;
        }
    });
}

/**
 * fonction qui permet de cacher toutes les options
 */
function hideAllOption(){
    const allForm = document.getElementsByClassName("form");
    for (let i = 0; i < allForm.length; i++) {
        allForm[i].style.display = "none";
    }
}

function bannerShow(){
    let banner = document.getElementById('banner');
    banner = $(banner);
    banner.css('visibility', 'visible');
    banner.css('opacity', '1');

    setTimeout(function() {
        banner.fadeTo(1000, 0, function() {
            banner.css('visibility', 'hidden');
        });
    }, 3000);
}

/**
 * Cette fonction ajoute un gestionnaire d'événements personnalisé pour chaque bouton d'envoi de formulaire.
 * Le gestionnaire d'événements envoie une requête POST pour enregistrer les données du formulaire.
 * Les données sont stockées dans un objet FormData et envoyées à la page game_change.php.
 *
 * @return void
 */
function addEventListenerForm(){
    function addCustomEventListener(idForm) {
        console.log(idForm);
        document.getElementById('btnSubmit_' + idForm).addEventListener('click', function (event) {
            event.preventDefault();

            const formData = new FormData();
            formData.append('text', JSON.stringify(window['text_' + idForm].innerHTML));
            if(/^\d+0\d$/.test(idForm)){ //If multi text
                formData.append('idText', idForm.slice(0, -2));
                formData.append('idTextSup', idForm);
            }else if(idForm.length === 3){ //If option
                formData.append('idText', idForm.slice(0, -1));
                formData.append('idOpt', idForm);
            } else formData.append('idText', idForm);

            for (const value of formData.values()) {
                console.log(value);
            }
            for (const key of formData.keys()) {
                console.log(key);
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'game_change.php');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    window['text_' + idForm].innerHTML = formData.get('text');
                }
            };
            xhr.send(formData);
            bannerShow();
        });
    }

    let allButtons = document.getElementsByClassName("form");
    for (let i = 1; i < allButtons.length + 1; i++) {
        document.querySelectorAll(`button[id^='btnSubmit_${i}']`).forEach(button => {
            if (new RegExp(`${i}[1-9][1-5]$`).test(button.id)) { //For each answer
                addCustomEventListener(button.id.slice(-3));
            }
            else if (new RegExp(`${i}[1-9]$`).test(button.id)) { //For each question
                addCustomEventListener(button.id.slice(-2));
            }
        });
        document.querySelectorAll(`button[id^='btnSubmit_${i}0']`).forEach(button => { //For each context text
            if (new RegExp(`${i}0[1-9]$`).test(button.id)) {
                addCustomEventListener(button.id.slice(-3));
            }
        });
    }
}

menu();