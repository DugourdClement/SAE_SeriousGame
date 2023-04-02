<?php

// charge et initialise les bibliothèques globales
include_once 'data/YearSqlAccess.php';
include_once 'data/UserSqlAccess.php';
include_once 'data/SPDO.php';

include_once 'control/Controllers.php';
include_once 'control/Presenter.php';

include_once 'service/YearChecking.php';
include_once 'service/OutputData.php';
include_once 'service/UserChecking.php';
include_once 'service/GameCheking.php';

include_once 'gui/ViewAccueil.php';
include_once 'gui/ViewModification.php';
include_once 'gui/ViewLogin.php';
include_once 'gui/ViewChatbot.php';
include_once 'gui/Layout.php';
include_once 'gui/ViewError.php';

$bdAdmin = null;
$bdLecture = null;
try {
    // construction du modèle
    $bdAdmin = SPDO::getInstance("serveur_admin");
    $bdLecture = SPDO::getInstance("serveur_lecture");

    $dataYears = new YearSqlAccess($bdAdmin);

    $dataYearsLecture = new YearSqlAccess($bdLecture);
    $dataUsers = new UserSqlAccess($bdLecture);

} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}

// initialisation de l'output dans une structure pour le transfert des données
$outputData = new OutputData();

// initialisation de l'output sur fichier pour le jeu
$gameCheck = new GameCheking('cache_YearsData');

// initialisation du controller
$controller = new Controllers($outputData);

// initialisation du cas d'utilisation YearChecking
$yearCheck = new YearChecking($outputData);

// initialisation du cas d'utilisation UserChecking
$userCheck = new UserChecking($outputData);

// initialisation du presenter avec accès aux données de YearChecking
$presenter = new Presenter($outputData);

// chemin de l'URL demandée au navigateur
// (p.ex. /annonces/index.php)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// définition d'une session d'une heure
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
session_start();

if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == 1) {
    $layoutTemplate = 'gui/layoutLogged.html';
} else {
    $layoutTemplate = 'gui/layout.html';
}

//
if ('/sae/index.php/modification' == $uri && isset($_POST['login']) && isset($_POST['password'])) {

    $error = $controller->authenticateAction($userCheck, $dataUsers);

    // Si erreur, on redirige vers la page de connexion
    if ($error != null) {

        $uri = '/sae/index.php/error';
        $redirect = '/sae/index.php/connection';
    }
}

// route la requête en interne
// i.e. lance le bon contrôleur en focntion de la requête effectuée
if ('/sae/' == $uri || '/sae/index.php' == $uri) {

    $layout = new Layout($layoutTemplate);
    $vueAccueil = new ViewAccueil($layout);

    $vueAccueil->display();

    $controller->gameAction($gameCheck, $dataYearsLecture);
} elseif ('/sae/index.php/connection' == $uri) {

    session_destroy();
    $layout = new Layout($layoutTemplate);
    $vueLogin = new ViewLogin($layout);

    $vueLogin->display();
} elseif ('/sae/index.php/deconnexion' == $uri && isset($_SESSION)) {

    session_unset();
    session_destroy();
    header("refresh:0;url=/sae/index.php/connection");
} elseif ('/sae/index.php/modification' == $uri && isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {

    $controller->modificationAction($yearCheck, $dataYears);

    $layout = new Layout($layoutTemplate);
    $vueLogin = new ViewModification($layout, $presenter);

    $vueLogin->display();
} elseif ('/sae/index.php/chatbot' == $uri) {

    $layout = new Layout($layoutTemplate);
    $vueChatBot = new ViewChatbot($layout);

    $vueChatBot->display();
} else if ('/sae/index.php/error' == $uri) {
    // Affichage d'un message d'erreur

    $layout = new Layout($layoutTemplate);
    $vueError = new ViewError($layout, $error, $redirect);

    $vueError->display();
} else {
    header('Status: 404 Not Found');
    echo '<html lang="fr"><body><h1>My Page NotFound</h1></body></html>';
}