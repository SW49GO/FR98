<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}
$tabList = '';
$player = $getInfos->getAllPlayersConq();
if (isset($_GET['troupe'])) {
    $player = $getInfos->triBatTroupe();
}
if (isset($_GET['sagesse'])) {
    $player = $getInfos->triBatSagesse();
}
if (isset($_GET['pierre'])) {
    $player = $getInfos->triBatPierre();
}
if (isset($_GET['dont'])) {
    $player = $getInfos->triDonTroupe();
}
if (isset($_GET['dons'])) {
    $player = $getInfos->triDonSagesse();
}
if (isset($_GET['donp'])) {
    $player = $getInfos->triDonPierre();
}
if (isset($_GET['crane'])) {
    $player = $getInfos->triCraneConq();
}
if (isset($_GET['part'])) {
    $player = $getInfos->triPartConq();
}
if (isset($_GET['joueur'])) {
    $player = $getInfos->getAllPlayersConq();
}
foreach ($player as $l) {
    if ($l['stay'] == 1) {
        $tabList .= '<tr><td  id=' . $l['id'] . '>' . $l['name'] . '</td><td>' . $l['bat_t'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="batiment_t" type="text" name="t' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['bat_s'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="batiment_s" type="text" name="s' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['bat_p'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="batiment_p" type="text" name="p' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['don_t'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="don_t" type="text" name="dt' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['don_s'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="don_s" type="text" name="ds' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['don_p'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="don_p" type="text" name="dp' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['crane'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="conq_c" type="text" name="crane' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['participation'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="conq_p" type="text" name="part' . $l['id'] . '"/></td>';
        }
        $tabList .= '</tr>';
    }
}
if (isset($_POST['erase'])) {
    $getInfos->eraseConq();
    header('location: index.php?page=adminConq');
    exit;
}


require 'view/adminConq.php';