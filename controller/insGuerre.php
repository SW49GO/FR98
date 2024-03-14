<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();

if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}

require 'view/insGuerre.php';