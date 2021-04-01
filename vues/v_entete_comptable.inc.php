<?php
/**
 * Vue Entête
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    José GIL <jgil@ac-nice.fr>
 * @author    Florian MARTIN <florian.martin7469@gmail.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>

<!DOCTYPE html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <title>Intranet du Laboratoire Galaxy-Swiss Bourdin</title> 
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./styles/bootstrap/bootstrap.css" rel="stylesheet">
    <link href="./styles/style.css" rel="stylesheet">
</head>

<ul class="nav nav-pills pull-right" role="tablist">
    <li <?php if (!$uc || $uc == 'accueil') { ?>
            class="active" <?php } ?>>
        <a href="index.php">
            <span class="glyphicon glyphicon-home"></span>
            Accueil
        </a>
    </li>
    <li <?php if ($uc == 'gererFrais') { ?>
            class="active"<?php } ?>>
        <a href="index.php?uc=gererFrais">
            <span class="glyphicon glyphicon-ok"></span>
            Valider les fiches de frais
        </a>
    </li>
    <li <?php if ($uc == 'etatFrais') { ?>
            class="active"<?php } ?>>
        <a href="index.php?uc=etatFrais&action=selectionnerMois">
            <span class="glyphicon glyphicon-eur"></span>
            Suivre le paiement des fiches de frais
        </a>
    </li>
    <li 
    <?php if ($uc == 'deconnexion') { ?>
            class="active"<?php } ?>>
        <a href="index.php?uc=deconnexion&action=demandeDeconnexion">
            <span class="glyphicon glyphicon-log-out"></span>
            Déconnexion
        </a>
    </li>
</ul>
