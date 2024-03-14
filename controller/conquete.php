<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}

$select = '';
$select = $getInfos->getPlayerConq();
$tabConq = '';
$dt = '';
$infos = $getInfos->getInfosConquete();
if (!empty($infos[0]['dateConq'])) {
    $date = new DateTime($infos[0]['dateConq']);
    //$date = $infos[0]['dateConq'];
    $dt = $date->format('d-m-Y');

}
if (!empty($infos[0]['adversaire'])) {
    $_SESSION['adver'] = strtoupper($infos[0]['adversaire']);
}
if (!empty($infos[0]['pointAdver'])) {
    $_SESSION['point'] = $infos[0]['pointAdver'];
}


if (isset($_POST['effaceConq'])) {
    $getInfos->deleteConquete();
    $getInfos->setPlayerConquete();
}
if (isset($_POST['dateConq'])) {
    $getInfos->setDateConquete();
    $infos = $getInfos->getInfosConquete();
    $date = new DateTime($infos[0]['dateConq']);
    //$date->add(new DateInterval('PT1H')); // + 1heure
    $dt = $date->format('d-m-Y');
}
if (isset($_POST['adversaire']) && !empty($_POST['adversaire'])) {
    $getInfos->setConqAdver(htmlspecialchars(ucfirst($_POST['adversaire'])));
    $_SESSION['adver'] = ucfirst($_POST['adversaire']);
}
if (isset($_POST['points']) && !empty($_POST['points'])) {
    $getInfos->setConqPoint(htmlspecialchars($_POST['points']));
    $_SESSION['point'] = $_POST['points'];
}
///////////Effacer un joueur///////////////
if (isset($_POST['suppr'])) {
    if (isset($_POST['select_player']) && !empty($_POST['select_player'])) {
        var_dump($_POST['select_player']);
        $getInfos->deleteOneConq(intval($_POST['select_player']));
    }
}

foreach ($infos as $i) {

    $tabConq .= '<tr><td>' . $i['name'] . '</td><td id="' . $i['id'] . '">' . $i['crane'] . '</td>';
    if (isset($_SESSION['user']['admin']) && $_SESSION['user']['name'] == 'Swillisss') {
        $tabConq .= '<td><input class="inputCrane" type="text" name="' . $i['id'] . '"></td>';
    }
    $tabConq .= '</tr>';
}



require 'view/conquete.php';