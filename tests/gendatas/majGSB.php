<?php

/**
 * Génération d'un jeu d'essai
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

$login = "mafl8672_visiteur";
$mdp = "LtUaRGniaN4+";
$bd = "mafl8672_gsb_frais";
$serveur = "martinflorian.fr";

$moisDebut = '201909';
require './fonctions.php';

try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp);
    $pdo->query('SET CHARACTER SET utf8');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Erreur%" . $e->getMessage();
}


set_time_limit(0);
creationFichesFrais($pdo);
creationFraisForfait($pdo);
creationFraisHorsForfait($pdo);
majFicheFrais($pdo);
echo '<br>' . getNbTable($pdo, 'fichefrais') . ' fiches de frais créées !';
echo '<br>' . getNbTable($pdo, 'lignefraisforfait')
 . ' lignes de frais au forfait créées !';
echo '<br>' . getNbTable($pdo, 'lignefraishorsforfait')
 . ' lignes de frais hors forfait créées !';
