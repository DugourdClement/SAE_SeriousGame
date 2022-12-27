/*const editableElement1 = document.getElementById("text-1");
const text1 = editableElement1.innerHTML;
const editableElement2 = document.getElementById("text-2");
const text2 = editableElement2.innerHTML;
const editableElement3 = document.getElementById("text-3");
const text3 = editableElement3.innerHTML;*/

function menu() {
    let menu = document.getElementById("menu");
    menu.addEventListener("change", function() {
        let selectedOption = this.value;

        if(selectedOption === "base"){
            hideAllOption();
        }
        else if (selectedOption === "option1") {
            hideAllOption();
            document.getElementById("form1").style.display = "block";
        } else if (selectedOption === "option2") {
            hideAllOption();
            document.getElementById("form2").style.display = "block";
        } else if (selectedOption === "option3") {
            hideAllOption();
            document.getElementById("form3").style.display = "block";
        }
    });
}

function hideAllOption(){
    document.getElementById("form1").style.display = "none";
    document.getElementById("form2").style.display = "none";
    document.getElementById("form3").style.display = "none";
}

function addEventListenerForm(idForm){ //idForm est un entier dnas l'idéal
    let form = document.getElementById(idForm); //faire distinction entre text et opt
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        let formData = new FormData(this);
        formData.append('text', window['text' + idForm]);
        formData.append('id', idForm) //faire distinction entre text et opt
        this.submit();
    });
}



menu();