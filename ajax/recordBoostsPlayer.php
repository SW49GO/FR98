<?php
session_start();
require_once '../config/config.php';
require_once '../model/GetInfos.php';
$getInfos = new GetInfos();

if (isset($_POST['boostP'])) {
    $nb = $getInfos->nbBoostForPlayer();
    // Récup de l'ID du boost
    $result = $_POST['boostP'];
    $result = json_decode($result, true);

    foreach ($result as $key => $value) {

        //1er choix
        if (!isset($tab['choix'])) {
            $tab['choix'][] = ['id', $value['id']];
            $getInfos->updateVotant($_SESSION['player'], $_POST['boostP']);
            $pts = $getInfos->infosBoosts(htmlspecialchars(trim(intVal($value['id']))));
            // Valeur du 1er choix
            $res = intval($pts['pts']);
        } else if (isset($tab['choix']) && count($tab['choix'])) {

            if (count($tab['choix']) <= $nb['nb']) {
                $np = count($tab['choix']);
                $tab['choix'][] = ['id', $value['id']];
                $getInfos->updateVotant($_SESSION['player'], $_POST['boostP']);
                // Valeur Points du boost sélectionner (en + ou en -)
                $infos = $getInfos->infosBoosts(htmlspecialchars(trim(intVal($value['id']))));
                $res = $res + intval($infos['pts']);
            }
        } else {
            $tab['choix'] = '';
        }
    }

    if (isset($res)) {
        echo $res;
    } else {
        echo 0;
    }

}