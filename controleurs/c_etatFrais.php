<?php
/**
 * Gestion de l'affichage des frais
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
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idVisiteur = $_SESSION['id_usr'];
$mois = getMois(date('d/m/Y'));
$moisPrecedent = getMoisPrecedent($mois);
$_SESSION['leVisiteur'] = filter_input(
    INPUT_POST, 
    "lstVisiteurs", 
    FILTER_SANITIZE_STRING
);
$leVisiteur = $_SESSION['leVisiteur'];

switch ($action) {
case 'selectionnerMois':
    $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
    // Afin de sélectionner par défaut le dernier mois dans la zone de liste
    // on demande toutes les clés, et on prend la première,
    // les mois étant triés décroissants
    $lesCles = array_keys($lesMois);
    $moisASelectionner = $lesCles[0];
    include 'vues/v_listeMois.php';
    break;

case 'voirEtatFrais':
    // Un visiteur
    if ($type_usr == 1) {
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        $moisASelectionner = $leMois;
        include 'vues/v_listeMois.php';
    } else { // Un comptable
        $leMois = $moisPrecedent;
        $idVisiteur = $leVisiteur;
        $lesVisiteurs = $pdo->getLesVisiteursCompta($moisPrecedent, 'VA');
        $numAnnee = substr($moisPrecedent, 0, 4);
        $numMois = substr($moisPrecedent, 4, 2);
        include 'vues/v_listeFichesVisiteursMois.inc.php';
    }

    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
    $lesFraisRefuses = $pdo->getLesFraisRefuses($idVisiteur, $leMois);
    $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
    $numAnnee = substr($leMois, 0, 4);
    $numMois = substr($leMois, 4, 2);
    $libEtat = $lesInfosFicheFrais['libEtat'];
    $montantValide = $lesInfosFicheFrais['montantValide'];
    $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
    $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
    include 'vues/v_etatFrais.php';
    break;

case 'selectionVisiteur':
    $lesVisiteurs = $pdo->getLesVisiteursCompta($moisPrecedent, 'VA');
    $numAnnee = substr($moisPrecedent, 0, 4);
    $numMois = substr($moisPrecedent, 4, 2);
    $_SESSION['etape'] = "mp";
    include 'vues/v_listeFichesVisiteursMois.inc.php';
    break;

default :
    break;
}
