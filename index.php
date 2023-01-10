<?php
header('Content-Type: text/html');
?>

<!doctype html>
  <html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <title>CDCL- Jeu Interactif</title>
    <link rel="icon" type="image/png" sizes="16x16" href="Picture/site/icone.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="styleSheet.css">
    <link rel="stylesheet" href="responsive.css">
    <script defer src="game.js"></script>
    <script defer src="web.js"></script>
  </head>
  <body>

  <?php require("nav.php");?>

  <div class="home" id="home">
      <a href="#" id="playButton" class="play">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        PLAY
      </a>
    </div>


    <div id="fenetre" class="fenetre">
      <p id="text" class="text"></p>
      <div class="buttonRow">
        <div class="buttonCol">
          <button id="1" class="button"></button>
          <button id="3" class="button"></button>
        </div>
        <div class="buttonCol">
          <button id="2" class="button"></button>
          <button id="4" class="button"></button>
        </div>
        <button id="5" class="next">Suivant</button>
      </div>
    </div>

   <div>
      <p  id="ressource" style="font-size: 500%; color:white;" class="myP" >Ressources</p>
      <p class="myP" >L’éthique numérique est un sujet de plus en plus important dans le monde d’aujourd’hui, car de plus en plus de nos
        vies quotidiennes sont médiatisées par la technologie. Qu’il s’agisse des médias sociaux, des achats en ligne ou de
        la télémédecine, notre dépendance à l’égard de la technologie pour communiquer et interagir avec le monde qui nous
        entoure a augmenté de façon exponentielle ces dernières années. En raison de cette dépendance accrue à l’égard de
        la technologie, il faut tenir compte des répercussions éthiques de nos actions en ligne. <br>L’éthique numérique est
        importante parce qu’elle va au cœur de ce que signifie être un bon membre responsable de la société. Tout comme
        nous sommes censés nous comporter de manière éthique dans nos interactions hors ligne, il devrait en être de même
        pour nos actions en ligne. En tenant compte des conséquences potentielles de nos actions et en nous efforçant de
        faire ce qui est juste, nous pouvons créer un environnement en ligne plus sûr, plus inclusif et plus fiable pour tous.<br><br>
        Voici des articles en lien avec CDCL, permettant d'approfondir vos connaissances sur les sujets évoqués.

      </p>

      <h4 class="myP" style="color: white;">Conditions générales d'utilisation - 2022</h4>
      <p class="myP">Cela vous arrive-t-il de lire en entier les conditions générales d'utilisation lorsque vous telechargez
        un réseau social? Ce long pavé, écrit en tout petit et qui semble très ennuyeux. La plupart des personnes les accepte
        sans jamais les lires, cela pourrait vous portez prejudice. Si l'on prend l'exemple de Facebook, l'entreprise se donne
        les droits de modifier ses conditons de manière unilaterale (autrement dire sans vous prevenir...). Malgré que la
        Direction Générale de la Concurence ai signalé que cette clause est completement abusive, rien n'as changé.
        Considerez-vous que les clauses d'Instagram, Twitter, Youtube ou même Tinder sont redigées de façon intelligible et
        lisible ? Elles sont toutes très souvent interminable,et écrite de sorte à ce que vous cliquez sur accepter sans terminer
        complètement votre lecture. Tinder peut modifier, diffuser et distribuer vos données même après suppression de votre
        compte. Pas très rassurant non ?</p>

      <h4 class="myP" style="color: white;">Collecte de données - 2032</h4>
      <p class="myP">Peut importe qui nous sommes sur Internet, nos données sont collectées. Nom, Age, adresse, numero de
        téléphone, centre d'interets, ... Ces données sont pour la plupart soit revendues à d'autres entreprises qui
        cherche des profils comme le votre, soit en proposant de la publicité personnalisée directement sur les plateformes
        qui ont vos données : le ciblage publicitaire. Les réseaux sociaux vont lire nos conversations, nos posts. Votre
        naviguateur internet va enregistrer les sites visités et votre activité sur ces derniers (cookies). Tout ceci est
        le résultat de la gratuité des services que l'on utilise : « Si c'est gratuit, c'est que vous êtes le produit ».
        Et l'éthique dans tout ça ? Est-ce morale que nos données sont collectées pour être réutilisé à des fins commerciales?
        L'Europe a mis en place le RGPD, s'appliquant à tout organisme. Selon ce règlement, les données doivent être
        traitées de manière licite, loyale, transparente,... Très étonnement, pas toutes les entreprises le respecte,
        la CNIL à condamné récemment Google à une amende de 100 millions d'euros pour non-respect de la legislation sur les
        cookies. La CNIL "reproche aux entreprises d’avoir pisté leurs utilisateurs pour des fins publicitaires sans leur
        consentement". <a href="#" id="2032ressources" class="resstext" onclick="r2032()">Plus d'informations ici</a></p>

      <h4 class="myP" style="color: white;">Reconnaissance Faciale - 2035 </h4>
      <p class="myP">La reconnaissance faciale pourrait être prise comme un outil de surveillance de masse pour les états
        ce qui est étiquement innaceptable. Il est important de relever deux types de reconaissance faciale : celle qui a
        des fins d'authentification (comparer votre visage à une photo) et celle à des fins d'identifcation (il s'agit ici
        de comparer votre visage à des bases de données de millions de photos). C'est cette derniere qui pose problème
        puisqu'elle ne repond plus aux règles du droit internationnale en matière de surveillance qui dit qu'elle doit
        etre strictement ciblées avec des motifs justifiés et legitime. En France, la reconaissance faciale est déjà utilisé
        par exemple pour identifer des personnes dans le traitement d'antécédents judiciaires (TAJ). L'Inde a de nos jours
        aquis des logiciels de recnnaissance faciale, Hyderabad est l'une des villes les plus surveillées du monde : plus de
        la moitié de sa superficie est surveillé par des caméras. La ville est en train de construire un centre de
        commandement, démultipliant les capacités de traitement d'image des caméras de surveillance. Le problème de ces
        usages ci, c'est qu'ils sont pour la plupart fait dans la plus grande opacité. Nous ne sommes pas au courant des
        logiciels que les forces de l'ordre utilisent ni même la base de données qui leurs permettent d'identifier des
        individus. L'Etat se donnerait-il alors le droit d'identifier toute la population simplement parce qu'elle se trouve
        dans l'espace publique ? <a href="#" id="2035ressources" class="resstext" onclick="r2035()">Plus d'informations ici</a></p>

      <h4 class="myP" style="color: white;">Cookies - 2039 </h4>
      <p class="myP">Un cookie est un fichier texte qu'un site web va venir déposer sur votre ordinateur. Lorsque vous vous
        connectez à un site web, le site a besoin d'enregistrer une information sur votre ordinateur pour savoir que vous êtes
        connecté : on appelle ça l'identifiant de session. Les cookies servent également à enregistrer des préférences. Il existe
        deux types deux cookies. Les premiers qui servent au bon fonctionnement du site. Les seconds ont été ajoutés par des
        services externes, par exemple dans le cadre de ciblage publicitaire. Ces derniers sont nommés les cookies tiers. Une des
        façons très utilisée pour récupérer vos données et votre vie privée c'est en autorisant ces fameux cookies. Par exemple
        lorsque vous voyez des bannières de pub sur un site, ce sont d'autres sites internet qui vont eux aussi surveiller
        vos faits et gestes sur le site initial. Une fois que ces informations sont récupérées, elles sont vendues à des
        annonceurs publicitaires pour pouvoir faire du remarketing. Si vous pensez que la vente de vos données personnelles
        est grave, le vol de cookie l'est encore plus. Ces voleurs vont prendre possessions de vos cookies, incluant votre
        identifiant de session, et se connecter à votre place sur le site internet ciblé. Même s’il y a des dates d'expirations
        sur les cookies, les voleurs arrivent à les dérober au moment où vous allez vous connecter dessus. Le voleur pourra
        alors par exemple avoir accès a votre panier en ligne mais aussi à votre compte bancaire si jamais vous étiez connecté
        au moment où le vol de cookies a eu lieu... <a href="#" id="2039ressources" class="resstext" onclick="r2039()">Plus d'informations ici</a></p>

      <h4 class="myP" style="color: white;">Publicité ciblé</h4>
      <p class="myP">La publicité ciblée est une forme de publicité qui utilise des données sur les caractéristiques, le
        comportement et les intérêts d’une personne pour offrir des publicités personnalisées. Cela se fait souvent au
        moyen de témoins, qui sont de petites données stockées sur l’appareil d’une personne et utilisées pour suivre
        son activité en ligne.
        <br>L’objectif de la publicité ciblée est de diffuser des publicités plus pertinentes et plus
        attrayantes pour les téléspectateurs individuels, dans l’espoir d’accroître l’efficacité de la publicité. Ceci
        est réalisé en recueillant des données sur les intérêts du spectateur, les données démographiques et le comportement
        en ligne, et en utilisant cette information pour sélectionner des publicités qui sont susceptibles de les intéresser.
        <br>Bien que la publicité ciblée puisse être un moyen efficace d’atteindre des publics précis, elle soulève également
        des préoccupations au sujet de la collecte et de l’utilisation des données personnelles. La quantité croissante
        de données recueillies sur les personnes a suscité des préoccupations au sujet de la protection de la vie privée
        et de la possibilité que ces données soient utilisées de façon non transparente ou équitable.
        <br>En particulier, on s’inquiète de la capacité des entreprises à utiliser ces données pour manipuler le comportement et la prise
        de décision des gens. Cela comprend l’utilisation de "sombres modèles" dans la publicité, qui sont conçus pour exploiter les préjugés et les vulnérabilités des gens afin d’influencer leur comportement.
        <br>Il est important que les individus soient conscients des risques associés à la collecte et à l’utilisation de
        leurs données personnelles, et qu’ils prennent des mesures pour protéger leur vie privée en ligne. Il faut notamment
        être conscient des types de données qu’ils partagent, utiliser des outils et des technologies qui améliorent la
        protection des renseignements personnels et connaître les risques et les inconvénients potentiels de la publicité
        ciblée.
      </p>

      <h4 class="myP" style="color: white;">Neuralink</h4>
      <p class="myP">Vous ne le savez peut-être pas mais la société d'Elon Musk Neuralink vient de commencer à poser
        de nombreux implants cérébraux sur des personnes. En juillet 2016, Neuralink a été lancé dans le but de fabriquer
        des interfaces cerveaux-machines implantables. Depuis qu'elle a démarrer, l'entreprise a beaucoup progresser
        notamment avec la fabrication de puces à très haut débit qui connecte des machines à des humains. Neuralink
        à tester toutes ces interfaces pendant de nombreuses années sur des animaux comme des cochons ou encore des
        singes. Pour la première fois, l’entreprise voudrait placer une BCI (Brain Computer Interface) dans un cerveau
        humain dans le but augmenter vos capacités cérébrales. Cette interface pourrait être révolutionnaire. Toutefois,
        elle aurait des points positifs (soigner des patients paralysé, trouble de la paroles, Alzheimer, ...), mais
        aussi des points qui posent des problèmes d'éthiques. En effet, les implants sont annoncés comme réversible
        mais pouvons-nous vraiment prendre du recul lorsque ces test-ci ont été effectué sur des animaux ? Les
        premiers essais cliniques humains devraient avoir lieu sur des personnes paralysées à cause d'une lésion
        de la moelle épinière, Elon Musk annonce des objectifs médicaux ambitieux. Mais pouvons-nous être surs que
        ces innovations vont être utilisé à bon escient qu'il n'y a pas de volonté de manipulation des humains via
        à ces implants ? <a href="#" id="2043ressources" class="resstext" onclick="r20392()">Plus d'informations ici</a></p>

      <h4 class="myP" style="color: white;">Transhumanisme</h4>
      <p class="myP">Le transhumanisme est un mouvement qui préconise l’utilisation de la technologie pour améliorer la condition
        humaine et réaliser des améliorations radicales dans les capacités et les traits humains. Cela comprend des choses
        comme l’utilisation de l’intelligence artificielle, les interfaces cerveau-machine et l’édition de gènes pour augmenter
        nos capacités physiques et mentales. Les partisans du transhumanisme soutiennent que ces technologies nous permettront
        de surmonter bon nombre des limites de l’être humain, comme la maladie, le vieillissement et l’incapacité physique.
        Ils croient que ces technologies nous permettront de créer un avenir meilleur pour l’humanité et de réaliser une
        société post-humaine dans laquelle les humains sont en mesure de transcender leur forme biologique actuelle.Il y a
        de nombreux avantages potentiels au transhumanisme, mais on s’inquiète aussi des risques et des inconvénients
        potentiels. Certains craignent que la poursuite de ces technologies pourrait conduire à une distribution inégale
        de leurs avantages, avec seulement les riches étant en mesure de se permettre de s’améliorer. D’autres s’inquiètent
        des conséquences éthiques de l’utilisation de ces technologies pour modifier fondamentalement ce que signifie être
        humain.</p>

      <p id="cartes" style="font-size: 32px; color:white;" class="myP">Contacts</p>
    </div>

    <div class="containerCard">
      <div class="card card0">
        <h2>Djerian Noemie</h2>
        <div class="icons">
          <a href="https://fr.linkedin.com/in/no%C3%A9mie-djerian-916211230"><img alt="Logo Linkedin" src="Picture/site/linkedinlogo.png" width="50%"> </a>
        </div>
      </div>
      <div class="card card1">
        <h2>Dugourd Clement</h2>
        <div class="icons">
          <a width="50%" height="20%" href="https://fr.linkedin.com/in/cl%C3%A9ment-dugourd-157374223"><img alt="Logo Linkedin" src="Picture/site/linkedinlogo.png" width="50%"></a>
        </div>
      </div>
      <div class="card card2">
        <h2>Gil Killian</h2>
        <div class="icons">
          <a width="50%" height="20%" href="https://fr.linkedin.com/in/killian-gil-169b45183"><img alt="Logo Linkedin" src="Picture/site/linkedinlogo.png" width="50%"></a>
        </div>
      </div>
      <div class="card card3">
        <h2>Routier Fabien</h2>
        <div class="icons">
          <a width="50%" height="20%" href="https://fr.linkedin.com/in/fabien-routier-230312251"><img alt="Logo Linkedin" src="Picture/site/linkedinlogo.png" width="50%"></a>
        </div>
      </div>
      <div class="card card4">
        <h2>Mekerke Enzo</h2>
        <div class="icons">
          <a href="https://fr.linkedin.com/in/enzo-mekerke-320264233"><img alt="Logo Linkedin" src="Picture/site/linkedinlogo.png" width="50%"></a>
        </div>
      </div>
    </div>

  </body>
  <footer>
    <div class="row copyright">
      <p>Copyright &copy; 2023 CDCL developpers</p>
    </div>
  </footer>
</html>