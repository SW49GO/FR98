<?php
$title = "Master";
ob_start();
?>
<div class="swill">
    <fieldset>
        <legend>ADMINISTRATION</legend>
        <a style="color:orange" class="disconnect" href="?deco" title="Connexion">Connexion/Déconnexion :<img
                class="disconnect" src="../public/pictures/power-icon.png" alt="bouton"></a>
        <form method="POST" action="">
            <h2>Sélectionner le joueur auquel appliquer une modification ou mot de passe</h2>
            <select name="select_player" class="select_player_list">
                <option value="">Liste Joueurs</option>
                <?= $select ?>
            </select>
            <label>Nouveau Nom de Joueur</label>
            <input type="text" name="newPseudo">
            <label>Nouveau Mot de Passe</label>
            <input style="margin-bottom:20px" type="password" name="password"><br>
            <input class="validModif" type="submit" name="submit" value="Valider">
        </form>
        <div>
            <?= $playerConnect ?>
        </div>
        </legend>
    </fieldset>
</div>
<div class="footer"></div>
<?php
$content = ob_get_clean();
require 'template.php';