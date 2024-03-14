<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
$boosts = $getInfos->getBoosts();

require 'view/combo.php';