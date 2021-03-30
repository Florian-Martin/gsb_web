<?php
/**
 * Vue Accueil
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
?>

<div id="accueil">
    <h2>
        Gestion des frais<small> - <?php
            if ($type_usr == 2) {
                echo 'Comptable : ';
            } else {
                echo 'Visiteur : ';
            }
            echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'];
            ?></small>
    </h2>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-bookmark"></span> Navigation
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <a href="index.php?uc=gererFrais&action=saisirFrais"
                           class="btn btn-success btn-lg" 
                           role="button">
                            <span <?php if ($type_usr == 2) { ?> 
                                    class="glyphicon glyphicon-ok" <?php
                                } else {
                                    ?> class="glyphicon glyphicon-pencil"
                                <?php } ?>>
                            </span>
                            <br>
                            <?php
                            if ($type_usr == 2) {
                                echo 'Valider les fiches de frais';
                            } else {
                                echo 'Renseigner la fiche de frais';
                            }
                            ?>
                        </a>
                        <a href = "index.php?uc=etatFrais&action=selectionnerMois"
                           class = "btn btn-primary btn-lg"
                           role = "button">
                            <span <?php if ($type_usr == 2) { ?> 
                                    class="glyphicon glyphicon-eur" <?php
                                } else {
                                    ?> class="glyphicon glyphicon-list-alt"
                                <?php } ?>>
                            </span>
                            <br>
                            <?php
                            if ($type_usr == 2) {
                                echo 'Suivre le paiement des fiches de frais';
                            } else {
                                echo 'Afficher mes fiches de frais';
                            }
                            ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>