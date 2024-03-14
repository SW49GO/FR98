<!doctype html>
<html lang="fr">

<head>
    <title>
        <?= $title ?>
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../public/css/styles.css" type="text/css" />
    <link rel="shortcut icon" href="../public/pictures/france.ico" type="image/png">

</head>

<body>
    <div class="entete">
        <div class="header">
            <div class="signature">
                <p>&copy;&reg;Swillisss
                </p>
                <img src="../public/pictures/swill50.png">
            </div>
            <img class="logo" src="public/pictures/logo2.png" alt="logo">
        </div>
        <nav class="navbar">
            <ul>
                <li class="myButton">
                    <a href="?page=player">Joueurs</a>
                </li>
                <li class="myButton">
                    <a href="?page=dons">Dons</a>
                </li>
                <li class="myButton">
                    <a href="?page=participation">Participations</a>
                </li>
                <li class="myButton">
                    <a href="?page=voteplayer">Vote Boosts</a>
                </li>
                <li class="myButton">
                    <a href="?page=adminConq">Conquête</a>
                </li>
                <li class="myButton">
                    <a href="?page=guerre">Guerres</a>
                </li>
                <li class="menu_sous myButton">
                    <p>Infos</p>
                    <ul class="ss_menu">
                        <li class="myButton">
                            <a href="?page=infos">Divers</a>
                        </li>

                        <li class="myButton">
                            <a href="?page=regles">Règles</a>
                        </li>
                        <li class="myButton">
                            <a href="?page=bannis">Indésirables</a>
                        </li>
                        <li class="myButton">
                            <a href="?page=blacklist">BlackList</a>
                        </li>
                    </ul>
                </li>
                <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1 && ($_SESSION['user']['name'] == 'Swillisss' || $_SESSION['user']['name'] == 'Axelle34')): ?>
                    <li class="menu_sous myButton">
                        <p>Admin</p>
                        <ul class="ss_menu">
                            <li class="myButton">
                                <a href="?page=swillisss">Master</a>
                            </li>
                            <li class="myButton">
                                <a href="?page=voteadmin">Boosts</a>
                            </li>
                            <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1 && ($_SESSION['user']['name'] == 'Swillisss')): ?>
                                <li class="myButton">
                                    <a href="?page=conquete">Conquête</a>
                                </li>
                                <?php endif ?>
                        </ul>
                    </li>
                    <?php endif ?>
            </ul>
        </nav>
    </div>
    <main>
        <div class="main_container">
            <?= $content ?>
        </div>
    </main>
    <footer>
    </footer>
    <script src="../public/styles/styles.js"></script>
    <script>
        if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); }
    </script>
</body>

</html>