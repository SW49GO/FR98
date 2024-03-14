<?php
$title = "Admin Combos";
ob_start();
?>
<div class="page_combo">
    <h1>Configuration des Combos</h1>
    <div class="combo1">
        <h2>Combo 1 : Choississez les boosts</h2>
    </div>
    <div class="boosts">
        <form method="POST" action="">
            <div class="adminBoost">
                <div class="selectBoost">
                    <?php foreach ($boosts as $b): ?>
                    <div class="imgBoost">
                        <img class="cardBoost" src="../public/boosts/<?= $b['name'] ?>" title="<?= $b['title'] ?>">
                        <input class="checkBoostPlayer" type="checkbox" name="check[]" value="<?= $b['id'] ?>">
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
            <input class="validBoost" type="submit" name="combo1" value="Enregistrer">&emsp;
            <input class="validBoost" type="submit" name="cancel1" value="Annuler">
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require 'template.php';