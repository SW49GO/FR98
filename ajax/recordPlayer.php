<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_POST['name']) && !empty($_POST['name'])) {
    $data = ['name' => htmlspecialchars(trim(ucfirst($_POST['name']))), 'grade' => htmlspecialchars(trim($_POST['grade'])), 'crane' => htmlspecialchars(trim($_POST['crane']))];
    $getInfos->addCombatOnePlayer(htmlspecialchars(trim(ucfirst($_POST['name']))));
    $getInfos->addPlayerDons(htmlspecialchars(trim(ucfirst($_POST['name']))));
    $getInfos->addPlayerConq(htmlspecialchars(trim(ucfirst($_POST['name']))));
    $getInfos->addPlayerPart(htmlspecialchars(trim(ucfirst($_POST['name']))));
    echo $getInfos->addOnePlayer($data);
}