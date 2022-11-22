const textElement = document.getElementById('text')
const optionButtonsElement = document.getElementById('option-buttons')
const modalContainer = document.querySelector(".modal-container");
const modalTriggers = document.querySelectorAll(".modal-trigger");

modalTriggers.forEach(trigger => trigger.addEventListener("click", toggleModal))


function toggleModal(){
    modalContainer.classList.toggle("active")
}

$(function() {
    //single book
    $('#mybook').booklet();

    //multiple books with ID's
    $('#mybook1, #mybook2').booklet();

    //multiple books with a class
    $('.mycustombooks').booklet();
});

let state = {}
let btn1 = document.querySelector('#btn1');
let btn2 = document.querySelector('#btn2');
let btn3 = document.querySelector('#btn3');
let btn4 = document.querySelector('#btn4');

btn1.addEventListener('click', () => {
    document.body.style.backgroundImage = "url('cellule.jpg')"
});

btn2.addEventListener('click', () => {
    document.body.style.backgroundImage = "url('cellule.jpg')"
});

btn3.addEventListener('click', () => {
    document.body.style.backgroundImage = "url('cellule.jpg')"
});

btn4.addEventListener('click', () => {
    document.body.style.backgroundImage = "url('cellule.jpg')"
});

function hideButton(){
    document.getElementById('option-buttons').style.display= 'none';
}

function hideText(){
    document.getElementById('text').style.display= 'none';
}

function hideAll(){
    hideButton();
    hideText();
}

function showAll() {
    document.getElementById('text').style.display = 'initial';
    document.getElementById('option-buttons').style.display= 'initial';
}

// function changeBackground() {
//     if (textNodeIndex == 1) {
//         document.body.style.backgroundImage = "url('cellule.jpg')";
//     }
// }

function startGame() {
    state = {}
    showTextNode(1)
}

var element = document.getElementById("fenetre");

const vid = document.createElement('video');
vid.src = '2022.mp4';
vid.autoPlay = true;
vid.width = 1200;
vid.height = 700;


function playvid (){
    vid.play();
}

function hideBack(){
    document.getElementById("fenetre").style.backgroundColor = 'white';
}



function showTextNode(textNodeIndex) {
    const textNode = textNodes.find(textNode => textNode.id === textNodeIndex)
    textElement.innerText = textNode.text
    while (optionButtonsElement.firstChild) {
        optionButtonsElement.removeChild(optionButtonsElement.firstChild)
    }

    textNode.options.forEach(option => {
        if (showOption(option)) {
            const button = document.createElement('button')
            button.innerText = option.text
            button.classList.add('btn')
            button.addEventListener('click', () => selectOption(option))
            button.addEventListener('click', () => {
                var element = document.getElementById("fenetre");
                // if (nextText = -1) {
           //         element.style.backgroundImage = "url('cellule.jpg')"
            //        console.log('nextText -1')

           //     }
           //     if (nextText = 5) {
            //        element.style.backgroundImage = "url('cellule.jpg')"
             //       console.log('nextText 5')

              //  }
                if (textNodeIndex == 1) {
                    element.style.backgroundColor='transparent';
                    hideButton();
                    hideText();
                    element.appendChild(vid);
                    playvid();
                    vid.addEventListener('ended', function (e){
                        element.removeChild(vid);
                        element.style.backgroundImage = "url('clement.jpg')";
                        document.getElementById('option-buttons').style.display= 'initial';
                    });
                    //element.style.backgroundImage = "url('chateau_int.webp')"
                    console.log(textNodeIndex)
                }
                if (textNodeIndex == 2) {
                    hideButton();
                    element.style.backgroundImage = "url('chateau.jpg')"
                    console.log(textNodeIndex)
                }
                if (textNodeIndex == 3) {
                    hideButton();
                    element.style.backgroundImage = "url('chateau_int.webp')"
                    console.log(textNodeIndex)

                }
                if (textNodeIndex == 4) {
                    element.style.backgroundImage = "url('cellule.jpg')"
                    console.log(textNodeIndex)

                }
                if (textNodeIndex == 5) {
                    element.style.backgroundImage = "url('auberge.jpg')"
                    console.log(textNodeIndex)
                }
                // }
                // if (textNodeIndex == 6) {
                //     document.body.style.backgroundImage = "url('auberge.jpg')"
                //     console.log(textNodeIndex)

                // }
                // if (textNodeIndex == 7) {
                //     document.body.style.backgroundImage = "url('auberge.jpg')"
                //     console.log(textNodeIndex)

                // }
            })
            optionButtonsElement.appendChild(button)
        }
    })
}

function showOption(option) {
    return option.requiredState == null || option.requiredState(state)
}

function selectOption(option) {
    const nextTextNodeId = option.nextText
    if (nextTextNodeId <= 0) {
        return startGame()
    }
    state = Object.assign(state, option.setState)
    showTextNode(nextTextNodeId)
}

const textNodes = [
    {
        id: 1,
        text: 'Vous vous réveillez dans un endroit étrange et vous voyez une potion bleu près de vous..',
        options: [
            {
                text: 'Prendre la potion',
                setState: { blueGoo: true },
                nextText: 2,
            },
            {
                text: 'Laisser la potion',
                nextText: 2
            }
        ],
    },
    {
        id: 2,
        text: 'Vous vous aventurez à la recherche de réponses sur l endroit où vous vous trouvez lorsque vous rencontrez un marchand.',
        options: [
            {
                text: 'Échanger la potion contre une épée',
                requiredState: (currentState) => currentState.blueGoo,
                setState: { blueGoo: false, sword: true },
                nextText: 3
            },
            {
                text: 'Échanger la potion contre un bouclier',
                requiredState: (currentState) => currentState.blueGoo,
                setState: { blueGoo: false, shield: true },
                nextText: 3
            },
            {
                text: 'Ignorer le marchand',
                nextText: 3
            }
        ]
    },
    {
        id: 3,
        text: 'Après avoir quitté le marchand, vous commencez à vous sentir fatigué et vous tombez sur une petite ville à côté d un château qui semble dangereux.',
        options: [
            {
                text: 'Explorer le château',
                nextText: 4
            },
            {
                text: 'Trouver une chambre pour dormir dans la ville',
                nextText: 5
            },
            {
                text: 'Trouvez du foin dans une étable pour dormir.',
                nextText: 6
            }
        ]
    },
    {
        id: 4,
        text: 'Vous êtes si fatigué que vous vous endormez en explorant le château et êtes tué par un terrible monstre dans votre sommeil.',
        options: [
            {
                text: 'Restart',
                nextText: -1
            }
        ]
    },
    {
        id: 5,
        text: 'Sans argent pour acheter une chambre, vous vous introduisez dans l auberge la plus proche et vous vous endormez. Après quelques heures de sommeil, le propriétaire de l auberge vous trouve et demande au garde municipal de vous enfermer dans une cellule.',
        options: [
            {
                text: 'Restart',
                nextText: -1
            }
        ]
    },
    {
        id: 6,
        text: 'Vous vous réveillez bien reposé et plein d énergie, prêt à explorer le château voisin',
        options: [
            {
                text: 'Explorer le château',
                nextText: 7
            }
        ]
    },
    {
        id: 7,
        text: 'En explorant le château, vous rencontrez un horrible monstre sur votre chemin.',
        options: [
            {
                text: 'Courir',
                nextText: 8
            },
            {
                text: 'L attaquer avec votre épée',
                requiredState: (currentState) => currentState.sword,
                nextText: 9
            },
            {
                text: 'Se cacher derrière votre bouclier',
                requiredState: (currentState) => currentState.shield,
                nextText: 10
            },
            {
                text: 'Lui jeter la potion',
                requiredState: (currentState) => currentState.blueGoo,
                nextText: 11
            }
        ]
    },
    {
        id: 8,
        text: 'Vos tentatives de fuite sont vaines et le monstre vous attrape facilement.',
        options: [
            {
                text: 'Restart',
                nextText: -1
            }
        ]
    },
    {
        id: 9,
        text: 'Vous pensiez bêtement que ce monstre pouvait être tué avec une seule épée.',
        options: [
            {
                text: 'Restart',
                nextText: -1
            }
        ]
    },
    {
        id: 10,
        text: 'Le monstre a ri alors que vous vous cachiez derrière votre bouclier et vous a mangé.',
        options: [
            {
                text: 'Restart',
                nextText: -1
            }
        ]
    },
    {
        id: 11,
        text: 'Tu as jeté ta potion sur le monstre et il a explosé. Une fois la poussière retombée, vous avez vu que le monstre avait été détruit. Voyant votre victoire, vous décidez de revendiquer ce château et d y passer le reste de vos jours.',
        options: [
            {
                text: 'Congratulations. Play Again.',
                nextText: -1
            }
        ]
    }
]

startGame()