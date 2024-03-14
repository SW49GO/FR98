<?php
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}
$message = '';
if (isset($_FILES['file_excel']) && !empty($_FILES['file_excel'])) {
    $source = $_FILES['file_excel']['tmp_name'];
    $name = $_FILES['file_excel']['name'];
    $dest = 'public/excel/';
    $result = $getInfos->verifyFiles($source, $dest, $name);
    if ($result == false) {
        $message = '<p style="font-size:20px;color:red;margin:15px">Mauvais format de fichier !!</p>';
    }
}
$list = $getInfos->listExcel();
$listExcel = '';
if (isset($_SESSION['user'])) {
    foreach ($list as $l) {
        $listExcel .= '<div class="container_file">';
        if (isset($_SESSION["user"]["admin"]) && $_SESSION["user"]["admin"] == 1) {
            $listExcel .= '<div class="suppr_excel"><img class="dim20" src="../public/pictures/unvalid.png" alt="suppr"></div>';
        }
        $listExcel .= '<div class="eachFile" id="' . $l['id'] . '"><img class="img_ex" src="../public/excel/' . $l['name'] . '"></div></div>';
    }
} else {
    header('location: index.php?page=connexion');
}
require 'view/guerre.php';