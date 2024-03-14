<?php
$title = "Vote Boosts";
ob_start();
?>
<?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1 && ($_SESSION['user']['name'] == 'Swillisss' || $_SESSION['user']['name'] == 'Axelle34')): ?>
    <fieldset>
        <legend>ADMINISTRATION</legend>
        <div class="adminVoteSuppr">
            <form method="POST" action="">
                <label style="color:white">Supprimer le vote d'un Joueur :</label>
                <select name="player">
                    <option value="">Liste des votants</option>
                    <?= $select ?>
                </select>&emsp;
                <input class="validModif" type="submit" name="submitSuppr" Value="Supprimer"><br>
                <?php if ($startAdmin == '0'): ?>
                    <input class="validModif" type="submit" name="startAdmin" Value="Ouvrir le vote">
                    <?php else: ?>
                    <input class="validModif" type="submit" name="closeAdmin" Value="Fermer le vote">
                    <?php endif ?>
            </form>
        </div>
    </fieldset>
<?php endif ?>

<a style="color:orange" class="disconnect" href="?deco" title="Connexion">Connexion/Déconnexion :<img class="disconnect"
        src="../public/pictures/power-icon.png" alt="bouton"></a>

<div class="divBoostsP">
    <?php if (!isset($_POST['pseudo'])): ?>
        <div class="boostTeam">
            <?php foreach ($nbBoost as $b): ?>
                <div class="statBoost">
                    <div class="imgBoostTeam">
                        <img class="cardBoost" src="../public/boosts/<?= $b['name'] ?>" title="<?= $b['title'] ?>">
                    </div>
                    <div style="color:white; margin-bottom: 5px;">
                        <?= $b['selected'] ?>
                    </div>
                </div>
                <?php endforeach ?>
        </div>
        <h2>Nombre de Personnes voulant concerver les Potions : <?= $potion ?> / <?= $nombVote ?></h2>
        <?php if ($startAdmin == '1'): ?>
            <?php if (!isset($_SESSION['user'])): ?>
                <form method="POST" action="">
                    <h1 style="color:white">ENTRER VOTRE PSEUDO (Enter a nickname) :
                    </h1>
                    <input class="pseudoPlayer" type="text" name="pseudo"><br>
                    <P style="color:white;font-size:30px">GARDER LES POTIONS pour la prochaine Guerre :
                        <input type="checkbox" name="potion">
                    </P><br>
                    <input class="validModif" type="submit" name="validPseudo" value="OK">
                    <div class="votant">
                        <?= $listVotant ?>
                    </div>
                </form>
                <?php endif ?>
            <?php else: ?>
            <div class="finVote">Votes Cloturés 😉</div>
            <div class="votant">
                <?= $listVotant ?>
            </div>
            <?php endif ?>
        <?php endif ?>
    <?php if (isset($_POST['pseudo']) || isset($_SESSION['user'])): ?>
        <?php if (isset($_SESSION['user']) && $startAdmin == '1'): ?>
            <form method="POST" action="">
                <label>LANCER le VOTE</label>
                <P style="color:white;font-size:30px"> ou GARDER LES POTIONS pour la prochaine Guerre :
                    <input type="checkbox" name="potion">
                </P><br>
                <input class="validModif" type="submit" name="startVote" value="C'est parti !!">
            </form>
            <?php endif ?>
        <?php if (!isset($_POST['potion'])): ?>
            <?php if (isset($_POST['startVote']) || isset($_POST['pseudo'])): ?>
                <form method="POST" action="">
                    <h1 style="color:white">NOMBRE DE BOOSTS AUTORISES (Number of boosts allowed) :&emsp;<?= $nb ?>
                    </h1>
                    <div class="adminBoost">
                        <div class="selectBoost">
                            <?php foreach ($nbBoost as $b): ?>
                                <div class="imgBoost">
                                    <div><img class="cardBoost" src="../public/boosts/<?= $b['name'] ?>" title="<?= $b['title'] ?>">
                                    </div>
                                    <input class="checkboxP" type="checkbox" name="check[]" value="<?= $b['id'] ?>">
                                </div>
                                <?php endforeach ?>
                        </div>
                    </div>
                    <div class="btn_boots">
                        <p style="font-size:20px; color:white;">Nombre de boosts séléctionnés :&emsp;<span class="choiceP">0</span>/
                            <?= $nb ?>
                            <span class="spanValidP"></span>
                        </p>
                        <br>
                    </div>
                    <?php if (!isset($_SESSION['user'])): ?>
                        <input class="validModif hidden" id="validVote" type="submit" name="playerBoost" value="OK"><br>
                        <?php endif ?>
                    <?php if (isset($_SESSION['user'])): ?>
                        <p style="color:orange;font-size:30px">Re-sélectionner les boosts pour changer votre vote 😉</p>
                        <input class="validModif hidden" id="validVote" type="submit" name="playerBoost" value="OK"><br>
                        <?php endif ?>
                    <?php endif ?>
                <?php if ($startAdmin == '1'): ?>
                    <div class="votant">
                        <?= $listVotant ?>
                    </div>
                    <?php endif ?>
                <div class="footer"></div>
            </form>
            <?php endif ?>
        <?php endif ?>
</div>
<?php
$content = ob_get_clean();
require 'template.php';