<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_POST['id']) && isset($_POST['name'])) {
    $getInfos->supprExcel(intval($_POST['id']), htmlspecialchars(trim($_POST['name'])));
}