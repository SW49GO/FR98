<?php
$title = "BlackList";
ob_start();
?>
<div class="blacklist">
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 0): ?>
    <p style="color:white;font-size:20px">Vous ne disposez pas des droits pour Supprimer et/ou Réintégrer un Joueur
    </p>
    <?php endif ?>
    <?= $player_out ?>
        <?= $listPlayersSuppr ?>
            <div class="footer"></div>
</div>
<?php
$content = ob_get_clean();
require 'template.php';