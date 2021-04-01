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

<?php
require 'v_listeFichesVisiteursMois.inc.php';
?>

<?php
if ($leVisiteur) {
    ?>
    <div class="row">    
        <h2 id="valid-cpt">Valider la fiche de frais</h2>
        <h3>Eléments forfaitisés</h3>
        <div class="col-md-4">
            <form method="post" 
                  action="index.php?uc=gererFrais&action=validerMajFraisForfait" 
                  role="form">
                <fieldset>       
                    <?php
                    foreach ($lesFraisForfait as $unFrais) {
                        $idFrais = $unFrais['idfrais'];
                        $libelle = htmlspecialchars($unFrais['libelle']);
                        $quantite = $unFrais['quantite'];
                        ?>
                        <div class="form-group">
                            <label for="idFrais"><?php echo $libelle ?></label>
                            <input type="text" id="idFrais" 
                                   name="lesFrais[<?php echo $idFrais ?>]"
                                   size="10" 
                                   maxlength="5" 
                                   value="<?php echo $quantite ?>" 
                                   class="form-control">
                        </div>
                        <?php
                    }
                    ?>
                    <button class="btn btn-success" type="submit">Corriger</button>
                    <button class="btn btn-danger" type="reset">Réinitialiser</button>
                    <?php
                    ?>
                </fieldset>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">Descriptif des éléments hors forfait</div>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th class="date">Date</th>
                        <th class="libelle">Libellé</th>  
                        <th class="montant">Montant</th>  
                        <th class="action">Action</th> 
                    </tr>
                </thead>  
                <tbody>
                    <?php
                    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                        $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                        $date = $unFraisHorsForfait['date'];
                        $montant = $unFraisHorsForfait['montant'];
                        $id = $unFraisHorsForfait['id'];
                        ?>           
                        <tr>
                            <td> <?php echo $date ?></td>
                            <td> <?php echo $libelle ?></td>
                            <td> <?php echo $montant ?></td>
                            <td>          
                                <form action="index.php?uc=gererFrais&action=validerCreationFrais" 
                                      method="get" role="form">

                                    <button class="btn btn-success" type="submit">Reporter</button>
                                    <button class="btn btn-danger" type="reset">Refuser</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>  
            </table>
        </div>
        <div>
            <!-- TODO: Afficher le nombre de frais HF du visiteur et le MAJ à chaque 
                        report ou refus -->
            Nombre de justificatifs : 
            <input id="rounded" disabled="disabled" value="<?php 
            echo $nbJustificatifs ?>">
        </div>
        <div>
            <a href="index.php?uc=gererFrais&action=validerFiche"
               class="btn btn-success btn-lg col-md-offset-5" 
               role="button">
                <span class="glyphicon glyphicon-ok"></span> VALIDER LA FICHE
            </a>
        </div>
    </div>
    <?php
}
?>
