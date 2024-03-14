<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
$tab = array();
if (isset($_POST['comment'])) {
    $tab = ['author' => htmlspecialchars(trim(ucfirst($_SESSION['user']['name']))), 'comment' => htmlspecialchars(trim(ucfirst($_POST['comment'])))];
    $getInfos->setRegles($tab);
    $nb = count($getInfos->listRegles());
    $tab['date'] = date('d/m/Y');
    $tab['nb'] = $nb;
    $int = $getInfos->lastIdRegles();
    $tab['id'] = $int['MAX(id)'];
    echo json_encode($tab);
}