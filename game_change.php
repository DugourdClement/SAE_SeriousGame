<?php

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('refresh:5;url=ViewLogin.php');
    echo 'Vous n\'êtes pas connecté. Vous allez être redirigé vers la page de connexion.';
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = SPDO::getInstance();

    //var_dump($_POST);
    if (isset($_POST['idOpt'])) $idOpt = $_POST['idOpt'];
    if (isset($_POST['idTextSup'])) $idTextSup = $_POST['idTextSup'];
    $idText = $_POST['idText'];
    $text = $_POST['text'];

    if (isset($idOpt)) {
        $sql = "UPDATE option SET opt=$text WHERE option.id_texte = $idText and option.id_opt = $idOpt";
    } else if (isset($idTextSup)) {
        $sql = "UPDATE texte SET texte=$text WHERE texte.id_texte = $idTextSup";
    } else {
        $sql = "UPDATE texte SET texte=$text WHERE texte.id_texte = $idText";
    }
    $conn->query($sql);
} else {
    require("nav.php");
    require 'gui/ViewModification.php';
}