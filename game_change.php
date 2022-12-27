<?php
include 'db_conn.php';

/**
 * @throws Exception
 */
function getData($maxSize): array
{
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

function martixToString(): void
{
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

function modifyBd() : void
{
    $conn = createDBConn();
    $id = $_POST['id'];

    if ($id == 'text1') {
        $text = $_POST['text1'];
        $sql = "UPDATE texte SET texte='$text' WHERE texte.id_texte = 1";
        $conn->query($sql);
    } elseif ($id == 'text2') {
        $text = $_POST['text2'];
        $sql = "UPDATE texte SET texte='$text' WHERE texte.id_texte = 2";
        $conn->query($sql);
    } elseif ($id == 'text3') {
        $text = $_POST['text3'];
        $sql = "UPDATE texte SET texte='$text' WHERE texte.id_texte = 3";
        $conn->query($sql);
    }
    $conn->close();
}


function modifAnnee($data, $i):void
{
    echo '<div class="modifText">',
            '<form action="game_change.php" method="post">',
                '<p id="text-', $i, '" contenteditable>', json_encode($data[$i + 1][1]), '</p>', //One contenteditable for the text
                '<button  class="submit" type="submit" form="form', $i, '"> Valider</button>
            </form>';
    for ($j = 0; $j < 4; ++$j) {
        echo '<form action="game_change.php" method="post">',
                '<p id="opt-', $i, $j, '" contenteditable>', json_encode($data[$i + 1][$j + 2]), '</p>', //Four contenteditable for the options
                '<button  class="submit" type="submit" form="form', $i, $j, '"> Valider</button>
            </form>';
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
        <label for="menu">Select an option:</label><br>
        <select name="menu" id="menu">
            <option value="base">---</option>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
        </select>

        <form id="form1" style="display: none;">
            <?php if(isset($data)) modifAnnee($data, 0); ?>
        </form>
        <form id="form2" style="display: none;">
            <?php if(isset($data)) modifAnnee($data, 1); ?>
        </form>
        <form id="form3" style="display: none;">
            <?php if(isset($data)) modifAnnee($data, 2); ?>
        </form>


    </body>
</html>