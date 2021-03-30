<?php
/**
 * Gestion de l'accueil
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

require_once 'includes/class.pdogsb.inc.php';

if ($estConnecte) {
    if ($type_usr == 2) {
        $mois = getMois(date('d/m/Y')) - 1;
        $pdo->clotureMoisPrecedent($mois);
    }
    include 'vues/v_accueil.php';
} else {
    include 'vues/v_connexion.php';
}
