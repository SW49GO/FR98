<?php
$title = "Combats";
ob_start();
?>
<div class="pageCombats">
    <h1>Partcipation aux Combats de Guerre</h1>
    <?php if (isset($_SESSION['user']['admin']) && !isset($_POST['nbFront']) && !isset($_POST['submitTeam'])): ?>
    <form method="POST" action="">
        <div class="configCombat">
            <h2 style="color:orange">CONFIGURATION</h2><br>
            <select name="nbJour">
                <option value="">Selection Jours</option>
                <option value="1">Jour 1</option>
                <option value="2">Jour 2</option>
                <option value="3">Jour 3</option>
                <option value="4">Jour 4</option>
                <option value="5">Jour 5</option>
            </select>
            <select name="nbFront">
                <option value="">Nombre de Fronts</option>
                <option value="1">1 front</option>
                <option value="2">2 fronts</option>
                <option value="3">3 fronts</option>
                <option value="4">4 fronts</option>
            </select><br>
            <label>Nombre de combats par Joueur</label>
            <input class="nbJ" type="text" name="nbJ">
            <label>Nombre de combats par Champions</label>
            <input class="nbC" type="text" name="nbC"><br>
            <input class="validModif" type="submit" name="submitConf" value="Valider"><br>
        </div>
    </form>
    <?php endif ?>
    <?php if (isset($_POST['nbFront']) && !isset($_POST['submitTeam'])): ?>
    <form method="POST" action="">
        <label style="color:white">Noms des Equipes Adverses</label>
        <?= $nameTeam ?>
            <br>
            <input class="validModif" type="submit" name="submitTeam" value="Valider"><br>
    </form>
    <?php endif ?>
    <div class="playerConfig">
        <table class="tabCombat">
            <tr>
                <th>Joueur</th>
            </tr>
            <?= $tabCombat ?>
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
require 'template.php';