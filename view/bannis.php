<?php
$title = "Bannis";
ob_start();
?>
<div class="pageBannis">
    <div class="list_bannis">
        <h1>Listes des Bannis</h1>

        <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
        <fieldset>
            <legend>ADMINISTRATION</legend>
            <form class="form_bannis" method="POST" action="">
                <label>Ajouter un Joueur -- NOM :</label>
                <input class="add_bannis" type="text" name="add_bannis">
                <label>Raison du bannissement :</label>
                <textarea class="reason_bannis" name="reason_bannis"></textarea><br>
                <input class="sub_add_bannis" type="submit" name="submit" value="Ajouter">
            </form>
            </legend>
        </fieldset>
        <?php endif ?>

        <?= $bannis ?>
    </div>
    <div class="footer"></div>
</div>
<?php
$content = ob_get_clean();
require 'template.php';