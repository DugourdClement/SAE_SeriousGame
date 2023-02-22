<?php
include 'SPDO.php';
$conn = createDBConn();

// boucle for pour récupérer les données de la base de données et les mettre dans un tableau $out
for ($i = 1; $i < 8; ++$i) {
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
            echo json_encode("No data was recovering");
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
        echo json_encode("No data was recovering");
    }

}
/*
foreach ($out as $subarray) {
    print_r($subarray);
    echo "\n";
}
*/
echo json_encode($out);