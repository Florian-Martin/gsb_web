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
                        <?php
                        switch ($type_usr) {
                            case '1':
                                include_once 'v_accueil_visiteur.inc.php';
                                break;

                            case '2':
                                include_once 'v_accueil_comptable.inc.php';
                                break;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>