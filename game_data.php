<?php
include 'db_conn.php';
$conn = createDBConn();

for ($i = 1; $i < 8; ++$i) {
    $query = $conn->prepare("SELECT COUNT(*) FROM texte WHERE texte.id_texte REGEXP ?");
    $str = "^" . $i . "[[:digit:]]{1}$";
    $query->bind_param("s", $str);
    $query->execute();
    $query->bind_result($nbChoice);
    $query->fetch();
    $out[$i] = array("nbChoice" => $nbChoice);
    $query->close();

    for ($j = 1; $j < $nbChoice + 1; ++$j) {
        $query = $conn->prepare("SELECT texte, opt FROM texte, option WHERE texte.id_texte = ? + ? AND texte.id_texte = option.id_texte");
        $var1 = $i * 10;
        $query->bind_param("ii", $var1, $j);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $row = $result->fetch_assoc();
            $tmp1 = [];
            $tmp1[] = $row["opt"];
            $text = $row["texte"];
            while ($row = $result->fetch_assoc()) {
                $tmp1[] = $row["opt"];
            }
            $out[$i][$j] = array("nbOpt" => $num_rows, $text, $tmp1);
        } else {
            echo json_encode("No data was recovering");
        }
    }

    $query = $conn->prepare("SELECT texte FROM texte WHERE texte.id_texte REGEXP ?");
    $str = "^" . $i . "0[[:digit:]]{1}$";
    $query->bind_param("s", $str);
    $query->execute();
    $result = $query->get_result();
    $query->close();

    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        $tmp2 = [];
        $tmp2["nbTextSup"] = $num_rows;
        while ($row = $result->fetch_assoc()) {
            $tmp2[] = $row["texte"];
        }
        $out[$i][$nbChoice + 1] = $tmp2;
    } else {
        echo json_encode("No data was recovering");
    }

}
$conn->close();
/*
foreach ($out as $subarray) {
    print_r($subarray);
    echo "\n";
}
*/
echo json_encode($out);