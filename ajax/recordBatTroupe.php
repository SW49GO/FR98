<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_POST['id']) && isset($_POST['bat_t'])) {
    echo $getInfos->setBatTroupe(intval(trim($_POST['id'])), intval(trim($_POST['bat_t'])));
}