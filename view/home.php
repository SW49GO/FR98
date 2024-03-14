<?php
$title = "Accueil";
ob_start();
?>
<div class="presentation">
    <a href="?page=home&play">
        <p>
            <?= $nb ?>&emsp;JOUEURS
        </p>
    </a>
    <a href="?page=home&crane">
        <p style="color:white">CRANE</p>
    </a>
    <p style="color:blue">&emsp;BASE</p>
    <p style="color:blue">Perks Base</p>
    <p style="color:green">&emsp;TRESOR</p>
    <p style="color:green">Perks Tresor</p>
    <p style="color:red">&emsp;GUERRE</p>
    <p style="color:red">Perks Guerre</p>
</div>
<div class="playersList">
    <?= $playersList ?>
        <div class="footer"></div>
</div>

<?php
$content = ob_get_clean();
require 'template.php';