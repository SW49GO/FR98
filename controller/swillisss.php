<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}
$select = '';
$select = $getInfos->getSelect();
$listConnect = $getInfos->connectPlayers();
$name = '';
$pwd = '';
$id = '';

$playerConnect = '<div class="listConnect"><p style="color:rgb(103, 171, 239);text-decoration: underline">JOUEURS DERNIERE CONSULTATION :</p>';
foreach ($listConnect as $l) {
    /*
    $date = new DateTime($l['connect']);
    $date->add(new DateInterval('PT1H')); // + 1heure
    $dt = $date->format('d-m-Y H:i:s');
    */
    $dt = $l['connect'];
    $playerConnect .= '<br><p style="color:' . $l['grade'] . '">' . strtoupper($l['name']) . ' &rarr; ' . $dt . '&emsp;' . $_SERVER['REMOTE_ADDR'] . '</p>';
}
$playerConnect .= '</div>';

if (isset($_POST['submit'])) {
    if (isset($_POST['select_player']) && !empty($_POST['select_player'])) {
        $players = $getInfos->getOnePlayer(htmlspecialchars(trim($_POST['select_player'])));
        $id = htmlspecialchars(trim($_POST['select_player']));
        if (isset($_POST['newPseudo']) && !empty($_POST['newPseudo'])) {
            $name = htmlspecialchars(trim(ucfirst($_POST['newPseudo'])));
            $getInfos->changeName(htmlspecialchars(trim($players['name'])), $name);
        } else {
            $name = $players['name'];
        }
        if (isset($_POST['password'])) {
            $pwd = htmlspecialchars(trim($_POST['password']));
        }
        $getInfos->updateInfoPlayer($id, $name, $pwd);
    }
}
require 'view/swillisss.php';