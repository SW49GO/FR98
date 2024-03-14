<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
$getInfos->setClassement();
$getInfos->copyDonInsigne();
$getInfos->copyConqParticipation();
$getInfos->participationTotal();

if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}
$tabList = '';
$player = $getInfos->getAllPlayerPart();
$count = count($player);
if (isset($_GET['insigne'])) {
    $player = $getInfos->triInsigne();
}
if (isset($_GET['ninja'])) {
    $player = $getInfos->triNinja();
}
if (isset($_GET['guerre'])) {
    $player = $getInfos->triGuerre();
}
if (isset($_GET['conquete'])) {
    $player = $getInfos->triConquete();
}
if (isset($_GET['total'])) {
    $player = $getInfos->triTotal();
}
if (isset($_GET['player'])) {
    $player = $getInfos->getAllPlayerPart();
}
foreach ($player as $l) {
    if ($l['stay'] == 1) {
        $tabList .= '<tr><td style="font-size:20px">' . $l['class'] . '</td><td id=' . $l['id'] . '>' . $l['name'] . '</td>';
        $tabList .= '<td>' . $l['insigne'] . '</td>';
        $tabList .= '<td>' . $l['ninja'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="p_ninja" type="text" name="ninja' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['guerre'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="p_guerre" type="text" name="guerre' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['conquete'] . '</td>';
        $tabList .= '<td class="total">' . $l['total'] . '</td>';
        $tabList .= '</tr>';
    }
}

require 'view/participation.php';