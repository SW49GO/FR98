<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_POST['id'])) {
    $com = $_POST['comment'];
    $getInfos->updateRegles(intval(trim($_POST['id'])), htmlspecialchars(trim($_POST['comment'])));
    echo $com;
}