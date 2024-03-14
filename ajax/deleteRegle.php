<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_POST['id'])) {
    $getInfos->deleteRegles(intval(trim($_POST['id'])));
    echo '';
}