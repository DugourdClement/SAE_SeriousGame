const chat = {
    1: {
         text: 'Bonjour, et bienvenue sur notre chatbot, je vais vous poser différentes questions et vous pourrez me répondre',
        options: [
            {
                text: 'démarrer',
                next: 11
            },
        ]
    },

    11: {
        text: 'Avez-vous aimer notre petit jeu ?',
    options: [
        {
            text:'oui',
            next: 12
        },

        {
            text:'non',
            next: 20
        },


        {
            text:'Je n\'ai pas encore essayé',
            next: 10
        }
    ]
    },

    12: {
        text: 'Ah super, je suis content que vous ayez aimé',
        next: 13
    },

    13: {
        text: 'souhaitez-vous des livres afin d\'en apprendre plus sur le transhumanisme ?',
        
        options: [
            {
            text:'Oui',
            next: 14
            },

            {
                text:'Non',
                next: 21
            },
        ]
    },

    14: {
        text: 'Je peux vous conseiller "Le Transhumanisme" de Franck Damour, "La révolution transhumaniste" de Luc Ferry',
        next: 22
    },

    10: {
        text: 'C\'est dommage, je vous recommande vivement de l\'essayer',
        next: 13
    },

    20: {
        text: 'Quel dommage ! ',
        next: 13
    },

    21: {
        text: 'Alors, peut-être souhaitez-vous un livre sur l\'importance de la protection des données personnelles ?',

        options: [
            {
                text:'Oui',
                next: 23
            },

            {
                text:'Non',
            
            },
        ]
    },

    22: {
        text: 'Souhaitez-vous un livre sur l\'importance de la protection des données personnelles ?',

        options: [
            {
                text:'Oui',
                next: 23
            },

            {
                text:'Non',
                next: 24
            },
        ]
    },

    23: {
        text:'Je peux vous conseiller "La protection des données personnelles en 100 questions/réponses" de Laurane Raimondo',
        next: 24
    },

    24: {
        text:'J\'en ai fini avec mes questions, Au revoir !',
    },
};
