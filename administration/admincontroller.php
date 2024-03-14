<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}

$select = '';
$select = $getInfos->getSelect();

$modifPlayer = '';
try {
    if (isset($_POST['user']) && isset($_POST['pwd'])) {
        $result = $getInfos->verifyAccount(htmlspecialchars(trim($_POST['user'])), htmlspecialchars(trim($_POST['pwd'])));
        if (!isset($result)) {
            throw new Exception("Identifiants Incorrects");
        } else {
            $_SESSION['user'] = $result;
            $getInfos->updateConnect(trim(intVal($_SESSION['user']['id'])), 1);
        }
    }
} catch (Exception $e) {
    $errorMsg = $e->getMessage();
    header('Location: index.php?page=connexion&error=' . $errorMsg);
    exit();
}

if (isset($_POST['modif_player']) || isset($_GET['modif'])) {
    if (isset($_POST['select_player']) && !empty($_POST['select_player']) || isset($_GET['modif'])) {
        if (isset($_GET['modif'])) {
            $_SESSION['id_player'] = htmlspecialchars(trim(intVal($_GET['modif'])));
            $onePlayer = $getInfos->getOnePlayer(htmlspecialchars(trim(intVal($_GET['modif']))));
        } else {
            $_SESSION['id_player'] = intVal($_POST['select_player']);
            $onePlayer = $getInfos->getOnePlayer(htmlspecialchars(trim(intVal($_POST['select_player']))));
        }

        if ($onePlayer['base'] == 1) {
            $base = 'checked';
        } else {
            $base = '';
        }
        if ($onePlayer['bc'] == 1) {
            $baseC = 'checked';
        } else {
            $baseC = '';
        }
        if ($onePlayer['bh'] == 1) {
            $baseH = 'checked';
        } else {
            $baseH = '';
        }
        if ($onePlayer['bg'] == 1) {
            $baseG = 'checked';
        } else {
            $baseG = '';
        }
        if ($onePlayer['bd'] == 1) {
            $baseD = 'checked';
        } else {
            $baseD = '';
        }
        if ($onePlayer['tresor'] == 1) {
            $tresor = 'checked';
        } else {
            $tresor = '';
        }
        if ($onePlayer['tc'] == 1) {
            $tresorC = 'checked';
        } else {
            $tresorC = '';
        }
        if ($onePlayer['th'] == 1) {
            $tresorH = 'checked';
        } else {
            $tresorH = '';
        }
        if ($onePlayer['tg'] == 1) {
            $tresorG = 'checked';
        } else {
            $tresorG = '';
        }
        if ($onePlayer['td'] == 1) {
            $tresorD = 'checked';
        } else {
            $tresorD = '';
        }
        if ($onePlayer['guerre'] == 1) {
            $guerre = 'checked';
        } else {
            $guerre = '';
        }
        if ($onePlayer['gc'] == 1) {
            $guerreC = 'checked';
        } else {
            $guerreC = '';
        }
        if ($onePlayer['gh'] == 1) {
            $guerreH = 'checked';
        } else {
            $guerreH = '';
        }
        if ($onePlayer['gg'] == 1) {
            $guerreG = 'checked';
        } else {
            $guerreG = '';
        }
        if ($onePlayer['gd'] == 1) {
            $guerreD = 'checked';
        } else {
            $guerreD = '';
        }

        $modifPlayer = '<form id="form_modif" method="POST" action=""><div class="infos"><h1 style="color:' . $onePlayer['grade'] . '">&emsp;' . $onePlayer['name'] . '</h1><div class="infos_player"><label>Nouveau Grade :</label><select id="playerNewGrade" name="playerNewGrade"><option value="">Liste Grades</option><option value="white" style="color:white">Soldat</option><option value="yellow" style="color:yellow">General</option><option value="aqua" style="color:aqua">Sergent</option><option value="orange" style="color:orange">Chef</option></select><label>Nouveau Bonus Crâne :</label><input type="text" name="newCrane" placeholder="' . $onePlayer['crane'] . '"><span>&emsp;%</span></div><div class="newInsignes"><div class="newBase"><h2 style="color:blue">BASE</h2><div class="acquis">&emsp;&emsp;<span>Acquis :</span><input type="checkbox" name="base" ' . $base . '>&emsp;&emsp;<span>En cours :</span><input type="checkbox" name="baseC" ' . $baseC . '></div><div class="perks"><div class="perksHaut"><span>Perk Haut :</span><input type="checkbox" name="baseH"' . $baseH . '><span>&emsp;Intitulé :</span><input type="text" name="baseHTxt" placeholder="' . $onePlayer['bhname'] . '"></div><div class="perksGauche"><span>Perk Gauche :</span><input type="checkbox" name="baseG"' . $baseG . '><span>&emsp;Intitulé :</span><input type="text" name="baseGTxt" placeholder="' . $onePlayer['bgname'] . '"></div><div class="perksGDroite"><span>Perk Droite :</span><input type="checkbox" name="baseD"' . $baseD . '><span>&emsp;Intitulé :</span><input type="text" name="baseDTxt" placeholder="' . $onePlayer['bdname'] . '"></div></div></div><div class="newTresor"><h2 style="color:green">TRESOR</h2><div class="acquis">&emsp;&emsp;<span>Acquis :</span><input type="checkbox" name="tresor" ' . $tresor . '>&emsp;&emsp;<span>En cours :</span><input type="checkbox" name="tresorC" ' . $tresorC . '></div><div class="perks"><div class="perksHaut"><span>Perk Haut :</span><input type="checkbox" name="tresorH"' . $tresorH . '><span>&emsp;Intitulé :</span><input type="text" name="tresorHTxt" placeholder="' . $onePlayer['thname'] . '"></div><div class="perksGauche"><span>Perk Gauche :</span><input type="checkbox" name="tresorG"' . $tresorG . '><span>&emsp;Intitulé :</span><input type="text" name="tresorGTxt" placeholder="' . $onePlayer['tgname'] . '"></div><div class="perksDroite"><span>Perk Droite :</span><input type="checkbox" name="tresorD"' . $tresorD . '><span>&emsp;Intitulé :</span><input type="text" name="tresorDTxt" placeholder="' . $onePlayer['tdname'] . '"></div></div>
</div>
<div class="newGuerre">
    <h2 style="color:red">GUERRE</h2><div class="acquis">&emsp;&emsp;<span>Acquis :</span><input type="checkbox" name="guerre" ' . $guerre . '>&emsp;&emsp;<span>En cours :</span><input type="checkbox" name="guerreC" ' . $guerreC . '></div><div class="perks"><div class="perksHaut"><span>Perk Haut :</span><input type="checkbox" name="guerreH"' . $guerreH . '><span>&emsp;Intitulé :</span><input type="text" name="guerreHTxt" placeholder="' . $onePlayer['ghname'] . '"></div><div class="perksGauche"><span>Perk Gauche :</span><input type="checkbox" name="guerreG"' . $guerreG . '><span>&emsp;Intitulé :</span><input type="text" name="guerreGTxt" placeholder="' . $onePlayer['ggname'] . '"></div><div class="perksDroite"><span>Perk Droite :</span><input type="checkbox" name="guerreD"' . $guerreD . '><span>&emsp;Intitulé :</span><input type="text" name="guerreDTxt" placeholder="' . $onePlayer['gdname'] . '"></div></div>
</div>
</div><div class="btn_modif"><input class="suppr_player" type="submit" name="supprPlayer" value="Supprimer Joueur"><input class="annulerModif" type="submit" name="annulerModif" value="Annuler"><input class="validModif" type="submit" name="validModif" value="Valider"></div></div>
</form>';
    }
}
if (isset($_POST['supprPlayer'])) {
    header('Location: index.php?page=blacklist&suppr');
    exit;
}
if (isset($_POST['annulerModif'])) {
    header('Location: index.php?page=administration');
    exit;
}
if (isset($_POST['validModif'])) {
    $onePlayer = $getInfos->getOnePlayer($_SESSION['id_player']);
    $data = array();
    if (isset($_POST['playerNewGrade']) && !empty($_POST['playerNewGrade'])) {
        $data['grade'] = htmlspecialchars(trim($_POST['playerNewGrade']));
    } else {
        $data['grade'] = $onePlayer['grade'];
    }
    if (isset($_POST['newCrane']) && !empty($_POST['newCrane'])) {
        $data['crane'] = htmlspecialchars(trim($_POST['newCrane']));
    } else {
        $data['crane'] = $onePlayer['crane'];
    }
    if (isset($_POST['base']) && $_POST['base'] == 'on') {
        $data['base'] = 1;
    } else {
        $data['base'] = 0;
    }
    if (isset($_POST['baseC']) && $_POST['baseC'] == 'on') {
        $data['bc'] = 1;
    } else {
        $data['bc'] = 0;
    }
    if (isset($_POST['baseH']) && $_POST['baseH'] == 'on' && (isset($_POST['base']))) {
        $data['bh'] = 1;
    } else {
        $data['bh'] = 0;
    }
    if (isset($_POST['baseHTxt']) && empty($_POST['baseHTxt'])) {
        $data['bhname'] = $onePlayer['bhname'];
    } else {
        $data['bhname'] = htmlspecialchars(trim(ucFirst($_POST['baseHTxt'])));
    }
    if (isset($_POST['baseG']) && $_POST['baseG'] == 'on' && (isset($_POST['base']))) {
        $data['bg'] = 1;
    } else {
        $data['bg'] = 0;
    }
    if (isset($_POST['baseGTxt']) && empty($_POST['baseGTxt'])) {
        $data['bgname'] = $onePlayer['bgname'];
    } else {
        $data['bgname'] = htmlspecialchars(trim($_POST['baseGTxt']));
    }
    if (isset($_POST['baseD']) && $_POST['baseD'] == 'on' && (isset($_POST['base']))) {
        $data['bd'] = 1;
    } else {
        $data['bd'] = 0;
    }
    if (isset($_POST['baseDTxt']) && empty($_POST['baseDTxt'])) {
        $data['bdname'] = $onePlayer['bdname'];
    } else {
        $data['bdname'] = htmlspecialchars(trim($_POST['baseDTxt']));
        ;
    }


    if (isset($_POST['tresor']) && $_POST['tresor'] == 'on') {
        $data['tresor'] = 1;
    } else {
        $data['tresor'] = 0;
    }
    if (isset($_POST['tresorC']) && $_POST['tresorC'] == 'on') {
        $data['tc'] = 1;
    } else {
        $data['tc'] = 0;
    }
    if (isset($_POST['tresorH']) && $_POST['tresorH'] == 'on' && (isset($_POST['tresor']))) {
        $data['th'] = 1;
    } else {
        $data['th'] = 0;
    }
    if (isset($_POST['tresorHTxt']) && empty($_POST['tresorHTxt'])) {
        $data['thname'] = $onePlayer['thname'];
    } else {
        $data['thname'] = htmlspecialchars(trim($_POST['tresorHTxt']));
    }
    if (isset($_POST['tresorG']) && $_POST['tresorG'] == 'on' && (isset($_POST['tresor']))) {
        $data['tg'] = 1;
    } else {
        $data['tg'] = 0;
    }
    if (isset($_POST['tresorGTxt']) && empty($_POST['tresorGTxt'])) {
        $data['tgname'] = $onePlayer['tgname'];
    } else {
        $data['tgname'] = htmlspecialchars(trim($_POST['tresorGTxt']));
    }
    if (isset($_POST['tresorD']) && $_POST['tresorD'] == 'on' && (isset($_POST['tresor']))) {
        $data['td'] = 1;
    } else {
        $data['td'] = 0;
    }
    if (isset($_POST['tresorDTxt']) && empty($_POST['tresorDTxt'])) {
        $data['tdname'] = $onePlayer['tdname'];
    } else {
        $data['tdname'] = htmlspecialchars(trim($_POST['tresorDTxt']));
    }


    if (isset($_POST['guerre']) && $_POST['guerre'] == 'on') {
        $data['guerre'] = 1;
    } else {
        $data['guerre'] = 0;
    }
    if (isset($_POST['guerreC']) && $_POST['guerreC'] == 'on') {
        $data['gc'] = 1;
    } else {
        $data['gc'] = 0;
    }
    if (isset($_POST['guerreH']) && $_POST['guerreH'] == 'on' && (isset($_POST['guerre']))) {
        $data['gh'] = 1;
    } else {
        $data['gh'] = 0;
    }
    if (isset($_POST['guerreHTxt']) && empty($_POST['guerreHTxt'])) {
        $data['ghname'] = $onePlayer['ghname'];
    } else {
        $data['ghname'] = htmlspecialchars(trim($_POST['guerreHTxt']));
    }
    if (isset($_POST['guerreG']) && $_POST['guerreG'] == 'on' && (isset($_POST['guerre']))) {
        $data['gg'] = 1;
    } else {
        $data['gg'] = 0;
    }
    if (isset($_POST['guerreGTxt']) && empty($_POST['guerreGTxt'])) {
        $data['ggname'] = $onePlayer['ggname'];
    } else {
        $data['ggname'] = htmlspecialchars(trim($_POST['guerreGTxt']));
    }
    if (isset($_POST['guerreD']) && $_POST['guerreD'] == 'on' && (isset($_POST['guerre']))) {
        $data['gd'] = 1;
    } else {
        $data['gd'] = 0;
    }
    if (isset($_POST['guerreDTxt']) && empty($_POST['guerreDTxt'])) {
        $data['gdname'] = $onePlayer['gdname'];
    } else {
        $data['gdname'] = htmlspecialchars(trim($_POST['guerreDTxt']));
    }
    $data['id'] = htmlspecialchars((trim($_SESSION['id_player'])));
    $getInfos->updatePlayer($data);
    header('Location: index.php?page=administration');
    exit;
}

require 'view/administration.php';