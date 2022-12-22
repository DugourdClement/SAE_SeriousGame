<?php
include 'db_conn.php';

/**
 * @throws Exception
 */
function getData($maxSize): array {
    $conn = createDBConn();
    $out = array();

    for ($i = 1; $i < $maxSize; ++$i) {
        $sql = "SELECT texte.*, opt FROM texte, option WHERE texte.id_texte = $i AND texte.id_texte = option.id_texte";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tmp = array($i, $row["texte"], $row["opt"]);
            while ($row = $result->fetch_assoc()) {
                $tmp[] = $row["opt"];
            }
            $out[$i] = $tmp;
        } else {
            throw new Exception("No data was recovering");
        }
    }
    $conn->close();
    return $out;
}

function martixToString(): void{
    try {
        $string = implode("; ", array_map(function ($inner) {
            return implode(", ", $inner);
        }, getData(2)));
    } catch (Exception $e) {
        $string = 'An error occurred: ' . $e->getMessage();
    }
    echo $string;
}

try {
    $data = getData(2);
} catch (Exception $e) {
    $string = 'An error occurred: ' . $e->getMessage();
}

if (isset($_POST['text'])) {
    $text = $_POST['text'];

}

function modifAnnee($data):void{
    for ($i = 0; $i < 7; ++$i) {
        echo '<div class="modfAnnee">';
        echo '<p id="text-'; echo $i; echo '" contenteditable>'; echo json_encode($data[$i+1][1]); echo '</p>';
        for ($j = 0; $j < 4; ++$j) {
            echo '<p id="opt-'; echo $i; echo $j;  echo '" contenteditable>'; echo json_encode($data[$i+1][$j+2]); echo '</p>';
        }
        echo '<form action="game_change.php" method="post">';
        for ($i = 0; $i < 5; ++$i) {
            echo '<button type = "submit" class="submit" name = "submit-button" value = "1" > Valider</button>';
        }
        echo '</form>';
    }
    echo '</div>';
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
        <link rel="stylesheet" href="game_change.css">
        <script defer src="game_change.js"></script>
    </head>
    <body>
        <?php modifAnnee($data) ?>
    </body>
</html>
