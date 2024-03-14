<?php
$title = "Conquête";
ob_start();
?>
<div class="page_conq">
    <fieldset>
        <legend>ADMINISTRATION</legend>
        <form method="POST" action="">
            <label>Effacer les données (dons+crânes)</label>
            <input class="validModif" type="submit" name="erase" value="Effacer">
        </form>
    </fieldset>
    <h1>Conquête</h1>
    <table class="tab_conq">
        <col style="background-color:rgb(104, 242, 150)">
        <col style="background-color:rgb(53, 193, 244)">
        <col style="background-color:rgb(53, 193, 244)">
        <col style="background-color:rgb(229, 224, 91)">
        <col style="background-color:rgb(229, 224, 91)">
        <col style="background-color:rgb(188, 188, 181)">
        <col style="background-color:rgb(188, 188, 181); border-right:6px solid brown">
        <col style="background-color:rgb(53, 193, 244)">
        <col style="background-color:rgb(53, 193, 244)">
        <col style="background-color:rgb(229, 224, 91)">
        <col style="background-color:rgb(229, 224, 91)">
        <col style="background-color:rgb(188, 188, 181)">
        <col style="background-color:rgb(188, 188, 181)">
        <col style="background-color:rgb(214, 104, 104); border-left:6px solid brown">
        <col style="background-color:rgb(214, 104, 104)">
        <col style="background-color:rgb(232, 164, 225); border-left:6px solid brown">
        <col style="background-color:rgb(232, 164, 225)">
        <th><a style="color:black" href="?page=adminConq&joueur">JOUEURS</a></th>
        <th>
            <a href="?page=adminConq&troupe"><img class="dim20" src="../public/pictures/bat_troupe.png"
                    alt="troupe"></a>
        </th>
        <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
        <th>+/-</th>
        <?php endif ?>
        <th>
            <a href="?page=adminConq&sagesse"><img class="dim20" src="../public/pictures/bat_sagesse.png"
                    alt="sagesse"></a>
        </th>
        <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
        <th>+/-</th>
        <?php endif ?>
        <th>
            <a href="?page=adminConq&pierre"><img class="dim20" src="../public/pictures/bat_pierre.png"
                    alt="pierre"></a>
        </th>
        <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
        <th>+/-</th>
        <?php endif ?>
        <th>
            <a href="?page=adminConq&dont"><img class="dim30" src="../public/pictures/troupe.png" alt="soldat"></a>
        </th>
        <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
        <th>MAJ</th>
        <?php endif ?>
        <th>
            <a href="?page=adminConq&dons"><img class="dim30" src="../public/pictures/sagesse.png" alt="sagesse"></a>
        </th>
        <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
        <th>MAJ</th>
        <?php endif ?>
        <th>
            <a href="?page=adminConq&donp"><img class="dim30" src="../public/pictures/pierre.png" alt="pierre"></a>
        </th>
        <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
        <th>MAJ</th>
        <?php endif ?>
        <th>
            <a href="?page=adminConq&crane"><img class="dim30" src="../public/pictures/minicrane.png" alt="crane"></a>
        </th>
        <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
        <th>MAJ</th>
        <?php endif ?>

        <th><a style="color:black" href="?page=adminConq&part">Participation</a></th>

        <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
        <th>+/-</th>
        <?php endif ?>
        <?= $tabList ?>
    </table>
</div>

<?php
$content = ob_get_clean();
require 'template.php';