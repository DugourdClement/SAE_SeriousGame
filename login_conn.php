<?php
include 'db_conn.php';

function getLogin($username, $password): void {
    $conn = createDBConn();
    session_start();

    $query = $conn->prepare("SELECT identifiant, mdp FROM utilisateur WHERE identifiant = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();
    $query->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $db_username = $row['identifiant'];
        $db_password = $row['mdp'];

        if ($username == $db_username && password_verify($password, $db_password)) {
            $_SESSION['username'] = $username;
            $_SESSION['login'] = true;
            header("Location: game_change.php");
            exit;
        } else {
            echo '<div class="error-message">Votre connexion a échoué. Veuillez réessayer.</div>';
        }
    } else {
        echo '<div class="error-message">Votre connexion a échoué. Veuillez réessayer.</div>';
    }
    $conn->close();
}

if (isset($_POST['submit-button'])) {
    getLogin($_POST['username'],$_POST['password']);
}

header('Content-Type: text/html');

?>

<!DOCTYPE html>
<html  class="no-js" lang="">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="icon" type="image/png" sizes="16x16" href="Picture/site/icone.png">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="connexion.css">
    <link rel="stylesheet" href="styleSheet.css">


</head>

<?php require("nav.php");?>

<body>
<div class="home" id="home">
<div class="connexion">
    <p class="sign" >Se connecter</p>
    <form method="post">
        <input type="text" class="champ" id="username" name="username" placeholder="Nom d'utilisateur">
        <input type="password" class="champ" id="password" name="password" placeholder="Mot de passe">
        <button type="submit" class="submit" name="submit-button" value="1">Envoyer</button>
    </form>
</div>
</div>
</body>
</html>
