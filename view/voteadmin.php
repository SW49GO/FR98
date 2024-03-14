<?php
$title = "Vote Boosts";
ob_start();
?>
<div class="pageVote">
    <h1>Vote Boosts de Guerre</h1>
    <h2 style="color:white; margin-bottom:20px">Selectionner les 12 Boosts de cette Guerre</h2>
    <div>
        <form method="POST" action="">
            <label style="color:orange">Réinitialisation des Boosts</label>
            <input class="validModif" type="submit" name="newWar" value="Annuler Les Votes">
        </form>
    </div>
    <div class="boosts">
        <form method="POST" action="">
            <div class="adminBoost">
                <div class="selectBoost">
                    <?php foreach ($boosts as $b): ?>
                    <div class="imgBoost">
                        <div><img class="cardBoost" src="../public/boosts/<?= $b['name'] ?>" title="<?= $b['title'] ?>">
                        </div>

                        <?php if ($b['active'] == 1) {
                            $checked = 'checked';
                        } else {
                            $checked = '';
                        } ?>
                        <input class="checkBoostPlayer" type="checkbox" name="check[]" value="<?= $b['id'] ?>" <?=
                            $checked ?>>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="btn_boots">
                <div style="color:white">
                    <p style="font-size:20px">Nombre de boosts séléctionnés :&emsp;<span class="choice">
                            <?= $active ?>
                        </span>/12<span class="spanValid"></p>
                    <br>
                </div>
                <span style="color:white">Nombre de Votes autorisés par Joueur :</span>
                <input id="nbVote" type="text" name="nbVote" placeholder="<?= $nb ?>">
                <br><br>
                <div class="boostFinal hidden">
                    <p style="color:white">CLOTURER DEFINITEMEVENT, CHOIX + NOMBRE DE CHOIX</p><br>
                    <input type="submit" class="validModif" name="valid" value="Valider">
                    <input type="submit" class="validModif" name="cancel" value="Annuler">
                </div>
            </div>
        </form>
    </div>
    <div class="footer"></div>
    <?php
    $content = ob_get_clean();
    require 'template.php';