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
if ($type_usr == 2 && isset($_SESSION['leVisiteur'])) {
    $leVisiteur = $_SESSION['leVisiteur'];
}

$idUtilisateur = $_SESSION['id_usr'];
$mois = getMois(date('d/m/Y'));
$moisPrecedent = getMoisPrecedent($mois);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
    case 'saisirFrais':
        if ($pdo->estPremierFraisMois($idUtilisateur, $mois)) {
            $pdo->creeNouvellesLignesFrais($idUtilisateur, $mois);
        }
        break;

    case 'validerMajFraisForfait':
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        if (lesQteFraisValides($lesFrais)) {
            if ($type_usr == 2) {
                $pdo->majFraisForfait($leVisiteur, $moisPrecedent, $lesFrais);
                $_SESSION['modifComptable'] = "Les frais forfaitisés ont bien été modifiés";
                include 'vues/v_confirmationModifications.inc.php';
            } else {
                $pdo->majFraisForfait($idUtilisateur, $mois, $lesFrais);
            }
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
                    $idUtilisateur,
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

    case 'reporterFraisHF':
        $idFraisHF = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);

        // Récupération des informations du frais à reporter
        $leFraisHF = $pdo->getUnFraisHF($idFraisHF);
        $libelle = $leFraisHF['libelle'];
        // Conversion de la date pour réutiliser la fonction de création de frais HF
        $date = dateAnglaisVersFrancais($leFraisHF['date']);
        $montant = $leFraisHF['montant'];

        // Report du frais HF au mois prochain
        // Puis suppression du frais de la liste de frais HF du mois N-1
        if ($pdo->estPremierFraisMois($leVisiteur, $mois)) {
            $pdo->creeNouvellesLignesFrais($leVisiteur, $mois);
        }
        $pdo->creeNouveauFraisHorsForfait($leVisiteur, $mois, $libelle, $date, $montant);
        $pdo->supprimerFraisHorsForfait($idFraisHF);

        // TODO: CHECK SI LE FRAIS A BIEN ETE SUPPRIME ET ENREGISTRE AU MOIS COURANT AVANT DE CONFIRMER
        $_SESSION['modifComptable'] = "Le frais hors forfait a bien été reporté";
        include 'vues/v_confirmationModifications.inc.php';
        break;

    case 'refuserFraisHF':
        $idFraisHF = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);

        // Récupération des informations du frais à supprimer
        $leFraisHF = $pdo->getUnFraisHF($idFraisHF);
        $libelle = "REFUSE : " . $leFraisHF['libelle'];
        $date = $leFraisHF['date'];
        $montant = $leFraisHF['montant'];

        // Troncature du libellé si après ajout du préfixe "REFUSE" la taille 
        // du texte dépasse la taille maximale du champ concerné dans la base
        if (strlen($libelle) > 100) {
            $libelle = substr($libelle, 0, 100);
        }

        // Transfert des informations du frais dans la table fraishfrefuse
        // Puis suppression du frais de la table lignefraishorsforfait
        $pdo->creeFraisRefuse($leVisiteur, $moisPrecedent, $libelle, $date, $montant);
        $pdo->supprimerFraisHorsForfait($idFraisHF);

        // TODO: CHECK SI LE FRAIS A BIEN ETE SUPPRIME ET ENREGISTRE AU MOIS COURANT AVANT DE CONFIRMER
        $_SESSION['modifComptable'] = "Le frais hors forfait a bien été supprimé";
        include 'vues/v_confirmationModifications.inc.php';
        break;

    case 'validerFiche':
        // Somme des frais dont le montant est valide
        $montantValide = $pdo->calculMontantValide($leVisiteur, $moisPrecedent);
        
        // Mise à jour de la fiche
        $pdo->majMontantValide($leVisiteur, $moisPrecedent, $montantValide);
        $pdo->majEtatFicheFrais($leVisiteur, $moisPrecedent, 'VA');
        
        // TODO: CHECK SI LA FICHE EST BIEN VALIDEE AVANT DE CONFIRMER
        $_SESSION['modifComptable'] = "La fiche a bien été validée";
        include 'vues/v_confirmationModifications.inc.php';
        break;
}

switch ($type_usr) {
    // Un visiteur
    case '1':
        $numAnnee = substr($mois, 0, 4);
        $numMois = substr($mois, 4, 2);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idUtilisateur, $mois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idUtilisateur, $mois);
        require 'vues/v_listeFraisForfait.php';
        require 'vues/v_listeFraisHorsForfait.php';
        break;

    // Un comptable
    case '2':
        $lesVisiteurs = $pdo->getLesVisiteursCompta($moisPrecedent, 'CL');
        $numAnnee = substr($moisPrecedent, 0, 4);
        $numMois = substr($moisPrecedent, 4, 2);

        // Id du visiteur sélectionné dans le combo
        $_SESSION['leVisiteur'] = filter_input(INPUT_POST, "lstVisiteurs",
                FILTER_SANITIZE_STRING);
        $leVisiteur = $_SESSION['leVisiteur'];

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