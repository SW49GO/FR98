<?php
$title = "Admnistration";
ob_start();
?>
<div class="admin_player">
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 0): ?>
    <div class="bienvenue" style="color:<?= $_SESSION['user']['grade'] ?>">Bienvenue <?= $_SESSION['user']['name'] ?><a
                class="disconnect" href="?deco" title="Déconnexion"><img class="disconnect"
                    src="../public/pictures/power-icon.png" alt="bouton"></a>
    </div>
    <?php endif ?>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
    <form id="addPlayer" method="POST" action="">
        <div class="bienvenue" style="color:<?= $_SESSION['user']['grade'] ?>">Bienvenue <?= $_SESSION['user']['name']
        ?><a class="disconnect" href="?deco" title="Déconnexion"><img class="disconnect"
                        src="../public/pictures/power-icon.png" alt="bouton"></a>
        </div>
        <div class="addPlayer">
            <h3>AJOUTER UN JOUEUR :</h3>
            <label>Nom nouveau Joueur :</label>
            <input type="text" id="newPlayer" name="newPlayer"
                title="Pour un Nom commençant par un Chiffre, mettre un Point Devant !">
            <label>Grade :</label>
            <select id="select_grade" name="select_grade">
                <option value="">Liste Grades</option>
                <option value="white" style="color:white">Soldat</option>
                <option value="yellow" style="color:yellow">General</option>
                <option value="aqua" style="color:aqua">Sergent</option>
                <option value="orange" style="color:orange">Chef</option>
            </select>
            <label>Crâne :</label>
            <input type="text" id="cranePlayer" name="cranePlayer" placeholder="00.0"><span>&emsp;%</span>
            <input id="add_new_player" type="submit" name="add_new_player" value="Ajouter">
        </div>

    </form>
    <form id="select_player" method="POST" action="?page=administration">
        <div class="select_player">
            <h3>MODIFIER UN JOUEUR :</h3>
            <label>Selectionner le joueur à modifier :</label>
            <select name="select_player" class="select_player_list">
                <option value="">Liste Joueurs</option>
                <?= $select ?>
            </select>
            <a onClick="window.location.reload()" title="Rafraichir la liste"><img class="refresh"
                    src="../public/pictures/refresh.png"></a>
            <input id="modif_player" type="submit" name="modif_player" value="Modifier">
        </div>
    </form>
    <?php endif ?>
</div>
<?= $modifPlayer ?>

    <?php
    $content = ob_get_clean();
    require 'template.php';