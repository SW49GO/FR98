<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}
$bannis = '';
$data = array();
$playerBannis = $getInfos->getAllBannis();
if (isset($_SESSION['user'])) {
    $bannis = '<table class="tab_bannis"><tr><th>NOM DU JOUEUR</th><th>RAISON BANNISSEMENT</th></tr>';
    foreach ($playerBannis as $p) {
        $bannis .= '<tr><td>' . $p['name'] . '</td><td>' . $p['comment'] . '</td></tr>';
    }
    $bannis .= '</table>';
} else {
    header('location: index.php?page=connexion');
}
// Ajouter un Bannis
if (isset($_POST['submit'])) {
    if (isset($_POST['add_bannis']) && !empty($_POST['add_bannis'])) {
        $data['name'] = htmlspecialchars(trim(ucfirst($_POST['add_bannis'])));
    }
    if (isset($_POST['reason_bannis'])) {
        $data['comment'] = htmlspecialchars(trim(ucfirst($_POST['reason_bannis'])));
    }
    $getInfos->addBannis($data);
    header('Location: index.php?page=bannis');
    exit;
}

require 'view/bannis.php';