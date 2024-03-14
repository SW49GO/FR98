<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
$tab = array();
if (isset($_POST['id'])) {
    $tab['id'] = $_POST['id'];
    $res = $getInfos->getOneRegle(intval(trim($_POST['id'])));
    $tab['comment'] = $res['comment'];
    echo json_encode($tab);
}