<?php
$title = "Connexion";
ob_start();
?>
<div class="controle">
    <div class="connexion_error">
        <?= $errorMsg ?>
    </div>
    <div class="connexion">

        <!--<div class="img_connect">
            <img src="../public/pictures/wolf.png">
        </div>-->
        <form class="formConnexion" method="POST" action="?page=player">
            <div>
                <label for="user">Votre Nom :</label>
                <input type="text" id="user" name="user" require="required">
            </div>
            <div>
                <label for="pwd">Mot de Passe:</label>
                <input type="password" id="pwd" name="pwd" require="required">
            </div><br>
            <input type="submit" name="connexion" value="Connexion">
        </form>
    </div>
    <div class="footer"></div>
</div>
<?php
$content = ob_get_clean();
require 'template.php';