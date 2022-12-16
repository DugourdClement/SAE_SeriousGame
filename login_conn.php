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
            echo '<div class="error-message">Login failed. Please try again.</div>';
        }
    } else {
        echo '<div class="error-message">Login failed. Please try again.</div>';
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

    <link rel="stylesheet" href="connexion.css">
  </head>
  <body>
    <h1>Login</h1>
    <form method="post">
      <label for="username">Username:</label><br>
      <input type="text" id="username" name="username"><br>
      <label for="password">Password:</label><br>
      <input type="password" id="password" name="password"><br><br>
      <button type="submit" name="submit-button" value="1">Submit</button>
    </form>
  </body>
</html>

