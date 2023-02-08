<?php
require 'SPDO.php';
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php');
    exit;
}

header('Content-Type: text/html');

/**
 * @throws Exception
 */
function getData($nbYear): array //$nbYear = 2but must be 7 maybe use a another query
{
    $conn = SPDO::getInstance();


    for ($i = 1; $i < $nbYear; ++$i) {
        $query = $conn->prepare("SELECT COUNT(*) FROM texte WHERE texte.id_texte REGEXP ?");
        $str = "^" . $i . "[[:digit:]]{1}$";
        $query->bindParam("s", $str);
        $query->execute();
        $nbChoice = $query->fetchAll();
        $query->fetch();
        $out[$i] = array("nbChoice" => $nbChoice);

        for ($j = 1; $j < $nbChoice + 1; ++$j) {
            $query = $conn->prepare("SELECT texte, opt FROM texte, option WHERE texte.id_texte = ? + ? AND texte.id_texte = option.id_texte");
            $var1 = $i * 10;
            $query->bindParam("ii", $var1, $j);
            $query->execute();
            $result = $query->fetchAll();

            if (sizeof($result) > 0) {
                $row = $result[0];
                $tmp1 = [];
                $tmp1[] = json_encode($row["opt"]);
                $text = json_encode($row["texte"]);
                $h = 1;
                while ($row = $result[$h]) {
                    $tmp1[] = json_encode($row["opt"]);
                    $h++;
                }
                $out[$i][$j] = array("nbOpt" => sizeof($result), $text, $tmp1);

            } else {
                throw new Exception("No data was recovering at {$i} in texte or opt query");
            }
        }

        $query = $conn->prepare("SELECT texte FROM texte WHERE texte.id_texte REGEXP ?");
        $str = "^" . $i . "0[[:digit:]]{1}$";
        $query->bindParam("s", $str);
        $query->execute();
        $result = $query->fetchAll();

        if (sizeof($result) > 0) {
            $tmp2 = [];
            $tmp2["nbTextSup"] = sizeof($result);
            $h = 1;
            while ($row = $result[$h]) {
                $tmp2[] = json_encode($row["texte"]);
                $h++;
            }
            $out[$i][$nbChoice + 1] = $tmp2;
        } else {
            throw new Exception("No data was recovering at {$i} in textSup query");
        }
    }
    /*
    foreach ($out as $subarray) {
        print_r($subarray);
        echo "\n";
    }
    */
    return $out;
}

function modifyYearsForm($data, $currentYear): void
{
    $nbChoice = $data[$currentYear]["nbChoice"] + 1;
    for ($i = 1; $i < $nbChoice; ++$i) {
        echo '<form action="game_change.php" method="POST" id="form_', $currentYear, $i, '">',
        '<p id="text_', $currentYear, $i, '" contenteditable>', json_decode($data[$currentYear][$i][0]), '</p>', //One contenteditable for the text
        '<button  class="submit" id="btnSubmit_', $currentYear, $i, '" type="submit" name="btnSubmit" form="form_', $currentYear, $i, '"> Valider</button>
          </form>';
        for ($j = 1; $j < $data[$currentYear][$i]["nbOpt"] + 1; ++$j) {
            echo '<form action="game_change.php" method="POST" id="form_', $currentYear, $i, $j, '">',
            '<p id="text_',$currentYear, $i, $j, '" contenteditable>', json_decode($data[$currentYear][$i][1][$j - 1]), '</p>', //Four contenteditable for the options
            '<button  class="submit" id="btnSubmit_', $currentYear, $i, $j, '" type="submit" name="btnSubmit" form="form_', $currentYear, $i, $j, '"> Valider</button>
            </form>';
        }
    }
    for ($j = 1; $j < $data[$currentYear][$nbChoice]["nbTextSup"] + 1; ++$j) {
        echo '<form action="game_change.php" method="POST" id="form_', $currentYear, '0', $j, '">',
        '<p id="text_', $currentYear, '0', $j, '" contenteditable>', json_decode($data[$currentYear][$nbChoice][$j -1]), '</p>', //Mutilple contenteditable for the other text
        '<button  class="submit" id="btnSubmit_', $currentYear, '0', $j, '" type="submit" name="btnSubmit" form="form_', $currentYear, '0', $j, '"> Valider</button>
            </form>';
    }
    /*
    foreach ($data as $subarray) {
        print_r($subarray);
        echo "\n";
    }
    */
}


try {
    $data = getData(8);
} catch (Exception $e) {
    echo '<script>console.log("An error occurred: "', $e->getMessage(), ')</script>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = SPDO::getInstance();

    //var_dump($_POST);
    if(isset($_POST['idOpt'])) $idOpt = $_POST['idOpt'];
    if(isset($_POST['idTextSup'])) $idTextSup = $_POST['idTextSup'];
    $idText = $_POST['idText'];
    $text = $_POST['text'];

    if(isset($idOpt)) {
        $sql = "UPDATE option SET opt=$text WHERE option.id_texte = $idText and option.id_opt = $idOpt";
    } else if (isset($idTextSup)){
        $sql = "UPDATE texte SET texte=$text WHERE texte.id_texte = $idTextSup";
    } else{
        $sql = "UPDATE texte SET texte=$text WHERE texte.id_texte = $idText";
    }
    $conn->query($sql); 
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
    <header>
    <div class="logo"><a href="index.php"><img id="logoManette" src="Picture/site/logosae.png" alt=" retour en haut "></a></div>
    </header>
    <div id="change">
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