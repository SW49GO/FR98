<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
$listDons = $getInfos->listDons();
$tabList = '';
$select = '';
$select = $getInfos->getSelect();
////Tri Joueur
if (isset($_GET['joueur'])) {
    $listDons = $getInfos->listDons();
}
////Tri Guerre
if (isset($_GET['guerre'])) {
    $listDons = $getInfos->triGuerreDons();
}
////Tri Fonte
if (isset($_GET['fonte'])) {
    $listDons = $getInfos->triFonteDons();
}
////Tri Participation
if (isset($_GET['participation'])) {
    $listDons = $getInfos->triParticipationDons();
}
////Sélection du joueur à l'insigne de Guerre en Cours
if (isset($_POST['player'])) {
    if (isset($_POST['select_player']) && !empty($_POST['select_player'])) {
        $players = $getInfos->getOnePlayer(htmlspecialchars(trim($_POST['select_player'])));
        $getInfos->validInsDonGuerre($players['name']);
        header('location:index.php?page=dons');
        exit;
    }
}

if (isset($_SESSION['user'])) {
    foreach ($listDons as $l) {
        $tabList .= '<tr><td  id=' . $l['id'] . '>' . $l['name'] . '</td><td>' . $l['participation'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="participationDons" type="text" name="p' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['base'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="baseDons" type="text" name="b' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['tresor'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {

            $tabList .= '<td><input class="tresorDons" type="text" name="t' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['perle'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {

            $tabList .= '<td><input class="perleDons" type="text" name="pe' . $l['id'] . '"/></td>';
        }
        //$tabList .= '<td>' . $l['stockGuerre'] . ' /' . $l['gnb'] . ' </td>';
        $tabList .= '<td>' . $l['guerre'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
            $tabList .= '<td><input class="guerreDons" type="text" name="g' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['vitesse'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {

            $tabList .= '<td><input class="vitesseDons" type="text" name="v' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['insta'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {

            $tabList .= '<td><input class="instaDons" type="text" name="i' . $l['id'] . '"/></td>';
        }
        $tabList .= '<td>' . $l['fonte'] . '</td>';
        if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {

            $tabList .= '<td><input class="fonteDons" type="text" name="f' . $l['id'] . '"/></td>';
        }
        $tabList .= '</tr>';
    }
} else {
    header('location: index.php?page=connexion');
    exit;
}
if (isset($_POST['transfert'])) {
    $getInfos->stockGuerreDons();
    $getInfos->stockPerle();
    $getInfos->deleteGuerreDons();
    $getInfos->deletePerleDons();
    header('location: index.php?page=dons');
    exit;
}
require 'view/dons.php';