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
    <a href="?page=home&dons">
        <p style="color:rgb(247, 184, 59); width:100px">DONS</p>
    </a>
    <p style="color:blue">&emsp;BASE</p>
    <p style="color:blue">Perks Base</p>
    <p style="color:green">&emsp;TRESOR</p>
    <p style="color:green">Perks Tresor</p>
    <p style="color:red">&emsp;GUERRE</p>
    <p style="color:red">Perks Guerre</p>
</div>
<div class="playersList">
    <?php foreach ($players as $p): ?>
    <?php if ($p['stay']): ?>
    <div class="players">
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
        <div class="joueur"><a style="color:<?= $p['grade'] ?>" href="?page=administration&modif=<?= $p['id'] ?>">
                <?= $p['name'] ?>
            </a></div>
        <?php else: ?>
        <div class="joueur" style="color:<?= $p['grade'] ?>">
            <?= $p['name'] ?>
        </div>
        <?php endif ?>
        <div class="crane">
            <?= $p['crane'] ?> %
        </div>
        <div class="dons"><a href="?page=home&moins=<?= $p['id'] ?>" class="moins"><sup>&ndash;</sup></a>
            <div class="nbDons">
                <?= $p['dons'] ?>
            </div><a href="?page=home&plus=<?= $p['id'] ?>" class="plus">+</a>
        </div>
        <?php if ($p['base'] == 1): ?>
        <div class="base">
            <div class="perkHaut">
                <?php if ($p['bh'] == 1): ?>
                <img class="bulle" src="public/pictures/bvert.png" alt="bulle">
                <?php else: ?>
                <img class="bulle" src="public/pictures/brouge.png" alt="bulle">
                <?php endif ?>
            </div>
            <img class="img" src="public/pictures/base.png" alt="image">
            <div class="perkGauche">
                <?php if ($p['bg'] == 1): ?>
                <img class="bulle" src="public/pictures/bvert.png" alt="bulle">
                <?php else: ?>
                <img class="bulle" src="public/pictures/brouge.png" alt="bulle">
                <?php endif ?>
            </div>
            <div class="perkDroite">
                <?php if ($p['bd'] == 1): ?>
                <img class="bulle" src="public/pictures/bvert.png" alt="bulle">
                <?php else: ?>
                <img class="bulle" src="public/pictures/brouge.png" alt="bulle">
                <?php endif ?>
            </div>
        </div>
        <div class="perkListB">
            <ul>
                <li>H : <?= $p['bhname'] ?>
                </li>
                <li>D : <?= $p['bdname'] ?>
                </li>
                <li>G : <?= $p['bgname'] ?>
                </li>
            </ul>
        </div>
        <?php endif ?>
        <?php if ($p['tresor'] == 1): ?>
        <div class="tresor">
            <div class="perkHaut">
                <?php if ($p['th'] == 1): ?>
                <img class="bulle" src="public/pictures/bvert.png" alt="bulle">
                <?php else: ?>
                <img class="bulle" src="public/pictures/brouge.png" alt="bulle">
                <?php endif ?>
            </div>
            <img class="img" src="public/pictures/tresor.png" alt="image">
            <div class="perkGauche">
                <?php if ($p['tg'] == 1): ?>
                <img class="bulle" src="public/pictures/bvert.png" alt="bulle">
                <?php else: ?>
                <img class="bulle" src="public/pictures/brouge.png" alt="bulle">
                <?php endif ?>
            </div>
            <div class="perkDroite">
                <?php if ($p['td'] == 1): ?>
                <img class="bulle" src="public/pictures/bvert.png" alt="bulle">
                <?php else: ?>
                <img class="bulle" src="public/pictures/brouge.png" alt="bulle">
                <?php endif ?>
            </div>
        </div>
        <div class="perkListT">
            <ul>
                <li>H : <?= $p['thname'] ?>
                </li>
                <li>D : <?= $p['tdname'] ?>
                </li>
                <li>G : <?= $p['tgname'] ?>
                </li>
            </ul>
        </div>
        <?php endif ?>
        <?php if ($p['guerre'] == 1): ?>
        <div class="guerre">
            <div class="perkHaut">
                <?php if ($p['gh'] == 1): ?>
                <img class="bulle" src="public/pictures/bvert.png" alt="bulle">
                <?php else: ?>
                <img class="bulle" src="public/pictures/brouge.png" alt="bulle">
                <?php endif ?>
            </div>
            <img class="img" src="public/pictures/guerre.png" alt="image">
            <div class="perkGauche">
                <?php if ($p['gg'] == 1): ?>
                <img class="bulle" src="public/pictures/bvert.png" alt="bulle">
                <?php else: ?>
                <img class="bulle" src="public/pictures/brouge.png" alt="bulle">
                <?php endif ?>
            </div>
            <div class="perkDroite">
                <?php if ($p['gd'] == 1): ?>
                <img class="bulle" src="public/pictures/bvert.png" alt="bulle">
                <?php else: ?>
                <img class="bulle" src="public/pictures/brouge.png" alt="bulle">
                <?php endif ?>
            </div>
        </div>
        <div class="perkListG">
            <ul>
                <li>H :<?= $p['ghname'] ?>
                </li>
                <li>G :<?= $p['ggname'] ?>
                </li>
                <li>D :<?= $p['gdname'] ?>
                </li>
            </ul>
        </div>
        <?php endif ?>
    </div>
    <?php endif ?>
    <?php endforeach ?>
    <div class="footer"></div>
</div>

<?php
$content = ob_get_clean();
require 'template.php';