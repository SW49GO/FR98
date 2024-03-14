<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_POST['id']) && isset($_POST['base'])) {
    $res = $getInfos->baseDons(intval($_POST['id']), intval($_POST['base']));
    echo json_encode($res);
}