<?php

/**
 * Gestion des frais
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

$idVisiteur = $_SESSION['id_usr'];
$mois = getMois(date('d/m/Y'));
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
    case 'saisirFrais':
        if ($pdo->estPremierFraisMois($idVisiteur, $mois)) {
            $pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
        }
        break;
    case 'validerMajFraisForfait':
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        if (lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
        } else {
            ajouterErreur('Les valeurs des frais doivent être numériques');
            include 'vues/v_erreurs.php';
        }
        break;
    case 'validerCreationFrais':
        $dateFrais = filter_input(INPUT_POST, 'dateFrais', FILTER_SANITIZE_STRING);
        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
        $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
        valideInfosFrais($dateFrais, $libelle, $montant);
        if (nbErreurs() != 0) {
            include 'vues/v_erreurs.php';
        } else {
            $pdo->creeNouveauFraisHorsForfait(
                    $idVisiteur,
                    $mois,
                    $libelle,
                    $dateFrais,
                    $montant
            );
        }
        break;
    case 'supprimerFrais':
        $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
        $pdo->supprimerFraisHorsForfait($idFrais);
        break;
    case 'validerFiche':

        break;
}

switch ($type_usr) {
    // Un visiteur
    case '1':
        $numAnnee = substr($mois, 0, 4);
        $numMois = substr($mois, 4, 2);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        require 'vues/v_listeFraisForfait.php';
        require 'vues/v_listeFraisHorsForfait.php';
        break;
    
    // Un comptable
    case '2':
        $moisPrecedent = getMoisPrecedent($mois);
        $lesVisiteurs = $pdo->getLesVisiteursCompta($moisPrecedent, 'CL');
        $numAnnee = substr($moisPrecedent, 0, 4);
        $numMois = substr($moisPrecedent, 4, 2);

        // Id du visiteur sélectionné dans le combo
        $leVisiteur = filter_input(INPUT_POST, "lstVisiteurs", FILTER_SANITIZE_STRING);

        if ($leVisiteur) {
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur, $moisPrecedent);
            $lesFraisForfait = $pdo->getLesFraisForfait($leVisiteur, $moisPrecedent);
            $nbJustificatifs = $pdo->getNbjustificatifs($leVisiteur, $moisPrecedent);
            
            if ($nbJustificatifs > sizeof($lesFraisHorsForfait)) {
                $nbJustificatifs = sizeof($lesFraisHorsForfait);
                $pdo->setNbJustificatifs($leVisiteur, $moisPrecedent, $nbJustificatifs);
            }
        }
        require 'vues/v_validerFrais.inc.php';
        break;
}