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
echo "Connected successfully\n";

for($i = 1; $i < 2; ++$i ){
    $sql = "select images.img_id, img_blob, text_text from images, text where images.img_id = $i and images.img_id = text.img_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo json_encode([$row["img_id"], $row["img_blob"], $row["text_text"]]);
        }
    } else {
        echo json_encode("0 results");
    }
}

$conn->close();