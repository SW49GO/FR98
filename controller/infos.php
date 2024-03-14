<?php
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}
$perle = '<img class="perle" src="../public/pictures/perle.png">';
$croq = '<img class="croq" src="../public/pictures/croquette.png">';
$perl = '<img class="min" src="../public/pictures/perle.png">';
$cro = '<img class="min" src="../public/pictures/croquette.png">';
require 'view/infos.php';