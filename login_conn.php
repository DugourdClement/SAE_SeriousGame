<?php
include 'db_conn.php';

function getLogin($username, $password): void {
    $conn = createDBConn();
    session_start();

    $sql = "SELECT identifiant, mdp FROM utilisateur WHERE identifiant = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $db_username = $row['identifiant'];
        $db_password = $row['mdp'];

        if ($username == $db_username && password_verify($password, $db_password)) {
            $_SESSION['username'] = $username;
            $_SESSION['login'] = true;
            header("Location: index.html");
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
  </head>
  <body>
  <div class="connexion">
      <p class="sign" align="center">Se connecter</p>
    <form method="post">
      <input type="text" class="un" id="username" name="username" align="center" placeholder="Nom d'utilisateur"><br>
      <input type="password" class="deux" id="password" name="password" align="center" placeholder="Mot de passe"><br><br>
      <button type="submit" class="submit" align="center" name="submit-button" value="1">Envoyer</button>
    </form>
  </div>
  </body>
</html>

