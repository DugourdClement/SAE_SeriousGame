<?php
session_start();
require 'data/YearSqlAccess.php';

/**
 * Cette fonction vérifie si l'utilisateur a saisi des identifiants valides et le connecte s'il est authentifié.
 *
 * @param string $username Le nom d'utilisateur saisi par l'utilisateur.
 * @param string $password Le mot de passe saisi par l'utilisateur.
 * @return void
 */
function getLogin($username, $password): void
{
    $isUser = isUser($username, $password);

    if ($isUser) {
        $_SESSION['username'] = $username;
        $_SESSION['login'] = true;
        header("Location: ViewModification.php");
        exit;
    } else {
        echo '<div class="error-message">Utilisateur ou mot de passe inconnue. Veuillez réessayer.</div>';
    }
}

/**
 * Cette fonction vérifie si l'utilisateur a cliqué sur le bouton de connexion.
 * Si c'est le cas, elle appelle la fonction getLogin().
 * @return void
 * @see getLogin()
 */
if (isset($_POST['submit-button'])) {
    getLogin($_POST['username'], $_POST['password']);
}
require("nav.php");
require 'gui/ViewLogin.php';