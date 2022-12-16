<?php
header('Content-Type: application/json');
function createDBConn()
{
    $servername = "mysql-serious.alwaysdata.net";
    $username = "serious";
    $password = "minerim974";
    $dbname = "serious_bd";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}