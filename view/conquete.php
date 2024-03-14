<?php
$title = "Conquête";
ob_start();
?>
<h1>Participation Conquêtes du 17/11/2022</h1>
<div class="conquete">

    <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['name'] == 'Swillisss'): ?>
    <fieldset>
        <legend>ADMINISTRATION</legend>
        <form method="POST" action="">
            <label>Effacer les données de la Conquête Précédente</label>
            <input class="validModif" type="submit" name="effaceConq" value="EFFACER">
        </form>
        <form method="POST" action="">
            <label>Date de la Conquête</label>
            <label>
                <?= date('d /m/Y') ?>
            </label>
            <input class="validModif" type="submit" name="dateConq" value="ENREGISTRER">
        </form>
        <form method="POST" action="">
            <label>Effacer un joueur de la liste</label>
            <select name="select_player" class="select_player_list">
                <option value="">Liste Joueurs</option>
                <?= $select ?>
            </select>
            <input class="validModif" type="submit" name="suppr" value="Effacer">
        </form>
        </legend>
    </fieldset>
    <?php endif ?>

    <div class="conqTab">
        <table class="tabConq">
            <tr>
                <th style="background-color:rgb(222, 215, 0);color:brown" colspan="3">CONQUETE du : <?= $dt ?>
                </th>
            </tr>
            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['name'] == 'Swillisss'): ?>
            <tr>
                <th colspan="3">Equipes : <form method="POST" action=""><input class="adversaire" type="text"
                            name="adversaire"></form>
                </th>
            </tr>
            <tr>
                <th colspan="3">Points : <form method="POST" action=""><input class="adversaire" type="text"
                            name="points">
                    </form>
                </th>
            </tr>
            <?php endif ?>
            <tr>
                <?php if (isset($_SESSION['adver'])): ?>
                <td colspan="3">Equipes :
                    <?= $_SESSION['adver'] ?>
                </td>
                <?php endif ?>
            </tr>
            <tr>
                <?php if (isset($_SESSION['point'])): ?>
                <td colspan="3">Points :
                    <?= $_SESSION['point'] ?>
                </td>
                <?php endif ?>
            </tr>
            <tr>
                <th style="background-color:rgb(222, 215, 0);color:brown">JOUEUR</th>
                <th style="background-color:rgb(222, 215, 0);color:brown"><img style="width:20px"
                        src="../public/pictures/minicrane.png">&ensp;CRANES&ensp;<img style="width:20px"
                        src="../public/pictures/minicrane.png"></th>
                <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['name'] == 'Swillisss'): ?>
                <th style="background-color:rgb(222, 215, 0);color:brown">Nouveau Points Crâne</th>
                <?php endif ?>
            </tr>
            <?= $tabConq ?>
        </table>
    </div>
</div>
<div class="footer"></div>

<?php
$content = ob_get_clean();
require 'template.php';