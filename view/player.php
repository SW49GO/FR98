<?php
$title = "Joueurs";
ob_start();
?>
<div class="presentation">
    <a style="width:17%" href="?page=player&play">
        <p>
            <?= $nb ?>&emsp;JOUEURS
        </p>
    </a>
    <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
    <p class="add_player" style="font-size:25px; font-weight: bold;color:yellow;width: 2%;" title="Ajouter un Joueur">+
    </p>
    <?php endif ?>
    <a style="width:15%" href="?page=player&crane">
        <p style="color:white">CRANE</p>
    </a>
    <p style="color:blue;width:15%">BASE</p>
    <p style="color:green;width:15%">TRESOR</p>
    <p style="color:red;width:15%">GUERRE</p>
    <p style="color:grey;width:15%">VITESSE</p>
    <p style="color:purple;width:15%">PERLE</p>
    <p style="color:orange;width:15%">INSTA</p>
    <p style="color:brown;width:15%">FONTE</p>
    <p style="width:5%"></p>
</div>
<div class="container_addPlayer hidden">
    <form id="addPlayer" method="POST" action="">
        <h3 style="color:blue">AJOUTER UN JOUEUR :</h3>
        <div class="addNewPlayer">
            <label>Nom :</label>
            <input type="text" id="newPlayer" name="newPlayer">
            <label>Grade :</label>
            <select id="select_grade" name="select_grade">
                <option value="">Liste Grades</option>
                <option value="white" style="color:white">Soldat</option>
                <option value="yellow" style="color:yellow">General</option>
                <option value="aqua" style="color:aqua">Sergent</option>
                <option value="red" style="color:red">Chef</option>
            </select>
            <label>Crâne :</label>
            <input type="text" id="cranePlayer" name="cranePlayer" placeholder="00.0"><span>&emsp;%</span>
            <input id="add_new_player" type="submit" name="add_new_player" value="Ajouter">
        </div>
    </form>
</div>
<div class="playersList">
    <?= $playersList ?>
        <div class="footer"></div>
</div>
<?php
$content = ob_get_clean();
require 'template.php';