<?php
header('Content-Type: text/html');
?>
<!DOCTYPE html>
<head>
    <script defer src="web.js"></script>
</head>
<body>
<div id="mySidenav" class="sidenav">
    <a id="closeBtn" href="#" class="close">×</a>
    <ul>
        <li><a onclick="closeNav()" href="index.php#ressource">Ressources</a></li>
        <li><a onclick="closeNav()" href="#index.php#cartes">Contacts</a></li>
        <li><a onclick="closeNav()" href="chatbot.php" target="_blank">ChatBox</a></li>
        <li><a href="login_conn.php">Connexion</a></li>
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
        <div class="logo"><a href="index.php"><img id="logoManette" src="Picture/site/logosae.png" alt=" retour en haut "></a></div>
        <div id="mainListDiv" class="main_list">
            <ul class="navlinks">
                <li><a href="index.php#ressource">Ressources</a></li>
                <li><a href="index.php#cartes">Contacts</a></li>
                <li><a href="chatbot.php" target="_blank">ChatBox</a></li>
                <li><a href="login_conn.php">Connexion</a></li>
            </ul>
        </div>
    </div>
</nav>
</body>
</html>
