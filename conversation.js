const chat = {
    1: {
         text: 'Bonjour, et bienvenue sur notre chatbot, je vais vous poser différentes questions et vous pourrez me répondre.',
        options: [
            {
                text: 'Démarrer',
                next: 11
            },
        ]
    },

    11: {
        text: 'Avez-vous aimé notre petit jeu ?',
    options: [
        {
            text:'Oui',
            next: 12
        },

        {
            text:'Non',
            next: 20
        },


        {
            text:'Je n\'ai pas encore essayé',
            next: 10
        }
    ]
    },

    12: {
        text: 'Ah super, je suis content que vous ayez aimé !',
        next: 25
    },

    25: {
        text: 'Y\'a t-il un sujet ci-dessous qui vous intéresse ?',
    options: [
        {
            text:'Les Conditions générales d\'utilisation',
            next: 26
        },
        {
            text:'La Collecte de données',
            next: 27
        },
        {
            text:'La Reconnaissance Faciale',
            next: 28
        },
        {
            text: 'Les Cookies',
            next: 29
        },
        {
            text:'La Publicité ciblé',
            next: 30
        },
        {
            text:'Le Neuralink',
            next: 31
        },
        {
            text:'Le Transhumanisme',
            next: 32
        }
    ]
    },

    26: {
        text:'Cela vous arrive-t-il de lire en entier les conditions générales d\'utilisation lorsque vous telechargez un réseau social?' +
            ' Ce long pavé, écrit en tout petit et qui semble très ennuyeux. Bien que la ' +
            'Direction Générale de la Concurrence ai signalé que cette clause est completement abusive, rien n\'as changé.' +
            'Tinder peut modifier, diffuser et distribuer vos données même après suppression de votre compte.',
        next: 25
    },

    27: {
        text:'Peut importe qui nous sommes sur Internet, nos données sont collectées. Nom, Age, adresse, numero de téléphone, centre d\'interets,' +
            '... Ces données sont pour la plupart soit revendues à d\'autres entreprises qui cherche des profils comme le votre, soit en proposant de ' +
            'la publicité personnalisée directement sur les plateformes qui ont vos données : le ciblage publicitaire.' +

            ' L\'Europe a mis en place le RGPD, ' +
            's\'appliquant à tout organisme. Selon ce règlement, les données doivent être traitées de manière licite, loyale, transparente,...',
        next: 34
    },

    28: {
        text:'La reconnaissance faciale pourrait être prise comme un outil de surveillance de masse pour les états ce qui est étiquement innaceptable. ' +
            'C\'est cette derniàre qui pose problème puisqu\'elle ne repond plus aux règles du droit internationnale en matière de surveillance qui dit ' +
            'qu\'elle doit etre strictement ciblée avec des motifs justifiés et legitime. En France, la reconaissance faciale est déjà utilisé par exemple' +
            ' pour identifer des personnes dans le traitement d\'antécédents judiciaires. La ville est en train de construire un centre de commandement, ' +
            'démultipliant les capacités de traitement d\'image des caméras de surveillance.',
        next: 35
    },

    29: {
        text:'Un cookie est un fichier texte qu\'un site web va venir déposer sur votre ordinateur. Lorsque vous vous connectez à un site web, le site a' +
            ' besoin d\'enregistrer une information sur votre ordinateur pour savoir que vous êtes connecté : on appelle ça l\'identifiant de session. ' +
            'Les seconds ont été ajoutés par des services externes, par exemple dans le cadre de ciblage publicitaire. Ces derniers sont nommés les cookies tiers.' +
            ' Une des façons très utilisée pour récupérer vos données et votre vie privée c\'est en autorisant ces fameux cookies. Si vous pensez que la vente de vos' +
            'données personnelles est grave, le vol de cookie l\'est encore plus. Ces voleurs vont prendre possession de vos cookies, incluant votre identifiant de ' +
            'session, et se connecter à votre place sur le site internet ciblé.',
        next: 36
    },
    30: {
        text:'La publicité ciblée est une forme de publicité qui utilise des données sur les caractéristiques, le comportement et les intérêts d’une' +
            ' personne pour offrir des publicités personnalisées. L’objectif de la publicité ciblée est de diffuser des publicités plus pertinentes ' +
            'et plus attrayantes pour les téléspectateurs individuels, dans l’espoir d’accroître l’efficacité de la publicité. Bien que la publicité ' +
            'ciblée puisse être un moyen efficace d’atteindre des publics précis, elle soulève également des préoccupations au sujet de la collecte ' +
            'et de l’utilisation des données personnelles. Il faut notamment être conscient des types de données qu’ils partagent, utiliser des outils ' +
            'et des technologies qui améliorent la protection des renseignements personnels et connaître les risques et les inconvénients potentiels de' +
            ' la publicité ciblée.',
        next: 25
    },

    31: {
        text:'Vous ne le savez peut-être pas mais la société d\'Elon Musk Neuralink vient de commencer à poser de nombreux implants cérébraux sur des ' +
            'personnes. Depuis qu\'elle a démarrer, l\'entreprise a beaucoup progresser notamment avec la fabrication de puces à très haut débit qui ' +
            'connecte des machines à des humains. Les premiers essais cliniques humains devraient avoir lieu sur des personnes paralysées à cause d\'une' +
            ' lésion de la moelle épinière, Elon Musk annonce des objectifs médicaux ambitieux. Mais pouvons-nous être surs que ces innovations vont être' +
            ' utilisé à bon escient qu\'il n\'y a pas de volonté de manipulation des humains via à ces implants ?.',
        next: 39
    },

    32: {
        text:'Le transhumanisme est un mouvement qui préconise l’utilisation de la technologie pour améliorer la condition humaine et réaliser des' +
            ' améliorations radicales dans les capacités et les traits humains. Les partisans du transhumanisme soutiennent que ces technologies nous ' +
            'permettront de surmonter bon nombre des limites de l’être humain, comme la maladie, le vieillissement et l’incapacité physique.' +
            'Certains craignent que la poursuite de ces technologies pourrait conduire à une distribution inégale de leurs avantages, avec seulement les' +
            'riches étant en mesure de se permettre de s’améliorer.',
        next: 13
    },

    13: {
        text: 'Souhaitez-vous que je vous conseille un livre afin d\'en apprendre plus sur le transhumanisme ?',
        
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
        text: 'Je peux vous conseiller "Le Transhumanisme" de Franck Damour, et "La révolution transhumaniste" de Luc Ferry',
        next: 25
    },

    10: {
        text: 'C\'est dommage, je vous recommande vivement de l\'essayer',
        next: 25
    },

    20: {
        text: 'Quel dommage, j\'espère que cela vous a quand même permis d\'apprendre certaines choses ',
        next: 25
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
                next: 25
            },
        ]
    },

    23: {
        text:'Je peux vous conseiller "La protection des données personnelles en 100 questions/réponses" de Laurane Raimondo',
        next: 25
    },

    24: {
        text:'J\'en ai fini avec mes questions, Au revoir !',
    },

    39: {
        text:'Souhaitez-vous en apprendre plus sur le Neuralink ?',

        options: [
            {
                text: 'Oui',
                next: 40
            },
            {
                text: 'Non',
                next: 41
            }
        ]
    },

    40: {
        text:'Je vous conseille alors d\'aller visiter ce site internet ' +
            ': https://medium.com/ai-for-tomorrow/neuralink-il-est-urgent-de-parler-de-science-et-d%C3%A9thique-63e56f4fb41d',
        next: 25
    },

    41: {
        text:'Très bien.',
        next: 25
    },

    34: {
        text: 'Souhaitez-vous que je vous conseille un livre afin d\'en apprendre plus sur le transhumanisme ?',

        options: [
            {
                text:'Oui',
                next: 14
            },

            {
                text:'Non',
                next: 41
            },
        ]
    },

    35: {
        text:'Souhaitez-vous en apprendre plus sur la Reconnaissance Faciale ?',

        options: [
            {
                text: 'Oui',
                next: 43
            },
            {
                text: 'Non',
                next: 41
            }
        ]
    },

    43: {
        text:'Je vous conseille alors d\'aller visiter ce site internet ' +
            ': https://www.lemonde.fr/pixels/article/2020/12/10/la-cnil-inflige-des-amendes-a-google-et-amazon-pour-non-respect-de-la-legislation-sur-les-cookies_6062860_4408996.html',
        next: 25
    },

    36: {
        text:'Souhaitez-vous en apprendre plus sur les Cookies ?',

        options: [
            {
                text: 'Oui',
                next: 44
            },
            {
                text: 'Non',
                next: 41
            }
        ]
    },

    44: {
        text:'Je vous conseille alors d\'aller visiter ce site internet ' +
            ': https://www.journaldunet.com/ebusiness/crm-marketing/1134055-quels-sont-les-dangers-des-cookies/',
        next: 25
    },





};
