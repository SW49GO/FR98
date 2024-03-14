<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_POST['id']) && isset($_POST['vitesse'])) {
    $res = $getInfos->vitesseDons(intval($_POST['id']), intval($_POST['vitesse']));
    echo json_encode($res);
}