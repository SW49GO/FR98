<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}
$boosts = $getInfos->getBoosts();
$nbBoost = $getInfos->numberBoost();
$nb = '';
$active = '0';
foreach ($nbBoost as $b) {
    $nb = $b['nb'];
    $active = $active + $b['pts'];
}

if (isset($_POST['valid'])) {
    if (isset($_POST['nbVote']) && !empty($_POST['nbVote'])) {
        $getInfos->updateNbBoosts(htmlspecialchars(trim(intval($_POST['nbVote']))));
        header('location: index.php?page=voteplayer');
        exit;
    } else {
        $getInfos->deleteBoosts();
        header('location: index.php?page=voteadmin');
        exit;
    }
}
if (isset($_POST['newWar'])) {
    $getInfos->deleteBoosts();
    $getInfos->deleteAllVotant();
    header('location: index.php?page=voteadmin');
    exit;
}
if (isset($_POST['cancel'])) {
    $getInfos->deleteBoosts();
    header('location: index.php?page=voteadmin');
}


require 'view/voteadmin.php';