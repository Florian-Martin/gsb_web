<?php
/**
 * Gestion de la connexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @author    Florian MARTIN <florian.martin7469@gmail.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
case 'demandeConnexion':
    include 'vues/v_connexion.php';
    break;
case 'valideConnexion':
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
    
    $utilisateur = $pdo->getInfosUtilisateur($login);
    
    // Nom d'utilisateur inconnu
    if (!is_array($utilisateur)) {
        ajouterErreur('Login incorrect.');
        include 'vues/v_erreurs.php';
        include 'vues/v_connexion.php';
    } else { 
        $id = $utilisateur['id'];
        $mdpHashed = $utilisateur['mdp'];
        
        // Nom d'utilisateur connu et password valide
        if (password_verify($mdp, $mdpHashed)) {
            $nom = $utilisateur['nom'];
            $prenom = $utilisateur['prenom'];
            $type_usr = $utilisateur['type_utilisateur'];
            connecter($id, $nom, $prenom, $type_usr);
            header('Location: index.php');   
        }
        // Nom d'utilisateur connu et password invalide
        else {
            ajouterErreur('Mot de passe incorrect.');
            include 'vues/v_erreurs.php';
            include 'vues/v_connexion.php';  
        }
    }
    break;
default:
    include 'vues/v_connexion.php';
    break;
}
