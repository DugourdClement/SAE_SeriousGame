<?php
include 'db_conn.php';

header('Content-Type: text/html');

/**
 * @throws Exception
 */
function getData($maxSize): array
{
    $conn = createDBConn();
    $out = array();

    for ($i = 1; $i < $maxSize; ++$i) {
        $sql = "SELECT texte.*, opt FROM texte, option WHERE texte.id_texte = 10 + $i AND texte.id_texte = option.id_texte";
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

function modifyYearsForm($data, $i): void
{
    echo '<form action="game_change.php" method="POST" id="form_', $i, '">',
    '<p id="text_', $i, '" contenteditable>', json_encode($data[$i][1]), '</p>', //One contenteditable for the text
    '<button  class="submit" id="btnSubmit_', $i, '" type="submit" name="btnSubmit" form="form_', $i, '"> Valider</button>
          </form>';
    for ($j = 1; $j < 5; ++$j) {
        echo '<form action="game_change.php" method="POST" id="form_', $i, $j, '">',
        '<p id="text_', $i, $j, '" contenteditable>', json_encode($data[$i][$j + 1]), '</p>', //Four contenteditable for the options
        '<button  class="submit" id="btnSubmit_', $i, $j, '" type="submit" name="btnSubmit" form="form_', $i, $j, '"> Valider</button>
            </form>';
    }
}


try {
    $data = getData(2);
} catch (Exception $e) {
    $string = 'An error occurred: ' . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //var_dump($_POST);
    if(isset($_POST['idOpt'])) $idOpt = $_POST['idOpt'];
    $idText = $_POST['idText'];
    $text = $_POST['text'];
    $conn = createDBConn();

    if(isset($idOpt)) {
        $sql = "UPDATE option SET opt=$text WHERE option.id_texte = $idText+10 and option.id_opt = $idOpt+100";
    } else{
        $sql = "UPDATE texte SET texte=$text WHERE texte.id_texte = $idText+10";
    }
    $conn->query($sql);
    $conn->close();
}else{
echo '
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
        <script defer src="jQuery-3.6.3.js"></script>
    </head>
    <body>
     <div class="modification">
    <p id="banner">Modification enregistée</p>
        <label for="menu">Choisir une année à modifier : </label><br>
        <select name="menu" id="menu">
            <option value="base">---</option>
            <option value="option1">Année 2022</option>
            <option value="option2">Année 2032</option>
            <option value="option3">Année 2035</option>
            <option value="option4">Année 2039</option>
            <option value="option5">Année 2043</option>
            <option value="option6">Année 2050</option>
            <option value="option7">Année 2056</option>
        </select>

        <div class="form" id="form1" style="display: none;">';
            if(isset($data)) modifyYearsForm($data, 1);
  echo '</div>
        <div class="form" id="form2" style="display: none;">';
            if(isset($data)) modifyYearsForm($data, 2);
  echo '</div>
        <div class="form" id="form3" style="display: none;">';
            if(isset($data)) modifyYearsForm($data, 3);
  echo '</div>
        <div class="form" id="form4" style="display: none;">';
            if(isset($data)) modifyYearsForm($data, 4);
  echo '</div>
        <div class="form" id="form5" style="display: none;">';
            if(isset($data)) modifyYearsForm($data, 5);
  echo '</div>
        <div class="form" id="form6" style="display: none;">';
            if(isset($data)) modifyYearsForm($data, 6);
  echo '</div>
        <div class="form" id="form7" style="display: none;">';
            if(isset($data)) modifyYearsForm($data, 7);
  echo '</div>
</div>
    </body>
</html>';
}