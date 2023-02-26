<?php
/**
 * Fonction qui permet de savoir si l'utilisateur est connecté ou non
 * @return void
 */
function login(): void
{
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        echo '<li><a href="ViewLogin.php">Connexion</a></li>';
    } else {
        echo '<li><a href="gui/ViewModification.php">Modification</a></li>';
        echo '<li><a href="logout.php">Déconnexion</a></li>';
    }
}
?>

<!--navbar pour ordinateur -->
<div class="sidenav">
    <a id="closeBtn" href="#" class="close">×</a>
    <ul>
        <li><a onclick="closeNav()" href="#ressource">Ressources</a></li>
        <li><a onclick="closeNav()" href="#cartes">Contacts</a></li>
        <li><a onclick="closeNav()" href="ChatBot/ViewChatbot.php" target="_blank">Chatbot</a></li>';
        <?php login(); ?>
    </ul>
</div>

<a href="#" id="openBtn">
  <span class="burger">
    <span></span>
    <span></span>
    <span></span>
  </span>
</a>

<!--navbar pour ordinateur -->
<nav class="nav">
    <div class="container">
        <div class="logo"><a href="ViewAccueil.php"><img id="logoManette" src="gui/Picture/site/logosae.png" alt=" retour en haut "></a></div>
        <div id="mainListDiv" class="main_list">
            <ul class="navlinks">
                <li><a href="#ressource">Ressources</a></li>
                <li><a href="#cartes">Contacts</a></li>
                <li><a href="ChatBot/ViewChatbot.php" target="_blank">ChatBox</a></li>';
                <?php login(); ?>
            </ul>
        </div>
    </div>
</nav>