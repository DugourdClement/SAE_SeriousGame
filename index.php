<?php

// charge et initialise les bibliothèques globales
include_once 'data/DataAccess.php';
include_once 'data/SPDO.php';
include_once 'control/Controllers.php';
include_once 'control/Presenter.php';
include_once 'service/ModificationForm.php';
include_once 'gui/ViewAccueil.php';
include_once 'gui/ViewModification.php';
include_once 'gui/ViewLogin.php';
include_once 'gui/ViewChatbot.php';

// faut faire la navbar

$data = null;
try {
    // construction du modèle
    $data = new DataAccess( SPDO::getInstance() );

} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}

// initialisation du controller
$controller = new Controllers();

// intialisation du cas d'utilisation AnnoncesChecking
$modificationForm = new ModificationForm() ;

// intialisation du presenter avec accès aux données de ModificationForm
$presenter = new Presenter($modificationForm);

// chemin de l'URL demandée au navigateur
// (p.ex. /annonces/index.php)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// route la requête en interne
// i.e. lance le bon contrôleur en focntion de la requête effectuée
if ('/sae/' == $uri || '/sae/index.php' == $uri) {

    $layout = new Layout("gui/layout.html" );
    $vueAccueil = new ViewAccueil( $layout );

    $vueAccueil->display();
}
elseif ( '/sae/index.php/connection' == $uri ){

    $layout = new Layout("gui/layout.html" );
    $vueLogin = new ViewLogin( $layout );

    $vueLogin->display();
}
elseif ( '/sae/index.php/modification' == $uri  && isset($_POST['login']) && isset($_POST['password']) ) {

    $controller->modificationAction($_POST['login'], $_POST['password'], $data, $modificationForm);

    $layout = new Layout("gui/layout.html" );
    $vueLogin= new ViewLogin( $layout);

    $vueLogin->display();
}
elseif ( '/sae/index.php/chatbot' == $uri ) {

    $layout = new Layout("gui/layout.html" );
    $vueChatBot= new ViewChatbot( $layout );

    $vueChatBot->display();
}
else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>My Page NotFound</h1></body></html>';
}