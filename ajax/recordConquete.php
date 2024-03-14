<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
$tab = [];
if (isset($_POST['id']) && isset($_POST['crane'])) {
    $getInfos->setCraneConquete(htmlspecialchars(trim(intval($_POST['id']))), htmlspecialchars(trim($_POST['crane'])));
    $tab = ['crane' => htmlspecialchars(trim($_POST['crane']))];
    echo $tab['crane'];
}