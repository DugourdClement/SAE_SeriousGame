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

include_once 'gui/ViewAccueil.php';
include_once 'gui/ViewModification.php';
include_once 'gui/ViewLogin.php';
include_once 'gui/ViewChatbot.php';
include_once 'gui/Layout.php';
include_once 'gui/ViewError.php';


// faut faire la navbar

$bd = null;
try {
    // construction du modèle
    $bd = SPDO::getInstance();
    $dataYears = new YearSqlAccess($bd);
    $dataUsers = new UserSqlAccess($bd);

} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}

// initialisation de l'output pour le transfert des données
$outputData = new OutputData();

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

// route la requête en interne
// i.e. lance le bon contrôleur en focntion de la requête effectuée
if ('/sae/' == $uri || '/sae/index.php' == $uri) {

    $layout = new Layout("gui/layout.html");
    $vueAccueil = new ViewAccueil($layout);

    $vueAccueil->display();
} elseif ('/sae/index.php/connection' == $uri) {

    session_destroy();
    $layout = new Layout("gui/layout.html");
    $vueLogin = new ViewLogin($layout);

    $vueLogin->display();
} elseif ('/sae/index.php/deconnexion' == $uri && isset($_SESSION)) {

    session_unset();
    session_destroy();
    header("refresh:0;url=/sae/index.php/connection");
} elseif ('/sae/index.php/modification' == $uri && isset($_POST['login']) && isset($_POST['password'])
    && isset($_POST['g-recaptcha-response'])) {

    $error = $controller->authenticateAction($userCheck, $dataUsers);

    // Si erreur, on redirige vers la page de connexion
    if ($error != null) {

        $uri = '/sae/index.php/error';
        $redirect = '/sae/index.php/connection';
    } // Sinon, on affiche la page de modification
    else {

        $controller->modificationAction($yearCheck, $dataYears);

        $layout = new Layout("gui/layout.html");
        $vueLogin = new ViewModification($layout, $presenter);

        $vueLogin->display();
    }
} elseif ('/sae/index.php/chatbot' == $uri) {

    $layout = new Layout("gui/layout.html");
    $vueChatBot = new ViewChatbot($layout);

    $vueChatBot->display();
}
else {
    header('Status: 404 Not Found');
    echo '<html lang="fr"><body><h1>My Page NotFound</h1></body></html>';
}

if ('/sae/index.php/error' == $uri) {
    // Affichage d'un message d'erreur

    $layout = new Layout("gui/layout.html");
    $vueError = new ViewError($layout, $error, $redirect);

    $vueError->display();
}