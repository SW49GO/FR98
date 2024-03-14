<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
$list = $getInfos->listRegles();
$listComment = '';
$nb = count($list) + 1;
if (count($list)) {
    $nb = count($list) + 1;
}
$compt = "1";

foreach ($list as $l) {
    $listComment .= '<div class="containerRegle" id ="' . $l['id'] . '"><h4 class="titleRegle">Règle N° : ' . $compt . '</h4>';
    if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
        $listComment .= '<div class="toolRegle"><input class="supprRegle" type="button" title="Supprimer"><input class="modifyRegle" type="button" title="Modifier"></div><span style="color:white">[' . $l['author'] . ']</span>';
    }
    $listComment .= '<div class="commentRegles"><p>' . nl2br($l['comment']) . '</p></div></div>';
    $compt++;
}

require 'view/regles.php';