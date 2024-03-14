<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_POST['id']) && isset($_POST['don_p'])) {
    $getInfos->setPierreConq(intval(trim($_POST['id'])), intval(trim($_POST['don_p'])));
    echo intval($_POST['don_p']);
}