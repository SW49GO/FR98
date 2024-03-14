<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}
$nbBoost = $getInfos->numberBoost();
$nb = '0';
$select = '';
$nbPotion = $getInfos->nbPotion();
$potion = count($nbPotion);
$list = $getInfos->listVotant();
$start = $getInfos->getBoosts();
$startAdmin = $start[0]['start'];
$nombVote = count($list);
foreach ($list as $l) {
    $select .= '<option value="' . $l['id'] . '">' . $l['pseudo'] . '</option>';
}

$listVotant = '<h2>Personnes ayant déjà déposés leur souhait : ' . $nombVote . '</h2><br>';

/// Vide la séléction des boosts
$getInfos->refreshVote();
//////////Ouverture du droit de vote 
if (isset($_POST['startAdmin'])) {
    $getInfos->startVote('1');
    header('location:index.php?page=voteplayer');
    exit;
}
//////////Fermeture du droit de vote 
if (isset($_POST['closeAdmin'])) {
    $getInfos->startVote('0');
    header('location:index.php?page=voteplayer');
    exit;
}
///////////Lancement du vote
if (isset($_SESSION['user']) && isset($_POST['startVote'])) {
    $_SESSION['player'] = $_SESSION['user']['name'];
    $getInfos->setPseudo(ucfirst($_SESSION['player']));
    if (isset($_POST['potion'])) {
        $getInfos->setPotion(htmlspecialchars(trim($_SESSION['user']['name'])), 1);
        header('location: index.php?page=voteplayer');
        exit;
    } else {
        $getInfos->setPotion(htmlspecialchars(trim($_SESSION['user']['name'])), 0);
    }
}

foreach ($list as $l) {
    $tab = json_decode($l['choix']);
    $info = '(';
    if ($l['potion'] == '1') {
        $info .= 'GARDER LES POTIONS';
    }
    if (!empty($tab)) {
        for ($len = 0; $len < count($tab); $len++) {
            $getInfos->updateVoteBoost(intval($tab[$len]->id));
            $res = $getInfos->infosBoosts(intval($tab[$len]->id));
            $name = explode('.', $res['name']);
            $info .= ucfirst($name[0]) . ' / ';
        }
    }
    $info .= ')';
    $listVotant .= '<div style="color:orange; font-size:20px;text-align:left;margin-left:50px" id="' . $l['id'] . '"><p>•&ensp;' . $l['pseudo'] . '&emsp;✅&#x2192;' . $info . ' le : ' . $l['date_vote'] . '</p></div>';
}

foreach ($nbBoost as $b) {
    $nb = $b['nb'];
}

if (isset($_POST['validPseudo'])) {
    if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
        $res = $getInfos->verifyVotant(htmlspecialchars(trim($_POST['pseudo'])));
        if ($res) {
            header('location:index.php?page=voteplayer');
            exit;
        } else {
            $_SESSION['player'] = ucfirst($_POST['pseudo']);
            $getInfos->setPseudo(htmlspecialchars(trim(ucfirst($_POST['pseudo']))));
        }
        if (isset($_POST['potion'])) {
            $getInfos->setPotion(htmlspecialchars(trim($_POST['pseudo'])), 1);
            header('location:index.php?page=voteplayer');
            exit;
        }
    } else {
        header('location:index.php?page=voteplayer');
        exit;
    }
}

if (isset($_POST['submitSuppr'])) {
    if (isset($_POST['player'])) {
        $getInfos->deleteVotant(htmlspecialchars(trim(intval($_POST['player']))));
        header('location:index.php?page=voteplayer');
        exit;
    }
}
if (isset($_POST['playerBoost'])) {
    header('location:index.php?page=voteplayer');
    exit;
}

require 'view/voteplayer.php';