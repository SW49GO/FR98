<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();
$res = '';

if (isset($_POST['boost_id'])) {
    $result = $_POST['boost_id'];
    $result = json_decode($result, true);

    foreach ($result as $key => $value) {
        $getInfos->updateBoosts(htmlspecialchars(trim(intVal($value['id']))), htmlspecialchars(trim(intVal($value['active']))));
        $pts = $getInfos->infosBoosts(htmlspecialchars(trim(intVal($value['id']))));

        if ($value['active']) {
            $res = intval($pts['pts']);
        } else {
            $res = -intval($pts['pts']);
        }
    }
    echo $res;
}