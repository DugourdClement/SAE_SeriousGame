<?php
header('Content-Type: application/json');
$servername = "mysql-serious.alwaysdata.net";
$username = "serious";
$password = "minerim974";
$dbname = "serious_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully\n";

for($i = 1; $i < 2; ++$i ){
    $sql = "SELECT texte.*, id_opt, opt FROM texte, option WHERE texte.id_texte = $i AND texte.id_texte = option.id_texte";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $out = array($i, $row["texte"], $row["opt"]);
        while($row = $result->fetch_assoc()) {
            $out[] = $row["opt"];
        }
        echo json_encode($out);
    } else {
        echo json_encode("0 results");
    }
}

$conn->close();