<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
$errorMsg = '';
// Message d'erreur de connexion
if (isset($_GET['error'])) {
    $errorMsg = htmlspecialchars(trim($_GET['error']));
}

require 'view/connexion.php';