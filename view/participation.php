<?php
$title = "Participations";
ob_start();
?>
<div class="page_participation">
    <h1>Participations</h1>
    <table class="tab_part">
        <col style="background-color:yellow">
        <col style="background-color:rgb(147, 215, 234)">
        <col style="background-color:rgb(168, 224, 169)">
        <col style="background-color: rgb(229, 144, 75)">
        <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
        <col style="background-color: rgb(229, 144, 75)">
        <?php endif ?>
        <col style="background-color: rgb(242, 65, 77)">
        <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
        <col style="background-color: rgb(242, 65, 77)">
        <?php endif ?>
        <col style="background-color:  rgb(224, 234, 114)">
        <col style="background-color:rgb(147, 215, 234)">
        <tr>
            <th colspan="9">PARTICIPATIONS AUX EVENEMENTS
            </th>
        </tr>
        <tr>
            <th><img class="dim20" src="../public/pictures/cup.png" alt="cup"></th>
            <th>
                <a href="?page=participation&player"><img class="dim40" src="../public/pictures/player.jpg"
                        alt="joueur">
                    </p>
            </th>
            <th>
                <a href="?page=participation&insigne"> <img class="dim40" src="../public/pictures/guerre.png"
                        alt="insigne"></a>
            </th>
            <th>
                <a href="?page=participation&ninja"><img class="dim40" src="../public/pictures/ninja.jpg"
                        alt="ninja"></a>
            </th>
            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
            <th>+/-</th>
            <?php endif ?>
            <th>
                <a href="?page=participation&guerre"><img class="dim40" src="../public/pictures/guerre.jpg"
                        alt="guerre"></a>
            </th>
            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
            <th>+/-</th>
            <?php endif ?>
            <th>
                <a href="?page=participation&conquete"><img class="dim40" src="../public/pictures/conquete.jpg"
                        alt="conquete"></a>
            </th>
            <th>
                <a style="color:black" href="?page=participation&total">TOTAL</a>
            </th>
        </tr>
        <?= $tabList ?>
    </table>
</div>

<?php
$content = ob_get_clean();
require 'template.php';