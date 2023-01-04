function menu() {
    let menu = document.getElementById("menu");
    menu.addEventListener("change", function() {
        hideAllOption();

        let selectedOption = this.value;
        switch (selectedOption) {
            case "option1" :
                addEventListenerForm(1);
                document.getElementById("form1").style.display = "block";
                break;
            case "option2" :
                addEventListenerForm(2);
                document.getElementById("form2").style.display = "block";
                break;
            case "option3" :
                addEventListenerForm(3);
                document.getElementById("form3").style.display = "block";
                break;
            case "option4" :
                addEventListenerForm(4);
                document.getElementById("form4").style.display = "block";
                break;
            case "option5" :
                addEventListenerForm(5);
                document.getElementById("form5").style.display = "block";
                break;
            case "option6" :
                addEventListenerForm(6);
                document.getElementById("form6").style.display = "block";
                break;
            case "option7" :
                addEventListenerForm(7);
                document.getElementById("form7").style.display = "block";
                break;
        }
    });
}

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
    banner.fadeIn();
    setTimeout(function() {
        banner.fadeTo(1000, 0, function() {
            banner.css('visibility', 'hidden');
        });
    }, 3000);
}

function addEventListenerForm(idForm){
    function addEventListener(idForm) {
        console.log(idForm);
        document.getElementById('btnSubmit_' + idForm).addEventListener('click', function (event) {
            event.preventDefault();

            const formData = new FormData();
            formData.append('text', window['text_' + idForm].innerHTML);
            if(idForm.length === 2){
                formData.append('idText', idForm.slice(0, -1));
                formData.append('idOpt', idForm);
            }
            else formData.append('idText', idForm);
            /*
            for (const value of formData.values()) {
                console.log(value);
            }
            for (const key of formData.keys()) {
                console.log(key);
            }
            */
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

    addEventListener(idForm);
    for (let i = 1; i < 5; i++) {
        addEventListener(idForm.toString() + i);
    }
}



menu();