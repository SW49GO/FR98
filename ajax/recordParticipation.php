<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_POST['id']) && isset($_POST['participation'])) {
    echo $getInfos->participation(intval($_POST['id']), intval($_POST['participation']));
}