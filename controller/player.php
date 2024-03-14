<?php
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();

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

//Contrôle connexion
if (isset($_SESSION['user'])) {
    $getInfos->updateConnect(htmlspecialchars(trim(intVal($_SESSION['user']['id']))), 1);
}

///Nombre de joueur
$nb = $getInfos->nbPlayers();
//////Liste des joueurs
$playersList = '';
$players = $getInfos->getAllPlayers();

// Tri
if (isset($_GET['crane'])) {
    $players = $getInfos->getAllPlayersByCrane();
}
if (isset($_GET['play'])) {
    $players = $getInfos->getAllPlayers();
}
$base = $tresor = $guerre = $vitesse = $perle = $fonte = $champ = '';
if (isset($_SESSION['user'])) {
    foreach ($players as $p) {
        if ($p['stay']) {
            // Définition du Top Combat
            if ($p['champ'] == 1) {
                $champ = 'checked';
            } else {
                $champ = '';
            }
            if ($p['champ'] == 2) {
                $champB = 'checked';
            } else {
                $champB = '';
            }
            //Définition des images d'insignes
            ///Base
            if ($p['base'] == 1) {
                $base = '<img class="img_ins" src="../public/pictures/base.png" alt="base">';
                $baseI = 'checked';
                $baseC = '';
                if ($p['bh'] == 1) {
                    $bh = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['bhname'] . '" alt="bulle">';
                    $baseH = 'checked';
                } else {
                    $bh = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $baseH = '';
                }
                if ($p['bd'] == 1) {
                    $bd = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['bdname'] . '" alt="bulle">';
                    $baseD = 'checked';
                } else {
                    $bd = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $baseD = '';
                }
                if ($p['bg'] == 1) {
                    $bg = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['bgname'] . '" alt="bulle">';
                    $baseG = 'checked';
                } else {
                    $bg = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $baseG = '';
                }
            } else if ($p['base'] == 0 && $p['bc'] == 0) {
                $base = '<img class="img_ins" src="../public/pictures/baseN.png" alt="base">';
                $bh = $bd = $bg = '';
                $baseI = $baseC = $baseH = $baseD = $baseG = '';
            } else if ($p['base'] == 0 && $p['bc'] == 1) {
                $base = '<img class="img_ins" src="../public/pictures/baseC.png" alt="base">';
                $bh = $bd = $bg = '';
                $baseC = 'checked';
                $baseI = $baseH = $baseD = $baseG = '';
            }
            ///Tresor
            if ($p['tresor'] == 1) {
                $tresor = '<img class="img_ins" src="../public/pictures/tresor.png" alt="tresor">';
                $tresorI = 'checked';
                $tresorC = '';
                if ($p['th'] == 1) {
                    $th = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['thname'] . '"  alt="bulle">';
                    $tresorH = 'checked';
                } else {
                    $th = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $tresorH = '';
                }
                if ($p['td'] == 1) {
                    $td = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['tdname'] . '"  alt="bulle">';
                    $tresorD = 'checked';
                } else {
                    $td = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $tresorD = '';
                }
                if ($p['tg'] == 1) {
                    $tg = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['tgname'] . '" alt="bulle">';
                    $tresorG = 'checked';
                } else {
                    $tg = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $tresorG = '';
                }
            } else if ($p['tresor'] == 0 && $p['tc'] == 0) {
                $tresor = '<img class="img_ins" src="../public/pictures/tresorN.png" alt="tresor">';
                $th = $td = $tg = '';
                $tresorI = $tresorH = $tresorD = $tresorG = $tresorC = '';
            } else if ($p['tresor'] == 0 && $p['tc'] == 1) {
                $tresor = '<img class="img_ins" src="../public/pictures/tresorC.png" alt="tresor">';
                $th = $td = $tg = '';
                $tresorC = 'checked';
                $tresorI = $tresorH = $tresorD = $tresorG = '';
            }
            if ($p['guerre'] == 1) {
                $guerre = '<img class="img_ins" src="../public/pictures/guerre.png" alt="guerre">';
                $guerreI = 'checked';
                $guerreC = '';
                if ($p['gh'] == 1) {
                    $gh = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['ghname'] . '"  alt="bulle">';
                    $guerreH = 'checked';
                } else {
                    $gh = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $guerreH = '';
                }
                if ($p['gd'] == 1) {
                    $gd = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['gdname'] . '"  alt="bulle">';
                    $guerreD = 'checked';
                } else {
                    $gd = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $guerreD = '';
                }
                if ($p['gg'] == 1) {
                    $gg = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['ggname'] . '"  alt="bulle">';
                    $guerreG = 'checked';
                } else {
                    $gg = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $guerreG = '';
                }
            } else if ($p['guerre'] == 0 && $p['gc'] == 0) {
                $guerre = '<img class="img_ins" src="../public/pictures/guerreN.png" alt="guerre">';
                $gh = $gd = $gg = '';
                $guerreI = $guerreH = $guerreG = $guerreD = $guerreC = '';
            } else if ($p['guerre'] == 0 && $p['gc'] == 1) {
                $guerre = '<img class="img_ins" src="../public/pictures/guerreC.png" alt="guerre">';
                $gh = $gd = $gg = '';
                $guerreC = 'checked';
                $guerreI = $guerreH = $guerreG = $guerreD = '';
            }
            ///Vitesse
            if ($p['vitesse'] == 1) {
                $vitesse = '<img class="img_ins" src="../public/pictures/vitesse.png" alt="vitesse">';
                $vitesseI = 'checked';
                $vitesseC = '';
                if ($p['vh'] == 1) {
                    $vh = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['vhname'] . '"  alt="bulle">';
                    $vitesseH = 'checked';
                } else {
                    $vh = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $vitesseH = '';
                }
                if ($p['vd'] == 1) {
                    $vd = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['vdname'] . '"  alt="bulle">';
                    $vitesseD = 'checked';
                } else {
                    $vd = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $vitesseD = '';
                }
                if ($p['vg'] == 1) {
                    $vg = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['vgname'] . '"  alt="bulle">';
                    $vitesseG = 'checked';
                } else {
                    $vg = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $vitesseG = '';
                }
            } else if ($p['vitesse'] == 0 && $p['vc'] == 0) {
                $vitesse = '<img class="img_ins" src="../public/pictures/vitesseN.png" alt="vitesse">';
                $vh = $vd = $vg = '';
                $vitesseH = $vitesseD = $vitesseG = $vitesseC = $vitesseI = '';
            } else if ($p['vitesse'] == 0 && $p['vc'] == 1) {
                $vitesse = '<img class="img_ins" src="../public/pictures/vitesseC.png" alt="vitesse">';
                $vh = $vd = $vg = '';
                $vitesseC = 'checked';
                $vitesseH = $vitesseD = $vitesseG = $vitesseI = '';
            }
            ///Perle
            if ($p['perle'] == 1) {
                $perle = '<img class="img_ins" src="../public/pictures/Iperle.png" alt="perle">';
                $perleI = 'checked';
                $perleC = '';
                if ($p['ph'] == 1) {
                    $ph = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['phname'] . '"  alt="bulle">';
                    $perleH = 'checked';
                } else {
                    $ph = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $perleH = '';
                }
                if ($p['pd'] == 1) {
                    $pd = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['pdname'] . '"  alt="bulle">';
                    $perleD = 'checked';
                } else {
                    $pd = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $perleD = '';
                }
                if ($p['pg'] == 1) {
                    $pg = '<img class="bulle" src="../public/pictures/bvert.png" title="' . $p['pgname'] . '"  alt="bulle">';
                    $perleG = 'checked';
                } else {
                    $pg = '<img class="bulle" src="../public/pictures/brouge.png" alt="bulle">';
                    $perleG = '';
                }
            } else if ($p['perle'] == 0 && $p['pc'] == 0) {
                $perle = '<img class="img_ins" src="../public/pictures/IperleN.png" alt="perle">';
                $ph = $pd = $pg = '';
                $perleI = $perleD = $perleG = $perleC = $perleH = '';
            } else if ($p['perle'] == 0 && $p['pc'] == 1) {
                $perle = '<img class="img_ins" src="../public/pictures/IperleC.png" alt="perle">';
                $ph = $pd = $pg = '';
                $perleC = 'checked';
                $perleI = $perleD = $perleG = $perleH = '';
            }
            ///Insta
            if ($p['insta'] == 1) {
                $insta = '<img class="img_ins" src="../public/pictures/insta.png" alt="insta">';
                $instaI = 'checked';
                $instaC = '';
            } else if ($p['insta'] == 0 && $p['ic'] == 0) {
                $insta = '<img class="img_ins" src="../public/pictures/instaN.png" alt="insta">';
                $ih = $ind = $ig = '';
                $instaI = $instaD = $instaC = $instaH = $instaG = '';
            } else if ($p['insta'] == 0 && $p['ic'] == 1) {
                $insta = '<img class="img_ins" src="../public/pictures/instaC.png" alt="insta">';
                $ih = $ind = $ig = '';
                $instaC = 'checked';
                $instaI = $instaD = $instaH = $instaG = '';
            }
            ///Fonte
            if ($p['fonte'] == 1) {
                $fonte = '<img class="img_ins" src="../public/pictures/fonte.png" alt="fonte">';
                $fonteI = 'checked';
                $fonteC = '';
            } else if ($p['fonte'] == 0 && $p['fc'] == 0) {
                $fonte = '<img class="img_ins" src="../public/pictures/fonteN.png" alt="fonte">';
                $fh = $fd = $fg = '';
                $fonteI = $fonteC = $fonteD = $fonteG = $fonteH = '';
            } else if ($p['fonte'] == 0 && $p['fc'] == 1) {
                $fonte = '<img class="img_ins" src="../public/pictures/fonteC.png" alt="fonte">';
                $fh = $fd = $fg = '';
                $fonteC = 'checked';
                $fonteI = $fonteD = $fonteG = $fonteH = '';
            }

            ////Affichage des Joueurs et Insignes
            $playersList .= '<div class="ins_players" id="' . $p['id'] . '">';
            if ($baseC || $tresorC || $guerreC || $vitesseC || $instaC || $perleC || $fonteC) {
                $playersList .= '<div class="ins_joueur" style="color:' . $p['grade'] . ';width:20%;background-color:rgb(52, 84, 170);border-radius:0px 35px 35px 0px ">' . $p['name'] . '';
            } else {
                $playersList .= '<div class="ins_joueur" style="color:' . $p['grade'] . ';width:20%">' . $p['name'] . '';
            }
            if ($p['champ'] == 1) {
                $playersList .= ' <img style="width:40px" src="../public/pictures/skull-icon.png" alt="skull" title="Top Combats"/>';
            }
            if ($p['champ'] == 2) {
                $playersList .= ' <img style="width:40px" src="../public/pictures/skull-bad.png" alt="skull" title="Top Combats"/>';
            }
            $playersList .= '</div><div class="ins_crane" style="width:15%">' . $p['crane'] . ' %</div>';
            $playersList .= '<div class="ins_base" style="width:15%"> <div class="img_base"><div class="perkHaut">' . $bh . '</div>' . $base . '<div class="perkGauche">' . $bg . '</div><div class="perkDroite">' . $bd . '</div></div></div>';
            $playersList .= '<div class="ins_tresor" style="width:15%"><div class="img_tresor"><div class="perkHaut">' . $th . '</div>' . $tresor . '<div class="perkGauche">' . $tg . '</div>
    <div class="perkDroite">' . $td . '</div>
    </div></div>';
            $playersList .= '<div class="ins_guerre" style="width:15%"><div class="img_guerre"><div class="perkHaut">' . $gh . '</div>' . $guerre . '<div class="perkGauche">' . $gg . '</div>
    <div class="perkDroite">' . $gd . '</div>
    </div></div>';
            $playersList .= '<div class="ins_vitesse" style="width:15%"><div class="img_vitesse"><div class="perkHaut">' . $vh . '</div>' . $vitesse . '<div class="perkGauche">' . $vg . '</div>
    <div class="perkDroite">' . $vd . '</div>
    </div></div>';
            $playersList .= '<div class="ins_perle" style="width:15%"><div class="img_perle"><div class="perkHaut">' . $ph . '</div>' . $perle . '<div class="perkGauche">' . $pg . '</div>
    <div class="perkDroite">' . $pd . '</div>
    </div></div>';
            $playersList .= '<div class="ins_insta" style="width:15%"><div class="img_insta"></div>' . $insta . '</div>';
            $playersList .= '<div class="ins_fonte" style="width:15%"><div class="img_fonte"></div>' . $fonte . '</div>';
            if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
                $playersList .= '<div class="ins_config" style="width:5%"><img style="width:50px;margin-top: 20px" src="../public/pictures/config.png" alt="parametre" title="Modifier Paramètres"/></div>';
            }
            //////////////////

            $playersList .= '<div class="ins_modif_player hidden">';
            $playersList .= '<form id="form_modif" method="POST" action="">
                    <input type="hidden" name="idPlayer" value="' . $p['id'] . '">
                    <div class="ins_infos_player"><h1 class="ins_name" style="color:' . $p['grade'] . '">&emsp;' . $p['name'] . '&ensp;:</h1><label style="color:blue;margin-left:45px">Nouveau Grade :</label><select id="playerNewGrade" name="playerNewGrade">
                            <option value="">Liste Grades</option>
                            <option value="white" style="color:white">Soldat</option>
                            <option value="yellow" style="color:yellow">General</option>
                            <option value="aqua" style="color:aqua">Sergent</option>
                            <option value="red" style="color:red">Chef</option>
                        </select><label style="color:blue;margin-left:45px">Nouveau Bonus Crâne :</label><input type="text" name="newCrane"
                            placeholder="00.0"><div style="font-size:30px;font-weight:bold;margin-top:5px">%</div><label style="color:blue;margin-left:45px">Top Combats <img style="width:20px" src="../public/pictures/skull-icon.png" alt="skull"/> :</label><input type="checkbox" name="topCombats" ' . $champ . '><label style="color:blue;margin-left:45px">Bad <img style="width:20px" src="../public/pictures/skull-bad.png" alt="skull"/> :</label><input type="checkbox" name="badCombats" ' . $champB . '>
                    </div>';
            $playersList .= '<div class="newInsignes">';
            $playersList .= '<div class="newBase">
                                    <h2 style="color:blue">BASE</h2>
                                    <div class="acquis">&emsp;&emsp;<span>Acquis :</span><input type="checkbox" name="base" ' . $baseI . '>&emsp;&emsp;<span>En cours :</span><input type="checkbox" name="baseC" ' . $baseC . '>
                                    </div>
                                    <div class="perks">
                                        <div class="perksHaut"><span>Perk Haut :</span><input type="checkbox" name="baseH"' . $baseH . '><span>&emsp;Intitulé :</span><input type="text" name="baseHTxt" placeholder="' . $p['bhname'] . ' "readonly">
                                        </div>
                                        <div class="perksGauche"><span>Perk Gauche :</span><input type="checkbox" name="baseG"' . $baseG . '><span>&emsp;Intitulé :</span><input type="text" name="baseGTxt" placeholder="' . $p['bgname'] . ' "readonly">
                                        </div>
                                        <div class="perksGDroite"><span>Perk Droite :</span><input type="checkbox" name="baseD"' . $baseD . '><span>&emsp;Intitulé :</span><input type="text" name="baseDTxt" placeholder="' . $p['bdname'] . '">
                                        </div>
                                    </div>
                                </div>';
            $playersList .= '<div class="newTresor">
                                <h2 style="color:green">TRESOR</h2>
                                <div class="acquis">&emsp;&emsp;<span>Acquis :</span><input type="checkbox" name="tresor" ' . $tresorI . '>&emsp;&emsp;<span>En cours :</span><input type="checkbox" name="tresorC" ' . $tresorC . '>
                                </div>
                                <div class="perks">
                                    <div class="perksHaut"><span>Perk Haut :</span><input type="checkbox" name="tresorH"' . $tresorH . '><span>&emsp;Intitulé :</span><input type="text" name="tresorHTxt" placeholder="' . $p['thname'] . ' "readonly">
                                    </div>
                                    <div class="perksGauche"><span>Perk Gauche :</span><input type="checkbox" name="tresorG"' . $tresorG . '><span>&emsp;Intitulé :</span><input type="text" name="tresorGTxt" placeholder="' . $p['tgname'] . ' "readonly">
                                    </div>
                                    <div class="perksDroite"><span>Perk Droite :</span><input type="checkbox" name="tresorD"' . $tresorD . '><span>&emsp;Intitulé :</span><input type="text" name="tresorDTxt" placeholder="' . $p['tdname'] . '">
                                    </div>
                                </div>
                            </div>';
            $playersList .= '<div class="newGuerre">
                                <h2 style="color:red">GUERRE</h2>
                                <div class="acquis">&emsp;&emsp;<span>Acquis :</span><input type="checkbox" name="guerre" ' . $guerreI . '>&emsp;&emsp;<span>En cours :</span><input type="checkbox" name="guerreC" ' . $guerreC . '>
                                </div>
                                <div class="perks">
                                    <div class="perksHaut"><span>Perk Haut :</span><input type="checkbox" name="guerreH"' . $guerreH . '><span>&emsp;Intitulé :</span><input type="text" name="guerreHTxt" placeholder="' . $p['ghname'] . ' "readonly">
                                    </div>
                                    <div class="perksGauche"><span>Perk Gauche :</span><input type="checkbox" name="guerreG"' . $guerreG . '><span>&emsp;Intitulé :</span><input type="text" name="guerreGTxt" placeholder="' . $p['ggname'] . ' "readonly">
                                    </div>
                                    <div class="perksDroite"><span>Perk Droite :</span><input type="checkbox" name="guerreD"' . $guerreD . '><span>&emsp;Intitulé :</span><input type="text" name="guerreDTxt" placeholder="' . $p['gdname'] . '">
                                    </div>
                                </div>
                            </div>';
            $playersList .= '<div class="newVitesse">
                                <h2 style="color:grey">VITESSE</h2>
                                <div class="acquis">&emsp;&emsp;<span>Acquis :</span><input type="checkbox" name="vitesse" ' . $vitesseI . '>&emsp;&emsp;<span>En cours :</span><input type="checkbox" name="vitesseC" ' . $vitesseC . '>
                                </div>
                                <div class="perks">
                                    <div class="perksHaut"><span>Perk Haut :</span><input type="checkbox" name="vitesseH"' . $vitesseH . '><span>&emsp;Intitulé :</span><input type="text" name="vitesseHTxt" placeholder="' . $p['vhname'] . ' "readonly">
                                    </div>
                                    <div class="perksGauche"><span>Perk Gauche :</span><input type="checkbox" name="vitesseG"' . $vitesseG . '><span>&emsp;Intitulé :</span><input type="text" name="vitesseGTxt" placeholder="' . $p['vgname'] . ' " readonly">
                                    </div>
                                    <div class="perksDroite"><span>Perk Droite :</span><input type="checkbox" name="vitesseD"' . $vitesseD . '><span>&emsp;Intitulé :</span><input type="text" name="vitesseDTxt" placeholder="' . $p['vdname'] . '">
                                    </div>
                                </div>
                            </div>';
            $playersList .= '<div class="newPerle">
                                <h2 style="color:purple">PERLE</h2>
                                <div class="acquis">&emsp;&emsp;<span>Acquis :</span><input type="checkbox" name="perle" ' . $perleI . '>&emsp;&emsp;<span>En cours :</span><input type="checkbox" name="perleC" ' . $perleC . '>
                                </div>
                                <div class="perks">
                                    <div class="perksHaut"><span>Perk Haut :</span><input type="checkbox" name="perleH"' . $perleH . '><span>&emsp;Intitulé :</span><input type="text" name="perleHTxt" placeholder="' . $p['phname'] . ' "readonly">
                                    </div>
                                    <div class="perksGauche"><span>Perk Gauche :</span><input type="checkbox" name="perleG"' . $perleG . '><span>&emsp;Intitulé :</span><input type="text" name="perleGTxt" placeholder="' . $p['pgname'] . ' "readonly">
                                    </div>
                                    <div class="perksDroite"><span>Perk Droite :</span><input type="checkbox" name="perleD"' . $perleD . '><span>&emsp;Intitulé :</span><input type="text" name="perleDTxt" placeholder="' . $p['pdname'] . '">
                                    </div>
                                </div>
                            </div>';
            $playersList .= '<div class="newInsta">
                                <h2 style="color:orange">INSTA</h2><br>
                                <div class="acquis">&emsp;&emsp;<span>Acquis :</span><input type="checkbox" name="insta" ' . $instaI . '>&emsp;&emsp;<span>En cours :</span><input type="checkbox" name="instaC" ' . $instaC . '>
                                </div>
                            </div>';
            $playersList .= '<div class="newFonte"><br>
                                <h2 style="color:brown">FONTE</h2>
                                <div class="acquis">&emsp;&emsp;<span>Acquis :</span><input type="checkbox" name="fonte" ' . $fonteI . '>&emsp;&emsp;<span>En cours :</span><input type="checkbox" name="fonteC" ' . $fonteC . '>
                                </div>
                            </div>';
            $playersList .= '</div><div class="btn_modif"><input class="suppr_player" type="submit" name="supprPlayer" value="Supprimer Joueur"><input class="annulerModif" type="submit" name="annulerModif" value="Annuler"><input class="validModif" type="submit" name="validModif" value="Modifier"></div>';
            $playersList .= '</form></div></div>';
        }
    }

    if (isset($_POST['supprPlayer'])) {
        if (isset($_POST['idPlayer'])) {
            $id = $_POST['idPlayer'];
        }
        header('Location: index.php?page=blacklist&suppr=' . $id . '');
        exit;
    }
    if (isset($_POST['annulerModif'])) {
        header('Location: index.php?page=player');
        exit;
    }
    if (isset($_POST['validModif'])) {
        if (isset($_POST['idPlayer'])) {
            $id = $_POST['idPlayer'];
        }
        $Player = $getInfos->getOnePlayer($id);
        $data = array();
        if (isset($_POST['playerNewGrade']) && !empty($_POST['playerNewGrade'])) {
            $data['grade'] = htmlspecialchars(trim($_POST['playerNewGrade']));
            if ($_POST['playerNewGrade'] == 'yellow' || $_POST['playerNewGrade'] == 'red') {
                $data['admin'] = 1;
            } else {
                $data['admin'] = 0;
            }
        } else {
            $data['grade'] = $Player['grade'];
            $data['admin'] = $Player['admin'];
        }
        if (isset($_POST['newCrane']) && !empty($_POST['newCrane'])) {
            $data['crane'] = htmlspecialchars(trim($_POST['newCrane']));
        } else {
            $data['crane'] = $Player['crane'];
        }
        if (isset($_POST['topCombats']) && $_POST['topCombats'] == 'on') {
            $data['champ'] = 1;
        } else if (isset($_POST['badCombats']) && $_POST['badCombats'] == 'on') {
            $data['champ'] = 2;
        } else {
            $data['champ'] = 0;
        }

        ///base
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
            $data['bhname'] = $Player['bhname'];
        } else {
            $data['bhname'] = htmlspecialchars(trim(ucFirst($_POST['baseHTxt'])));
        }
        if (isset($_POST['baseG']) && $_POST['baseG'] == 'on' && (isset($_POST['base']))) {
            $data['bg'] = 1;
        } else {
            $data['bg'] = 0;
        }
        if (isset($_POST['baseGTxt']) && empty($_POST['baseGTxt'])) {
            $data['bgname'] = $Player['bgname'];
        } else {
            $data['bgname'] = htmlspecialchars(trim($_POST['baseGTxt']));
        }
        if (isset($_POST['baseD']) && $_POST['baseD'] == 'on' && (isset($_POST['base']))) {
            $data['bd'] = 1;
        } else {
            $data['bd'] = 0;
        }
        if (isset($_POST['baseDTxt']) && empty($_POST['baseDTxt'])) {
            $data['bdname'] = $Player['bdname'];
        } else {
            $data['bdname'] = htmlspecialchars(trim($_POST['baseDTxt']));
            ;
        }
        ///tresor
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
            $data['thname'] = $Player['thname'];
        } else {
            $data['thname'] = htmlspecialchars(trim($_POST['tresorHTxt']));
        }
        if (isset($_POST['tresorG']) && $_POST['tresorG'] == 'on' && (isset($_POST['tresor']))) {
            $data['tg'] = 1;
        } else {
            $data['tg'] = 0;
        }
        if (isset($_POST['tresorGTxt']) && empty($_POST['tresorGTxt'])) {
            $data['tgname'] = $Player['tgname'];
        } else {
            $data['tgname'] = htmlspecialchars(trim($_POST['tresorGTxt']));
        }
        if (isset($_POST['tresorD']) && $_POST['tresorD'] == 'on' && (isset($_POST['tresor']))) {
            $data['td'] = 1;
        } else {
            $data['td'] = 0;
        }
        if (isset($_POST['tresorDTxt']) && empty($_POST['tresorDTxt'])) {
            $data['tdname'] = $Player['tdname'];
        } else {
            $data['tdname'] = htmlspecialchars(trim($_POST['tresorDTxt']));
        }
        //guerre
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
            $data['ghname'] = $Player['ghname'];
        } else {
            $data['ghname'] = htmlspecialchars(trim($_POST['guerreHTxt']));
        }
        if (isset($_POST['guerreG']) && $_POST['guerreG'] == 'on' && (isset($_POST['guerre']))) {
            $data['gg'] = 1;
        } else {
            $data['gg'] = 0;
        }
        if (isset($_POST['guerreGTxt']) && empty($_POST['guerreGTxt'])) {
            $data['ggname'] = $Player['ggname'];
        } else {
            $data['ggname'] = htmlspecialchars(trim($_POST['guerreGTxt']));
        }
        if (isset($_POST['guerreD']) && $_POST['guerreD'] == 'on' && (isset($_POST['guerre']))) {
            $data['gd'] = 1;
        } else {
            $data['gd'] = 0;
        }
        if (isset($_POST['guerreDTxt']) && empty($_POST['guerreDTxt'])) {
            $data['gdname'] = $Player['gdname'];
        } else {
            $data['gdname'] = htmlspecialchars(trim($_POST['guerreDTxt']));
        }

        //vitesse
        if (isset($_POST['vitesse']) && $_POST['vitesse'] == 'on') {
            $data['vitesse'] = 1;
        } else {
            $data['vitesse'] = 0;
        }
        if (isset($_POST['vitesseC']) && $_POST['vitesseC'] == 'on') {
            $data['vc'] = 1;
        } else {
            $data['vc'] = 0;
        }
        if (isset($_POST['vitesseH']) && $_POST['vitesseH'] == 'on' && (isset($_POST['vitesse']))) {
            $data['vh'] = 1;
        } else {
            $data['vh'] = 0;
        }
        if (isset($_POST['vitesseHTxt']) && empty($_POST['vitesseHTxt'])) {
            $data['vhname'] = $Player['vhname'];
        } else {
            $data['vhname'] = htmlspecialchars(trim($_POST['vitesseHTxt']));
        }
        if (isset($_POST['vitesseG']) && $_POST['vitesseG'] == 'on' && (isset($_POST['vitesse']))) {
            $data['vg'] = 1;
        } else {
            $data['vg'] = 0;
        }
        if (isset($_POST['vitesseGTxt']) && empty($_POST['vitesseGTxt'])) {
            $data['vgname'] = $Player['vgname'];
        } else {
            $data['vgname'] = htmlspecialchars(trim($_POST['vitesseGTxt']));
        }
        if (isset($_POST['vitesseD']) && $_POST['vitesseD'] == 'on' && (isset($_POST['vitesse']))) {
            $data['vd'] = 1;
        } else {
            $data['vd'] = 0;
        }
        if (isset($_POST['vitesseDTxt']) && empty($_POST['vitesseDTxt'])) {
            $data['vdname'] = $Player['vdname'];
        } else {
            $data['vdname'] = htmlspecialchars(trim($_POST['vitesseDTxt']));
        }
        //insta
        if (isset($_POST['insta']) && $_POST['insta'] == 'on') {
            $data['insta'] = 1;
        } else {
            $data['insta'] = 0;
        }
        if (isset($_POST['instaC']) && $_POST['instaC'] == 'on') {
            $data['ic'] = 1;
        } else {
            $data['ic'] = 0;
        }
        //perle
        if (isset($_POST['perle']) && $_POST['perle'] == 'on') {
            $data['perle'] = 1;
        } else {
            $data['perle'] = 0;
        }
        if (isset($_POST['perleC']) && $_POST['perleC'] == 'on') {
            $data['pc'] = 1;
        } else {
            $data['pc'] = 0;
        }
        if (isset($_POST['perleH']) && $_POST['perleH'] == 'on' && (isset($_POST['perle']))) {
            $data['ph'] = 1;
        } else {
            $data['ph'] = 0;
        }
        if (isset($_POST['perleHTxt']) && empty($_POST['perleHTxt'])) {
            $data['phname'] = $Player['phname'];
        } else {
            $data['phname'] = htmlspecialchars(trim($_POST['perleHTxt']));
        }
        if (isset($_POST['perleG']) && $_POST['perleG'] == 'on' && (isset($_POST['perle']))) {
            $data['pg'] = 1;
        } else {
            $data['pg'] = 0;
        }
        if (isset($_POST['perleGTxt']) && empty($_POST['perleGTxt'])) {
            $data['pgname'] = $Player['pgname'];
        } else {
            $data['pgname'] = htmlspecialchars(trim($_POST['perleGTxt']));
        }
        if (isset($_POST['perleD']) && $_POST['perleD'] == 'on' && (isset($_POST['perle']))) {
            $data['pd'] = 1;
        } else {
            $data['pd'] = 0;
        }
        if (isset($_POST['perleDTxt']) && empty($_POST['perleDTxt'])) {
            $data['pdname'] = $Player['pdname'];
        } else {
            $data['pdname'] = htmlspecialchars(trim($_POST['perleDTxt']));
        }
        //fonte
        if (isset($_POST['fonte']) && $_POST['fonte'] == 'on') {
            $data['fonte'] = 1;
        } else {
            $data['fonte'] = 0;
        }
        if (isset($_POST['fonteC']) && $_POST['fonteC'] == 'on') {
            $data['fc'] = 1;
        } else {
            $data['fc'] = 0;
        }
        $data['id'] = htmlspecialchars((trim($id)));
        $getInfos->updatePlayer($data);
        header('Location: index.php?page=player');
        exit;
    }
} else {
    header('location: index.php?page=connexion');
}


require 'view/player.php';