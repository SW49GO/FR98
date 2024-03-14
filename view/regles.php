<?php
$title = 'Règles';
ob_start();
?>
<div class="page_regles">
    <h1>Règles de l'alliance</h1>

    <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
    <fieldset>
        <legend>ADMINISTRATION</legend>
        <div class="admin_regles">
            <h2>Ajouter une règles</h2>
            <div class="newRegles">
                <h3>Règle n° <span class="nbRegles">
                        <?= $nb ?>
                    </span>:</h3>
                <p class="nbCarRegle">Nombre de caractères : <span id="nbCar">&ensp;300</span></p>
                <textarea class="regles"></textarea><br>
                <button style="background-color:rgb(49,49,49)" class="validModif btnCar">Valider</button>
            </div>
        </div>
        </legend>
    </fieldset>
    <?php endif ?>

    <div class="reglesPlayer">
        <?= $listComment ?>
    </div>
</div>
<div class="footer"></div>
<?php
$content = ob_get_clean();
require 'template.php';