<?php
session_start();
require_once 'config/config.php';
require_once 'model/Manage.php';
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
$manage = new Manage();

if (isset($_SESSION['user'])) {
    if (isset($_GET['deco'])) {
        $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 0);
        $_SESSION = [];
        session_destroy();
    }
}
$page = $_GET['page'] ?? '';

require $manage->router($page);