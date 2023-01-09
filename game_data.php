<?php
include 'db_conn.php';
$conn = createDBConn();

for ($i = 1; $i < 2; ++$i) {
    $query = $conn->prepare("SELECT COUNT(*) FROM texte WHERE texte.id_texte REGEXP ?");
    $str = "^" . $i . "[[:digit:]]{1}$";
    $query->bind_param("s", $str);
    $query->execute();
    $query->bind_result($nbChoice);
    $query->fetch();
    $query->close();

    for ($j = 1; $j < $nbChoice + 1; ++$j) {
        $query = $conn->prepare("SELECT texte, opt FROM texte, option WHERE texte.id_texte = ? + 9 + ? AND texte.id_texte = option.id_texte");
        $query->bind_param("ii", $i, $j);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $row = $result->fetch_assoc();
            $tmp1[] = $row["opt"];
            $text = $row["texte"];
            while ($row = $result->fetch_assoc()) {
                $tmp1[] = $row["opt"];
            }
            $out[$i] = array("nbChoice" => $nbChoice, array("nbOpt" => $num_rows, $text, $tmp1));
        } else {
            echo json_encode("No data was recovering");
        }
    }

    $id = $i + ($i * 100);
    $query = $conn->prepare("SELECT texte FROM texte WHERE texte.id_texte = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $query->close();

    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        $tmp2["nbTextSup"] = $num_rows;
        while ($row = $result->fetch_assoc()) {
            $tmp2[] = $row["texte"];
        }
    } else {
        echo json_encode("No data was recovering");
    }
    $out[$i][] = $tmp2;
}
$conn->close();
/*
foreach ($out as $subarray) {
    print_r($subarray);
    echo "\n";
}
*/
echo json_encode($out);