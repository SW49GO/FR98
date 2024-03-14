<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}
$nameTeam = '';
$tabCombat = '';
// Affichage du formulaire des noms d'équipe
if (isset($_POST['submitConf'])) {
    if (isset($_POST['nbFront']) && !empty($_POST['nbFront'])) {
        $_SESSION['nbFront'] = intval($_POST['nbFront']);
        for ($i = 0; $i < intval($_POST['nbFront']); $i++) {
            $nameTeam .= '<label>Front ' . $i . ' :</label><input type="text" name="team' . $i . '">';
        }
    }
    if (isset($_POST['nbJour']) && !empty($_POST['nbJour'])) {
        $_SESSION['nbJour'] = htmlspecialchars(trim($_POST['nbJour']));
    }
    if (isset($_POST['nbJ']) && !empty($_POST['nbJ'])) {
        $_SESSION['nbJ'] = htmlspecialchars(trim($_POST['nbJ']));
    }
    if (isset($_POST['nbC']) && !empty($_POST['nbC'])) {
        $_SESSION['nbC'] = htmlspecialchars(trim($_POST['nbC']));
    }
}
// Récupération des noms d'équipe par jour + nb combats 
if (isset($_POST['submitTeam'])) {
    $tab = '';
    for ($i = 0; $i < intval($_SESSION['nbFront']); $i++) {
        $tab .= $_POST['team' . $i] . '/';
    }
    $data = ['jour' => $_SESSION['nbJour'], 'team' => $tab, 'nbJ' => $_SESSION['nbJ'], 'nbC' => $_SESSION['nbC']];
    $getInfos->setConfCombat($data);
}
$infos = $getInfos->getInfosCombat();

foreach ($infos as $i) {

    $tabCombat .= '<tr><td>' . $i['player'] . '</td></tr>';
}

require 'view/combats.php';