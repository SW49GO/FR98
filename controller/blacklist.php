<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}
$player_out = '';

$listPlayer = $getInfos->infosSupprPlayers();
if (isset($_SESSION['user'])) {
    $listPlayersSuppr = '<table class="tab_suppr"><tr>
    <th colspan="6">LISTE DES JOUEURS SUPPRIMES</th>
</tr>
<th class="th_title1" >Nom</th>
<th class="th_title2" >Explication</th>
<th class="th_title3">Supprimer par</th>
<th class="th_title3">Profil Conservé</th>
<th class="th_title4">Supprimer</th>
<th class="th_title4">RéIntégrer</th>
<tr></tr>';
    foreach ($listPlayer as $l) {
        if ($l['stay']) {
            $stay = 'OUI';
            $img = '<a href="?page=blacklist&reint=' . $l['name'] . '" title="RéIntégration dans l\'alliance"><img class="icon" src="../public/pictures/valid.png"></a>';
        } else {
            $stay = 'NON';
            $img = '<img class="icon" src="../public/pictures/forbidden.png" title="Profil non conservé">';
        }
        $listPlayersSuppr .= '<tr><td>' . $l['name'] . '</td><td>' . $l['reason'] . '</td><td>' . $l['admin'] . '</td><td>' . $stay . '</td><td><a href="?page=blacklist&def=' . $l['name'] . '" title="Suppression définitive"><img class="icon" src="../public/pictures/unvalid.png"></a></td><td>' . $img . '</td></tr>';
    }
    $listPlayersSuppr .= '</table>';
} else {
    header('location: index.php?page=connexion');
}

if (isset($_GET['suppr']) && isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1) {
    $info = $getInfos->getOnePlayer(htmlspecialchars(trim(intval($_GET['suppr']))));
    $player_out = '<div class="formSuppr"><form method="POST" action="">
    <label style="color:' . $info['grade'] . '">Suppression du Joueur ' . $info['name'] . '</label><label>Laisser une explication :</label><textarea class ="reasonSuppr" name="reasonSuppr"></textarea><p class="p_suppr">Conserver son Profil Joueur dans la Base de Donnée :</p><p>Le joueur n\'apparaitra juste plus dans la liste</p><br>OUI :&emsp;<input class="stayProfil" type="radio" name="stayProfil" value="1">&emsp;NON :&emsp;<input class="outProfil" type="radio" name="stayProfil" value="0"><br><input class="validProfil" type="submit" name="submit" value="Valider"><input class="validProfil" type="submit" name="cancel" value="Annuler">
    </form></div>';

}

// Réintégration du Joueur
if (isset($_GET['reint']) && isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1) {
    //$getInfos->addCombatOnePlayer($info['name'])
    $getInfos->addPlayerDons(htmlspecialchars(trim($_GET['reint'])));
    $getInfos->updateProfilPlayer(htmlspecialchars(trim($_GET['reint'])), 1);
    $getInfos->updatePlayerPartStay(htmlspecialchars(trim($_GET['reint'])), 1);
    $getInfos->updatePlayerConqStay(htmlspecialchars(trim($_GET['reint'])), 1);
    $getInfos->deleteSupprPlayer(htmlspecialchars(trim($_GET['reint'])));
    header('location: index.php?page=blacklist');
    exit;
}
// Suppression définitive du Joueur
if (isset($_GET['def']) && isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1) {
    //$getInfos->supprCombatOnePlayer($info['name']);
    $getInfos->deletePlayerPart(htmlspecialchars(trim($_GET['def'])));
    $getInfos->deletePlayerConq(htmlspecialchars(trim($_GET['def'])));
    $getInfos->deleteByName(htmlspecialchars(trim($_GET['def'])));
    $getInfos->deleteSupprPlayer(htmlspecialchars(trim($_GET['def'])));
    header('location: index.php?page=blacklist');
    exit;
}
if (isset($_POST['cancel'])) {
    header('location: index.php?page=blacklist');
    exit;
}

// Intégration dans la Blacklist après Suppression
// Avec Conservation des infos
if (isset($_POST['submit'])) {
    $player_out = '';
    if (isset($_POST['stayProfil']) && $_POST['stayProfil'] == 1) {
        $getInfos->supprCombatOnePlayer($info['name']);
        $data = ['name' => htmlspecialchars(trim(ucfirst($info['name']))), 'admin' => htmlspecialchars(trim(ucfirst($_SESSION['user']['name']))), 'reason' => htmlspecialchars(trim(ucfirst($_POST['reasonSuppr']))), 'stay' => 1];
        $getInfos->registerSupprPlayer($data);
        $getInfos->updatePlayerPartStay(htmlspecialchars(trim($info['name'])), 0);
        $getInfos->updatePlayerConqStay(htmlspecialchars(trim($info['name'])), 0);
        $getInfos->updateProfilPlayer($info['name'], 0);
        $getInfos->updatePlayerDonsAtt($info['name']);
        header('location: index.php?page=blacklist');
        exit;
    }
    // Sans Conservation des Infos
    if (isset($_POST['stayProfil']) && $_POST['stayProfil'] == 0) {
        $getInfos->supprCombatOnePlayer($info['name']);
        $data = [
            'name' => htmlspecialchars(trim(ucfirst($info['name']))),
            'admin' => htmlspecialchars(trim(ucfirst($_SESSION['user']['name']))),
            'reason' =>
            htmlspecialchars(trim(ucfirst($_POST['reasonSuppr']))),
            'stay' => 0
        ];
        $getInfos->deletePlayerPart(htmlspecialchars(trim($info['name'])));
        $getInfos->deletePlayerConq(htmlspecialchars(trim($info['name'])));
        $getInfos->deletePlayerDonsDef($info['name']);
        $getInfos->registerSupprPlayer($data);
        $getInfos->deletePlayer(htmlspecialchars(trim($info['id'])));
        header('location: index.php?page=blacklist');
        exit;
    }
}



require 'view/blacklist.php';