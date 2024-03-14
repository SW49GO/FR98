<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}

//$playersList = '';
$players = $getInfos->getAllPlayers();
$nb = $getInfos->nbPlayers();
if (isset($_GET['crane'])) {
    $players = $getInfos->getAllPlayersByCrane();
}

if (isset($_GET['play'])) {
    $players = $getInfos->getAllPlayers();
}
if (isset($_SESSION['user'])) {
    /*
    foreach ($players as $p) {
    if ($p['stay']) {
    if ($p['base'] == 1) {
    $base = '<img class="img" src="public/pictures/base.png" alt="image">';
    $perkbase = '<ul>
    <li>H : ' . $p['bhname'] . '</li>
    <li>D : ' . $p['bdname'] . '</li>
    <li>G : ' . $p['bgname'] . '</li>
    </ul>';
    if ($p['bh'] == 1) {
    $bh = '<img class="bulle" src="public/pictures/bvert.png" alt="bulle">';
    } else {
    $bh = '<img class="bulle" src="public/pictures/brouge.png" alt="bulle">';
    }
    if ($p['bd'] == 1) {
    $bd = '<img class="bulle" src="public/pictures/bvert.png" alt="bulle">';
    } else {
    $bd = '<img class="bulle" src="public/pictures/brouge.png" alt="bulle">';
    }
    if ($p['bg'] == 1) {
    $bg = '<img class="bulle" src="public/pictures/bvert.png" alt="bulle">';
    } else {
    $bg = '<img class="bulle" src="public/pictures/brouge.png" alt="bulle">';
    }
    } else if ($p['bc'] == 1) {
    $base = '<img class="img" src="public/pictures/baseC.png" alt="image">';
    $perkbase = '';
    $bh = '';
    $bd = '';
    $bg = '';
    } else {
    $base = '';
    $perkbase = '';
    $bh = '';
    $bd = '';
    $bg = '';
    }
    if ($p['tresor'] == 1) {
    $tresor = '<img class="img" src="public/pictures/tresor.png" alt="image">';
    $perktresor = '<ul>
    <li>H : ' . $p['thname'] . '</li>
    <li>D : ' . $p['tdname'] . '</li>
    <li>G : ' . $p['tgname'] . '</li>
    </ul>';
    if ($p['th'] == 1) {
    $th = '<img class="bulle" src="public/pictures/bvert.png" alt="bulle">';
    } else {
    $th = '<img class="bulle" src="public/pictures/brouge.png" alt="bulle">';
    }
    if ($p['td'] == 1) {
    $td = '<img class="bulle" src="public/pictures/bvert.png" alt="bulle">';
    } else {
    $td = '<img class="bulle" src="public/pictures/brouge.png" alt="bulle">';
    }
    if ($p['tg'] == 1) {
    $tg = '<img class="bulle" src="public/pictures/bvert.png" alt="bulle">';
    } else {
    $tg = '<img class="bulle" src="public/pictures/brouge.png" alt="bulle">';
    }
    } else if ($p['tc'] == 1) {
    $tresor = '<img class="img" src="public/pictures/tresorC.png" alt="image">';
    $perktresor = '';
    $th = '';
    $td = '';
    $tg = '';
    } else {
    $tresor = '';
    $perktresor = '';
    $th = '';
    $td = '';
    $tg = '';
    }
    if ($p['guerre'] == 1) {
    $guerre = '<img class="img" src="public/pictures/guerre.png" alt="image">';
    $perkguerre = '<ul>
    <li>H : ' . $p['ghname'] . '</li>
    <li>G : ' . $p['ggname'] . '</li>
    <li>D : ' . $p['gdname'] . '</li>
    </ul>';
    if ($p['gh'] == 1) {
    $gh = '<img class="bulle" src="public/pictures/bvert.png" alt="bulle">';
    } else {
    $gh = '<img class="bulle" src="public/pictures/brouge.png" alt="bulle">';
    }
    if ($p['gd'] == 1) {
    $gd = '<img class="bulle" src="public/pictures/bvert.png" alt="bulle">';
    } else {
    $gd = '<img class="bulle" src="public/pictures/brouge.png" alt="bulle">';
    }
    if ($p['gg'] == 1) {
    $gg = '<img class="bulle" src="public/pictures/bvert.png" alt="bulle">';
    } else {
    $gg = '<img class="bulle" src="public/pictures/brouge.png" alt="bulle">';
    }
    } else if ($p['gc'] == 1) {
    $guerre = '<img class="img" src="public/pictures/guerreC.png" alt="image">';
    $perkguerre = '';
    $gh = '';
    $gd = '';
    $gg = '';
    } else {
    $guerre = '';
    $perkguerre = '';
    $gh = '';
    $gd = '';
    $gg = '';
    }
    
    $playersList .= '<div class="players">';
    if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1) {
    $playersList .= '<div class="joueur" ><a style="color:' . $p['grade'] . '"href="?page=administration&modif=' . $p['id'] . '">' . $p['name'] . '</a></div>';
    } else {
    $playersList .= '<div class="joueur" style="color:' . $p['grade'] . '">' . $p['name'] . '</div>';
    }
    $playersList .= '<div class="crane">' . $p['crane'] . ' %</div><div class="dons" ><a href="?page=home&moins=' . $p['id'] . '" class="moins"><sup>&ndash;</sup></a><div class="nbDons">' . $p['dons'] . '</div><a href="?page=home&plus=' . $p['id'] . '" class="plus">+</a></div><div class="base"><div class="perkHaut">' . $bh . '</div>' . $base . '<div class="perkGauche">' . $bg . '</div><div class="perkDroite">' . $bd . '</div></div><div class="perkListB">' . $perkbase . '</div><div class="tresor"><div class="perkHaut">' . $th . '</div>' . $tresor . '<div class="perkGauche">' . $tg . '</div>
    <div class="perkDroite">' . $td . '</div>
    </div>
    <div class="perkListT">' . $perktresor . '</div><div class="guerre"><div class="perkHaut">' . $gh . '</div>' . $guerre . '<div class="perkGauche">' . $gg . '</div>
    <div class="perkDroite">' . $gd . '</div>
    </div><div class="perkListG">' . $perkguerre . '</div></div>';
    
    }
    
    }
    */
} else {
    header('location: index.php?page=connexion');
}


require 'view/home.php';