<?php
require_once 'Manage.php';

class GetInfos extends Manage
{
    // Liste des joueurs trié par Nom
    public function getAllPlayers(): array
    {
        $query = "SELECT * FROM users ORDER BY name ASC";
        return $this->getQuery($query)->fetchAll();

    }
    // Liste des joueurs trié par Crâne
    public function getAllPlayersByCrane(): array
    {
        $query = "SELECT * FROM users ORDER BY crane DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Sélécteur des joueurs
    public function getSelect(): string
    {
        $select = '';
        $info_player = $this->getAllPlayers();
        foreach ($info_player as $i) {
            if ($i['stay']) {
                $select .= '<option value="' . $i['id'] . '">' . $i['name'] . '</option>';
            }
        }
        return $select;
    }
    // Info sur un joueur d'après son ID
    public function getOnePlayer(int $id): array
    {
        $data = ['id' => $id];
        $query = "SELECT * FROM users WHERE id=:id";
        return $this->getQuery($query, $data)->fetch();
    }
    // Ajouter un joueur
    public function addOnePlayer(array $data): void
    {
        if ($data['grade'] == 'yellow') {
            $query = "INSERT INTO users SET name=:name, grade=:grade, crane=:crane, admin=1";
            $this->getQuery($query, $data);
        } else {
            $query = "INSERT INTO users SET name=:name, grade=:grade, crane=:crane";
            $this->getQuery($query, $data);
        }
    }
    // Mise à jour d'un joueur
    public function updatePlayer(array $data): void
    {
        $query = "UPDATE users SET admin=:admin, champ=:champ, grade=:grade, crane=:crane, base=:base,bc=:bc,bh=:bh,bhname=:bhname,bg=:bg,bgname=:bgname,bd=:bd,bdname=:bdname,tresor=:tresor,tc=:tc,th=:th,thname=:thname,tg=:tg,tgname=:tgname,td=:td,tdname=:tdname,guerre=:guerre,gc=:gc,gh=:gh,ghname=:ghname,gg=:gg,ggname=:ggname,gd=:gd,gdname=:gdname,vitesse=:vitesse,vc=:vc,vh=:vh,vg=:vg,vd=:vd,vhname=:vhname,vgname=:vgname,vdname=:vdname,insta=:insta,ic=:ic,perle=:perle,pc=:pc,ph=:ph,pg=:pg,pd=:pd,phname=:phname,pgname=:pgname,pdname=:pdname,fonte=:fonte,fc=:fc WHERE id=:id";
        $this->getQuery($query, $data);

    }
    // Supression d'un joueur d'après son ID
    public function deletePlayer(int $id): void
    {
        $data = ['id' => $id];
        $query = "DELETE FROM users WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Suppression d'un joueur d'après son Nom
    public function deleteByName(string $name): void
    {
        $data = ['name' => $name];
        $query = "DELETE FROM users WHERE name=:name";
        $this->getQuery($query, $data);

    }
    // Vérification paramètres de connexion
    public function verifyAccount(string $name, $pwd): ?array
    {
        $data = ['name' => $name];
        $query = "SELECT id, name, admin, grade, pwd FROM users WHERE name=:name";
        $result = $this->getQuery($query, $data);
        if ($result->rowCount()) {
            $data = $result->fetch();
            if ($data != 'non') {
                if (password_verify($pwd, $data['pwd'])) {
                    return $data;
                }
            }
        }
        return null;
    }
    // Liste des joueurs ayant été supprimés
    public function infosSupprPlayers(): array
    {
        $query = "SELECT * FROM sorties ORDER BY name ASC";
        return $this->getQuery($query)->fetchAll();
    }
    // Mise à jour Profil Joueur si celui-ci doit rester dans la base de donnée
    public function updateProfilPlayer(string $name, int $stay): void
    {
        $data = ['name' => $name, 'stay' => $stay];
        $query = "UPDATE users SET stay=:stay WHERE name=:name";
        $this->getQuery($query, $data);
    }
    // Enregistrement d'un joueur ayant été supprimé
    public function registerSupprPlayer(array $data): void
    {
        $query = "INSERT INTO sorties SET name=:name, admin=:admin, reason=:reason,stay=:stay";
        $this->getQuery($query, $data);
    }
    // Suppression d'un joueur dans la liste des joueurs supprimés
    public function deleteSupprPlayer(string $name): void
    {
        $data = ['name' => $name];
        $query = "DELETE FROM sorties WHERE name=:name";
        $this->getQuery($query, $data);
    }
    // Liste des joueurs bannis
    public function getAllBannis(): array
    {
        $query = "SELECT * FROM bannis ORDER BY name ASC";
        return $this->getQuery($query)->fetchAll();
    }
    // Ajout d'un joueur à bannir
    public function addBannis(array $data): void
    {
        $query = "INSERT INTO bannis SET name=:name, comment=:comment";
        $this->getQuery($query, $data);
    }
    // Mise à jour du Nom et du Mot de Passe d'un joueur
    public function updateInfoPlayer(int $id, string $name, string $pwd): void
    {
        if (empty($pwd)) {
            $data = ['name' => $name, 'id' => $id];
            $query = "UPDATE users SET name=:name WHERE id=:id";
            $this->getQuery($query, $data);
        } else {
            $pass = password_hash($pwd, PASSWORD_BCRYPT);
            $data = ['name' => $name, 'pwd' => $pass, 'id' => $id];
            $query = "UPDATE users SET name=:name, pwd=:pwd WHERE id=:id";
            $this->getQuery($query, $data);
        }
    }

    // Vérification de fichier
    public function verifyFiles(string $source, string $dest, string $name): bool
    {
        $mimes_ok = array('png' => 'image/png', 'jpeg' => 'image/jpeg', 'jpg' => 'image/jpeg');
        if (!in_array(finfo_file(finfo_open(FILEINFO_MIME_TYPE), $source), $mimes_ok)) {
            $result = false;
        } else {
            $data = ['name' => $name];
            $query = "INSERT INTO excel SET name=:name, date_crea=NOW()";
            $this->getQuery($query, $data);
            move_uploaded_file($source, $dest . '/' . $name);
            unset($_FILES);
            $result = true;
        }
        return $result;
    }

    // Liste des fichiers Excel
    public function listExcel(): array
    {
        $query = "SELECT * FROM excel";
        return $this->getQuery($query)->fetchAll();

    }
    // Suppression d'un fichier Excel
    public function supprExcel(int $id, string $name): void
    {
        var_dump($name);
        $folder = '../public/excel';
        if (is_dir($folder)) {
            unlink($folder . '/' . $name);
        }
        $data = ['id' => $id];
        $query = "DELETE FROM excel WHERE id=:id";
        $this->getQuery($query, $data);

    }
    // Nombre de Joueurs ayant un Profil actif
    public function nbPlayers(): int
    {
        $query = "SELECT * FROM users WHERE stay=1";
        $nb = $this->getQuery($query)->rowCount();
        return $nb;
    }
    // Liste des joueurs connectés
    public function connectPlayers(): array
    {
        $query = "SELECT * FROM users WHERE connect!='' ORDER BY connect DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Mise à jour de la connexion, parcours des pages
    public function updateConnect(int $id, int $connect): void
    {
        if ($connect == 1) {
            $data = ['id' => $id];
            $query = "UPDATE users SET connect=NOW() WHERE id=:id";
            $this->getQuery($query, $data);
        } else {
            $data = ['id' => $id];
            $query = "UPDATE users SET connect=null WHERE id=:id";
            $this->getQuery($query, $data);
        }


    }
    // Liste des boosts
    public function getBoosts(): array
    {
        $query = "SELECT * FROM boost";
        return $this->getQuery($query)->fetchAll();
    }
    // Activation des boosts pour le vote
    public function startVote(string $start): void
    {
        $data = ['start' => $start];
        $query = "UPDATE boost SET start=:start";
        $this->getQuery($query, $data);
    }
    // Information sur les boosts
    public function infosBoosts(int $id): array
    {
        $data = ['id' => $id];
        $query = "SELECT * FROM boost WHERE id=:id";
        return $this->getQuery($query, $data)->fetch();
    }
    // Nombre de boosts ayant été activés
    public function numberBoost(): array
    {
        $query = "SELECT * FROM boost WHERE active = 1";
        return $this->getQuery($query)->fetchAll();

    }
    // Activation des boosts sélectionnés
    public function updateBoosts(int $id, int $active): void
    {
        $data = ['id' => $id, 'active' => $active];
        $query = "UPDATE boost SET active=:active, date_crea=NOW() WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Enregistrement du nombre de boosts autorisés par joueur
    public function updateNbBoosts(int $nb): void
    {
        $data = ['nb' => $nb];
        $query = "UPDATE boost SET nb=:nb,date_crea=NOW()";
        $this->getQuery($query, $data);
    }
    // Annulation des votes
    public function deleteBoosts(): void
    {
        $query = "UPDATE boost SET nb=0,active=0,selected=0";
        $this->getQuery($query);
    }
    // Boosts sélectionnés
    public function updateVoteBoost(int $id): void
    {
        $res = $this->getVoteBoost($id);
        $res = intval($res[0]['selected']) + $res[0]['pts'];
        $data = ['id' => $id, 'selected' => $res];
        $query = "UPDATE boost SET selected=:selected WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Liste des boosts sélectionnés et points correspondants
    public function getVoteBoost(int $id): array
    {
        $data = ['id' => $id];
        $query = "SELECT selected, pts FROM boost WHERE id=:id";
        return $this->getQuery($query, $data)->fetchAll();
    }
    // Garder les potions pour le prochains Vote
    public function setPotion(string $pseudo, int $potion): void
    {
        $data = ['pseudo' => $pseudo, 'potion' => $potion];
        $query = "UPDATE votes SET potion=:potion WHERE pseudo=:pseudo";
        $this->getQuery($query, $data);
    }
    // Nombre de votant qui garde les potions
    public function nbPotion(): array
    {
        $query = "SELECT * FROM votes WHERE potion=1";
        return $this->getQuery($query)->fetchAll();
    }
    // Mise à zéro de la séléction des boosts
    public function refreshVote(): void
    {
        $query = "UPDATE boost SET selected=0";
        $this->getQuery($query);
    }
    // Liste des votants trié par Pseudo
    public function listVotant(): array
    {
        $query = "SELECT * FROM votes ORDER BY pseudo ASC";
        return $this->getQuery($query)->fetchAll();
    }
    // Vérification d'un votant par Pseudo
    public function verifyVotant(string $pseudo): array
    {
        $data = ['pseudo' => $pseudo];
        $query = "SELECT * FROM votes WHERE pseudo=:pseudo";
        return $this->getQuery($query, $data)->fetchAll();

    }
    // Enregistrement d'un Pseudo
    public function setPseudo(string $pseudo): void
    {
        $data = ['pseudo' => $pseudo];
        $query = "INSERT INTO votes SET pseudo=:pseudo, date_vote=NOW()";
        $this->getQuery($query, $data);
    }
    // Enregistrement des choix de boosts d'un joueur
    public function updateVotant(string $pseudo, $tab): void
    {
        $data = ['pseudo' => $pseudo, 'choix' => $tab];
        $query = "UPDATE votes SET choix=:choix WHERE pseudo=:pseudo";
        $this->getQuery($query, $data);
    }
    // Supprimer un vote
    public function deleteVotant(int $id): void
    {
        $data = ['id' => $id];
        $query = "DELETE FROM votes WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Vidage de tout les votes
    public function deleteAllVotant(): void
    {
        $query = "TRUNCATE TABLE votes";
        $this->getQuery($query);
    }
    // Liste des choix de boosts par Joueur
    public function nbBoostForPlayer(): array
    {
        $query = "SELECT nb FROM boost WHERE id=1";
        return $this->getQuery($query)->fetch();
    }
    // Enregistrement de la configuration de guerre
    public function setConfCombat(array $data): void
    {
        $query = "INSERT INTO configcombat SET jour=:jour, team=:team,nbJ=:nbJ,nbC=:nbC";
        $this->getQuery($query, $data);
    }
    // Information sur la guerre
    public function getInfosCombat(): array
    {
        $query = "SELECT * FROM combats";
        return $this->getQuery($query)->fetchAll();
    }
    // Suppression d'un joueur dans la liste des participants de guerre
    public function supprCombatOnePlayer(string $name): void
    {
        $data = ['player' => $name];
        $query = "DELETE FROM combats WHERE player=:player";
        $this->getQuery($query, $data);
    }
    // Ajout d'un joueur dans la liste des participants de guerre
    public function addCombatOnePlayer(string $name): void
    {
        $data = ['player' => $name];
        $query = "INSERT INTO combats SET player=:player";
        $this->getQuery($query, $data);
    }
    // Vidage de la conquête
    public function deleteConquete(): void
    {
        $query = "TRUNCATE TABLE conquete";
        $this->getQuery($query);
    }
    // Copie de la liste des joueurs actif pour la conquête
    public function setPlayerConquete(): void
    {
        $query = "INSERT INTO conquete (name)
                SELECT name FROM users WHERE stay=1";
        $this->getQuery($query);
    }
    // Enregistrement de la date de la conquête
    public function setDateConquete(): void
    {
        $query = "UPDATE conquete SET dateConq=NOW()";
        $this->getQuery($query);
    }
    // Information conquête trié par Crâne
    public function getInfosConquete(): array
    {
        $query = "SELECT * FROM conquete ORDER BY crane DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Enregistrement des crânes obtenus d'un joueur
    public function setCraneConquete(int $id, string $crane): void
    {
        $data = ['id' => $id, 'crane' => $crane];
        $query = "UPDATE conquete SET crane=:crane WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Enregistrement de la liste des adversaires d'une conquête
    public function setConqAdver(string $adver): void
    {
        $data = ['adversaire' => $adver];
        $query = "UPDATE conquete SET adversaire=:adversaire";
        $this->getQuery($query, $data);
    }
    // Enregistrement des points des adversaires d'une conquête
    public function setConqPoint(string $point): void
    {
        $data = ['pointAdver' => $point];
        $query = "UPDATE conquete SET pointAdver=:pointAdver";
        $this->getQuery($query, $data);
    }
    // Sélecteur des joueurs de la conquête
    public function getPlayerConq(): string
    {
        $select = '';
        $info_player = $this->getInfosConquete();
        foreach ($info_player as $i) {
            $select .= '<option value="' . $i['id'] . '">' . $i['name'] . '</option>';
        }
        return $select;
    }
    // Supression d'un joueur de la conquête
    public function deleteOneConq(int $id): void
    {
        $data = ['id' => $id];
        $query = "DELETE FROM conquete WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Ajout d'un nom à la liste des dons
    public function addPlayerDons(string $name): void
    {
        $data = ['name' => $name];
        $query = "INSERT INTO dons SET name=:name, alliance=1";
        $this->getQuery($query, $data);

    }
    // Supression définitive d'un joueur à la liste des dons
    public function deletePlayerDonsDef(string $name): void
    {
        $data = ['name' => $name];
        $query = "DELETE FROM dons WHERE name=:name";
        $this->getQuery($query, $data);
    }
    // Activation du joueur demandant un insigne de guerre
    public function validInsDonGuerre(string $name): void
    {
        $data = ['name' => $name];
        $query = "UPDATE dons SET gc=1 WHERE name=:name";
        $this->getQuery($query, $data);
    }
    // Mise à jour d'un joueur supprimé, profil conservé, dans la liste des dons
    public function updatePlayerDonsAtt(string $name): void
    {
        $data = ['name' => $name];
        $query = "UPDATE dons SET alliance=0 WHERE name=:name";
        $this->getQuery($query, $data);
    }
    // Liste des dons
    public function listDons(): array
    {
        $query = "SELECT * FROM dons WHERE alliance=1 ORDER BY name ASC";
        return $this->getQuery($query)->fetchAll();
    }
    // Liste des points de Participation
    public function selectParticipation(int $id): array
    {
        $data = ['id' => $id];
        $query = "SELECT participation FROM dons WHERE id=:id";
        return $this->getQuery($query, $data)->fetch();
    }
    // Mise à jour points de Participation d'un joueur (case Participation)
    public function updateParticipation(int $id, int $valeur): void
    {
        $data = ['id' => $id, 'participation' => $valeur];
        $query = "UPDATE dons SET participation=:participation WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Ajout des autres points à la Participation
    public function participation(int $id, int $valeur): int
    {
        $data = ['id' => $id];
        $query = "SELECT participation FROM dons WHERE id=:id";
        $res = $this->getQuery($query, $data)->fetch();
        $val = intval($res['participation']) + $valeur;
        $this->updateParticipation($id, intval($val));
        return $val;
    }
    // Enregistrement des points de Base + Participation
    public function baseDons(int $id, int $valeur): array
    {
        $res = $this->selectParticipation($id);
        $total = intval($res['participation']) + $valeur;
        $this->updateParticipation($id, $total);
        $data = ['id' => $id];
        $query = "SELECT base FROM dons WHERE id=:id";
        $res = $this->getQuery($query, $data)->fetch();
        $val = intval($res['base']) + $valeur;
        $data = ['id' => $id, 'base' => intval($val)];
        $query = "UPDATE dons SET base=:base WHERE id=:id";
        $this->getQuery($query, $data);
        $result = ['base' => $val, 'participation' => $total];
        return $result;
    }
    // Enregistrement des points de Trésor + Participation
    public function tresorDons(int $id, int $valeur): array
    {
        $res = $this->selectParticipation($id);
        $total = intval($res['participation']) + $valeur;
        $this->updateParticipation($id, $total);
        $data = ['id' => $id];
        $query = "SELECT tresor FROM dons WHERE id=:id";
        $res = $this->getQuery($query, $data)->fetch();
        $val = intval($res['tresor']) + $valeur;
        $data = ['id' => $id, 'tresor' => intval($val)];
        $query = "UPDATE dons SET tresor=:tresor WHERE id=:id";
        $this->getQuery($query, $data);
        $result = ['tresor' => $val, 'participation' => $total];
        return $result;
    }
    // Enregistrement des points de Guerre + Participation
    public function guerreDons(int $id, int $valeur): array
    {
        $res = $this->selectParticipation($id);
        $total = intval($res['participation']) + $valeur;
        $this->updateParticipation($id, $total);
        $data = ['id' => $id];
        $query = "SELECT guerre FROM dons WHERE id=:id";
        $res = $this->getQuery($query, $data)->fetch();
        $val = intval($res['guerre']) + $valeur;
        $data = ['id' => $id, 'guerre' => intval($val)];
        $query = "UPDATE dons SET guerre=:guerre WHERE id=:id";
        $this->getQuery($query, $data);
        $result = ['guerre' => $val, 'participation' => $total];
        return $result;
    }
    // Enregistrement des points de Vitesse + Participation
    public function vitesseDons(int $id, int $valeur): array
    {
        $res = $this->selectParticipation($id);
        $total = intval($res['participation']) + $valeur;
        $this->updateParticipation($id, $total);
        $data = ['id' => $id];
        $query = "SELECT vitesse FROM dons WHERE id=:id";
        $res = $this->getQuery($query, $data)->fetch();
        $val = intval($res['vitesse']) + $valeur;
        $data = ['id' => $id, 'vitesse' => intval($val)];
        $query = "UPDATE dons SET vitesse=:vitesse WHERE id=:id";
        $this->getQuery($query, $data);
        $result = ['vitesse' => $val, 'participation' => $total];
        return $result;
    }
    // Enregistrement des points de Perle + Participation
    public function perleDons(int $id, int $valeur): array
    {
        $res = $this->selectParticipation($id);
        $total = intval($res['participation']) + $valeur;
        $this->updateParticipation($id, $total);
        $data = ['id' => $id];
        $query = "SELECT perle FROM dons WHERE id=:id";
        $res = $this->getQuery($query, $data)->fetch();
        $val = intval($res['perle']) + $valeur;
        $data = ['id' => $id, 'perle' => intval($val)];
        $query = "UPDATE dons SET perle=:perle WHERE id=:id";
        $this->getQuery($query, $data);
        $result = ['perle' => $val, 'participation' => $total];
        return $result;
    }
    // Enregistrement des points de Insta + Participation
    public function instaDons(int $id, int $valeur): array
    {
        $res = $this->selectParticipation($id);
        $total = intval($res['participation']) + $valeur;
        $this->updateParticipation($id, $total);
        $data = ['id' => $id];
        $query = "SELECT insta FROM dons WHERE id=:id";
        $res = $this->getQuery($query, $data)->fetch();
        $val = intval($res['insta']) + $valeur;
        $data = ['id' => $id, 'insta' => intval($val)];
        $query = "UPDATE dons SET insta=:insta WHERE id=:id";
        $this->getQuery($query, $data);
        $result = ['insta' => $val, 'participation' => $total];
        return $result;
    }
    // Enregistrement des points de Fonte + Participation
    public function fonteDons(int $id, int $valeur): array
    {
        $res = $this->selectParticipation($id);
        $total = intval($res['participation']) + $valeur;
        $this->updateParticipation($id, $total);
        $data = ['id' => $id];
        $query = "SELECT fonte FROM dons WHERE id=:id";
        $res = $this->getQuery($query, $data)->fetch();
        $val = intval($res['fonte']) + $valeur;
        $data = ['id' => $id, 'fonte' => intval($val)];
        $query = "UPDATE dons SET fonte=:fonte WHERE id=:id";
        $this->getQuery($query, $data);
        $result = ['fonte' => $val, 'participation' => $total];
        return $result;
    }
    // Tri des dons de Guerre
    public function triGuerreDons(): array
    {
        $query = "SELECT * FROM dons ORDER BY guerre DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri des dons de Fonte
    public function triFonteDons(): array
    {
        $query = "SELECT * FROM dons ORDER BY fonte DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri des points de Participation
    public function triParticipationDons(): array
    {
        $query = "SELECT * FROM dons ORDER BY participation DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Liste des règles
    public function listRegles(): array
    {
        $query = "SELECT * FROM regles ORDER BY date_crea ASC";
        return $this->getQuery($query)->fetchAll();
    }
    // Enregistrement d'une règle
    public function setRegles(array $data): void
    {
        $query = "INSERT INTO regles SET author=:author, comment=:comment, date_crea=NOW()";
        $this->getQuery($query, $data);
    }
    // Dernier ID d'enregistrement d'un règle
    public function lastIdRegles(): array
    {
        $query = "SELECT MAX(id) FROM regles";
        $int = $this->getQuery($query)->fetch();
        return $int;
    }
    // Suppression d'une règle
    public function deleteRegles(int $id): void
    {
        $data = ['id' => $id];
        $query = "DELETE FROM regles WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Mise à jour d'une règle
    public function updateRegles(int $id, string $comment): void
    {
        $data = ['id' => $id, 'comment' => $comment];
        $query = "UPDATE regles SET comment=:comment WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Listing d'une règle pour modification
    public function getOneRegle(int $id): array
    {
        $data = ['id' => $id];
        $query = "SELECT comment FROM regles WHERE id=:id ";
        return $this->getQuery($query, $data)->fetch();
    }
    // Stockage des points de dons de Guerre
    public function stockGuerreDons(): void
    {
        $list = $this->listDons();
        foreach ($list as $l) {
            $data = ['id' => $l['id']];
            $query = "SELECT stockGuerre, guerre, gnb, gc FROM dons WHERE id=:id";
            $res = $this->getQuery($query, $data)->fetch();
            $total = intval($res['stockGuerre']) + intval($res['guerre']);
            if ($res['gc'] == '1') {
                $newgnb = intval($res['gnb']);
            } else {
                $gnb = $res['gnb'];
                $newgnb = intval($gnb) + 1;
            }
            $data = ['stockGuerre' => $total, 'id' => $l['id'], 'gnb' => $newgnb, 'gc' => 0];
            $query = "UPDATE dons SET stockGuerre=:stockGuerre, gnb=:gnb, gc=:gc WHERE id=:id";
            $this->getQuery($query, $data);
        }
    }
    public function stockPerle(): void
    {
        $list = $this->listDons();
        foreach ($list as $l) {
            $data = ['id' => $l['id']];
            $query = "SELECT stockPerle, perle FROM dons WHERE id=:id";
            $res = $this->getQuery($query, $data);
            $total = intval($res['stockPerle']) + intval($res['perle']);
            if ($res['pc'] == '1') {
                $newgnb = intval($res['pnb']);
            } else {
                $pnb = $res['pnb'];
                $newgnb = intval($pnb) + 1;
            }
            $data = ['stockPerle' => $total, 'id' => $l['id'], 'pnb' => $newgnb, 'pc' => 0];
            $query = "UPDATE dons SET stockPerle=:stockPerle, pnb=:pnb, pc=:pc WHERE id=:id";
            $this->getQuery($query, $data);
        }
    }
    // Remise à zéro des points de Guerre
    public function deleteGuerreDons(): void
    {
        $query = "UPDATE dons SET guerre=0";
        $this->getQuery($query);
    }
    // Remise à zéro des points de perle
    public function deletePerleDons(): void
    {
        $query = "UPDATE dons SET perle=0";
        $this->getQuery($query);
    }
    // Liste des informations de conquête
    public function getAllPlayersConq(): array
    {
        $query = "SELECT * FROM conq ORDER BY name ASC";
        return $this->getQuery($query)->fetchAll();
    }
    // Information Conquête d'un Joueur
    public function getOnePlayerConq(int $id): array
    {
        $data = ['id' => $id];
        $query = "SELECT * FROM conq WHERE id=:id";
        return $this->getQuery($query, $data)->fetch();
    }
    // Enregistrement Batiment Troupe
    public function setBatTroupe(int $id, int $valeur): int
    {
        $res = $this->getOnePlayerConq($id);
        $val = intval($res['bat_t']) + intval($valeur);
        $data = ['id' => $id, 'bat_t' => $val];
        $query = "UPDATE conq SET bat_t=:bat_t WHERE id=:id";
        $this->getQuery($query, $data);
        return intval($val);
    }
    // Enregistrement Batiment Sagesse
    public function setBatSagesse(int $id, int $valeur): int
    {
        $res = $this->getOnePlayerConq($id);
        $val = intval($res['bat_s']) + intval($valeur);
        $data = ['id' => $id, 'bat_s' => $val];
        $query = "UPDATE conq SET bat_s=:bat_s WHERE id=:id";
        $this->getQuery($query, $data);
        return intval($val);
    }
    // Enregistrement Batiment Pierre
    public function setBatPierre(int $id, int $valeur): int
    {
        $res = $this->getOnePlayerConq($id);
        $val = intval($res['bat_p']) + intval($valeur);
        $data = ['id' => $id, 'bat_p' => $val];
        $query = "UPDATE conq SET bat_p=:bat_p WHERE id=:id";
        $this->getQuery($query, $data);
        return intval($val);
    }
    // Enregistrement Dons Troupes
    public function setTroupeConq(int $id, int $valeur): void
    {
        $data = ['id' => $id, 'don_t' => $valeur];
        $query = "UPDATE conq SET don_t=:don_t WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Enregistrement Dons Sagesse
    public function setSagesseConq(int $id, int $valeur): void
    {
        $data = ['id' => $id, 'don_s' => $valeur];
        $query = "UPDATE conq SET don_s=:don_s WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Enregistrement Dons Pierre
    public function setPierreConq(int $id, int $valeur): void
    {
        $data = ['id' => $id, 'don_p' => $valeur];
        $query = "UPDATE conq SET don_p=:don_p WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Enregistrement Crânes Conquête
    public function setCraneConq(int $id, int $valeur): void
    {
        $data = ['id' => $id, 'crane' => $valeur];
        $query = "UPDATE conq SET crane=:crane WHERE id=:id";
        $this->getQuery($query, $data);
    }
    // Enregistrement Participation Conquête
    public function setPartConq(int $id, int $valeur): int
    {
        $res = $this->getOnePlayerConq($id);
        $val = intval($res['participation']) + intval($valeur);
        $stock = intval($res['part_conq']) + intval($valeur);
        $data = ['id' => $id, 'participation' => $val];
        $query = "UPDATE conq SET participation=:participation WHERE id=:id";
        $this->getQuery($query, $data);
        $data = ['id' => $id, 'part_conq' => $stock];
        $query = "UPDATE conq SET part_conq=:part_conq WHERE id=:id";
        $this->getQuery($query, $data);
        return intval($val);
    }
    // Liste des Joueurs Participation globale
    public function getAllPlayerPart(): array
    {
        $query = "SELECT * FROM participation ORDER BY name ASC";
        return $this->getQuery($query)->fetchAll();
    }
    // Liste Information d'un joueur pour Participation Globale
    public function getOnePlayerPart($id): array
    {
        $data = ['id' => $id];
        $query = "SELECT * FROM participation WHERE id=:id";
        return $this->getQuery($query, $data)->fetch();
    }
    // Copie des dons Insignes vers Participation Globale
    public function copyDonInsigne(): void
    {
        $query = "UPDATE participation SET insigne = (SELECT participation FROM dons WHERE dons.id=participation.id)";
        $this->getQuery($query);
    }
    // Copie de la participation de conquête vers Participation Globale
    public function copyConqParticipation(): void
    {
        $query = "UPDATE participation SET conquete = (SELECT part_conq FROM conq WHERE conq.id=participation.id)";
        $this->getQuery($query);
    }
    // Participation, calcul du total
    public function participationTotal(): void
    {
        $query = "UPDATE participation SET total=insigne+guerre+ninja+conquete";
        $this->getQuery($query);
    }
    // Enregistrement Participation Ninjas
    public function setNinjaPart(int $id, int $valeur): int
    {
        $res = $this->getOnePlayerPart($id);
        $val = intval($res['ninja']) + intval($valeur);
        $stock = intval($res['total']) + intval($valeur);
        $data = ['id' => $id, 'ninja' => $val];
        $query = "UPDATE participation SET ninja=:ninja WHERE id=:id";
        $this->getQuery($query, $data);
        $data = ['id' => $id, 'total' => $stock];
        $query = "UPDATE participation SET total=:total WHERE id=:id";
        $this->getQuery($query, $data);
        return intval($val);
    }
    // Enregistrement Participation Ninjas
    public function setGuerrePart(int $id, int $valeur): int
    {
        $res = $this->getOnePlayerPart($id);
        $val = intval($res['guerre']) + intval($valeur);
        $stock = intval($res['total']) + intval($valeur);
        $data = ['id' => $id, 'guerre' => $val];
        $query = "UPDATE participation SET guerre=:guerre WHERE id=:id";
        $this->getQuery($query, $data);
        $data = ['id' => $id, 'total' => $stock];
        $query = "UPDATE participation SET total=:total WHERE id=:id";
        $this->getQuery($query, $data);
        return intval($val);
    }
    // Suppression d'un joueur dans la Participation
    public function deletePlayerPart(string $name): void
    {
        $data = ['name' => $name];
        $query = "DELETE FROM participation WHERE name=:name";
        $this->getQuery($query, $data);
    }
    // Mise à jour Profil Joueur dans Participation (conservation profil / Réintégration)
    public function updatePlayerPartStay(string $name, int $stay): void
    {
        $data = ['name' => $name, 'stay' => $stay];
        $query = "UPDATE participation SET stay=:stay WHERE name=:name";
        $this->getQuery($query, $data);
    }
    // Suppression d'un joueur dans la Conquête
    public function deletePlayerConq(string $name): void
    {
        $data = ['name' => $name];
        $query = "DELETE FROM conq WHERE name=:name";
        $this->getQuery($query, $data);
    }
    // Mise à jour Profil Joueur dans Conquete (conservation profil / Réintégration)
    public function updatePlayerConqStay(string $name, int $stay): void
    {
        $data = ['name' => $name, 'stay' => $stay];
        $query = "UPDATE conq SET stay=:stay WHERE name=:name";
        $this->getQuery($query, $data);
    }
    // Effacement des données de conquête (dons+crâne) + tranfert crâne vers table "conquete"
    public function eraseConq(): void
    {
        // Transfert vers "conquete"
        $liste = $this->getAllPlayersConq();
        foreach ($liste as $l) {
            $data = ['name' => $l['name'], 'crane' => $l['crane']];
            $query = "UPDATE conquete SET crane=:crane WHERE name=:name";
            $this->getQuery($query, $data);
        }
        // Mise à zéro
        $query = "UPDATE conq SET don_t=0, don_p=0, don_s=0, crane=0";
        $this->getQuery($query);
    }
    // Ajouter un joueur automatique à Conq
    public function addPlayerConq(string $name): void
    {
        $data = ['name' => $name];
        $query = "INSERT INTO conq SET name=:name";
        $this->getQuery($query, $data);
    }
    // Ajouter un joueur automatique à Participation
    public function addPlayerPart(string $name): void
    {
        $data = ['name' => $name];
        $query = "INSERT INTO participation SET name=:name";
        $this->getQuery($query, $data);
    }
    /////////////////////////////////////////////////////////////////////////////////////////
    // Tri par insigne dans Participation
    public function triInsigne(): array
    {
        $query = "SELECT * FROM participation ORDER by insigne DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Ninja dans Participation
    public function triNinja(): array
    {
        $query = "SELECT * FROM participation ORDER by ninja DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Ninja dans Participation
    public function triGuerre(): array
    {
        $query = "SELECT * FROM participation ORDER by guerre DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Ninja dans Participation
    public function triConquete(): array
    {
        $query = "SELECT * FROM participation ORDER by conquete DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Total dans Particpation
    public function triTotal(): array
    {
        $query = "SELECT * FROM participation WHERE stay=1 ORDER by total DESC ";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Bat troupe dans conquête(conq)
    public function triBatTroupe(): array
    {
        $query = "SELECT * FROM conq ORDER by bat_t DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Bat sagesse dans conquête(conq)
    public function triBatSagesse(): array
    {
        $query = "SELECT * FROM conq ORDER by bat_s DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Bat pierre dans conquête(conq)
    public function triBatPierre(): array
    {
        $query = "SELECT * FROM conq ORDER by bat_p DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Don Troupe dans conquête(conq)
    public function triDonTroupe(): array
    {
        $query = "SELECT * FROM conq ORDER by don_t DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Don Sagesse dans conquête(conq)
    public function triDonSagesse(): array
    {
        $query = "SELECT * FROM conq ORDER by don_s DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Don Pierre dans conquête(conq)
    public function triDonPierre(): array
    {
        $query = "SELECT * FROM conq ORDER by don_p DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Crane dans conquête(conq)
    public function triCraneConq(): array
    {
        $query = "SELECT * FROM conq ORDER by crane DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Tri par Participation dans conquête(conq)
    public function triPartConq(): array
    {
        $query = "SELECT * FROM conq ORDER by participation DESC";
        return $this->getQuery($query)->fetchAll();
    }
    // Classement des joueurs dans Participation
    public function setClassement(): void
    {
        $res = $this->triTotal();
        $nb = 1;
        foreach ($res as $r) {
            $data = ['name' => $r['name'], 'class' => $nb];
            $query = "UPDATE participation SET class=:class WHERE name=:name";
            $this->getQuery($query, $data);
            $nb = $nb + 1;
        }
    }
    // Changement d'un pseudo vers Dons, Conquête et Participation
    public function changeName(string $name, string $newName): void
    {
        $data = ['name' => $name];
        $query = "SELECT id FROM dons WHERE name=:name";
        $res = $this->getQuery($query, $data)->fetch();
        $data = ['id' => $res['id'], 'name' => $newName];
        $query = "UPDATE dons SET name=:name WHERE id=:id";
        $this->getQuery($query, $data);
        $data = ['name' => $name];
        $query = "SELECT id FROM conq WHERE name=:name";
        $res = $this->getQuery($query, $data)->fetch();
        $data = ['id' => $res['id'], 'name' => $newName];
        $query = "UPDATE conq SET name=:name WHERE id=:id";
        $this->getQuery($query, $data);
        $data = ['name' => $name];
        $query = "SELECT id FROM participation WHERE name=:name";
        $res = $this->getQuery($query, $data)->fetch();
        $data = ['id' => $res['id'], 'name' => $newName];
        $query = "UPDATE participation SET name=:name WHERE id=:id";
        $this->getQuery($query, $data);
        $data = ['name' => $name];
        $query = "SELECT id FROM conquete WHERE name=:name";
        $res = $this->getQuery($query, $data)->fetch();
        $data = ['id' => $res['id'], 'name' => $newName];
        $query = "UPDATE conquete SET name=:name WHERE id=:id";
        $this->getQuery($query, $data);
    }

}