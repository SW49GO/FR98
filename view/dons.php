<?php
$title = "Dons";
ob_start();
?>
<div class="page_dons">

    <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
    <a class="disconnect" href="?deco" title="Déconnexion"><img class="disconnect"
            src="../public/pictures/power-icon.png" alt="bouton"></a>
    <!--
    <fieldset>
        <legend>ADMINISTRATION</legend>        
        <div class="adminDons">
            <form method="POST" action="">
                <label>Stockage des dons de Guerre (Anicen + Nouveau) et Remise à 0 pour le prochain Insigne</label>
                <input style="background-color:rgb(49,49,49)" class="validModif" type="submit" name="transfert"
                    value="Vider">
            </form>
        </div>
        </legend>
    </fieldset>
    -->
    <!--
    <fieldset>
        <legend>ADMINISTRATION</legend>
        <form method="POST" action="">
            <label>Sélectionner le Joueur qui reçoit les dons pour l'insigne de Guerre</label>
            <label>Pour ne pas l'intégrer à sa moyenne Total de Dons aux autres</label>
            <select name="select_player" class="select_player_list">
                <option value="">Liste Joueurs</option>
                <= $select ?>
            </select>
            <input class="validModif" type="submit" name="player" value="Valider">
        </form>
        <br>
        </legend>
    </fieldset>
    -->
    <?php endif ?>

    <h1>Récapitulatif des dons</h1>
    <table class="tab_dons">
        <col style="background-color:grey" />
        <col style="background-color:yellow" />
        <col style="background-color:yellow" />
        <col style="background-color:rgb(72, 120, 191)" />
        <col style="background-color:rgb(72, 120, 191)" />
        <col style="background-color:green" />
        <col style="background-color:green" />
        <col style="background-color:purple" />
        <col style="background-color:purple" />
        <col style="background-color:red" />
        <col style="background-color:red" />
        <col style="background-color:grey" />
        <col style="background-color:grey" />
        <col style="background-color:orange" />
        <col style="background-color:orange" />
        <col style="background-color:brown" />
        <col style="background-color:brown" />
        <tr>
            <th>
                <a style="color:black" href="?page=dons&joueur">Joueur</a>
            </th>
            <th><a style="color:black" href="?page=dons&participation">Participation</a></th>
            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
            <th>+/-</th>
            <?php endif ?>
            <th>Base</th>
            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
            <th>+/-</th>
            <?php endif ?>
            <th>Trésor</th>
            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
            <th>+/-</th>
            <?php endif ?>
            <th>Perle</th>
            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
            <th>+/-</th>
            <?php endif ?>
            <!--<th>Total Diams</th>-->
            <th>
                <a style="color:black" href="?page=dons&guerre">
                    <p>Guerre&emsp;<img style="width:20px" src="../public/pictures/diams.png" alt="diams"></p>
                </a>
            </th>
            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
            <th>+/-</th>
            <?php endif ?>
            <th>
                <p>Vitesse&emsp;<img style="width:20px" src="../public/pictures/diams.png" alt="diams"></p>
            </th>
            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
            <th>+/-</th>
            <?php endif ?>
            <th>
                <p>Insta&emsp;<img style="width:20px" src="../public/pictures/diams.png" alt="diams"></p>
            </th>
            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
            <th>+/-</th>
            <?php endif ?>
            <!--<th>Total Diams</th>-->
            <th>
                <a style="color:black" href="?page=dons&fonte">
                    <p>fonte&emsp;<img style="width:20px" src="../public/pictures/diams.png" alt="diams"></p>
                </a>
            </th>
            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
            <th>+/-</th>
            <?php endif ?>
        </tr>
        <?= $tabList ?>
    </table>
    <div class="footer"></div>
</div>
<?php
$content = ob_get_clean();
require 'template.php';