<?php


function connec() {
    $login = "mafl8672_visiteur";
    $mdp = "LtUaRGniaN4+";
    $bd = "mafl8672_gsb_frais";
    $serveur = "localhost";

    try {
        $pdo = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp);
        // Activation des erreurs PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        print "Erreur%" . $e->getMessage();
        die();
    }
}

function majDb($pdo) {
    $lesUtilisateurs = getLesVisiteurs($pdo);

    foreach ($lesUtilisateurs as $unUtilisateur) {
        $id = $unUtilisateur['id'];
        $mdp = $unUtilisateur['mdp'];
        $hash = password_hash($mdp, PASSWORD_DEFAULT);

        hashMdpUtilisateurs($pdo, $id, $hash);
    }
}

function hashMdpUtilisateurs($pdo, $id, $hash) {
    $req = $pdo->prepare(
            'UPDATE utilisateur '
            . 'SET mdp = :unHash '
            . 'WHERE id = :unId'
    );
    $req->bindParam('unHash', $hash, PDO::PARAM_STR);
    $req->bindParam('unId', $id, PDO::PARAM_STR);
    $req->execute();
}

function getLesVisiteurs($pdo) {
    $req = 'select * from utilisateur';
    $res = $pdo->query($req);
    $lesLignes = $res->fetchAll();
    return $lesLignes;
}
?>