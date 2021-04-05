<?php
/**
 * Vue Sélection d'un visiteur et d'un mois
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
?>

<!DOCTYPE html>
<div>
    <h4>Sélectionner une fiche : </h4>
</div>
<div>
    <form action="index.php?<?php
    if ($_SESSION['etape'] == "mp") {
        echo 'uc=etatFrais&action=voirEtatFrais';
    } else {
        echo 'uc=gererFrais';
    }
    ?>" 
          method="post" role="form">
        <div class="form-inline">
            <label for="lstVisiteurs" accesskey="n">Visiteur : </label>
            <select
                id="lstMois" 
                name="lstVisiteurs" 
                class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $idV = $unVisiteur['id'];
                        $nomV = $unVisiteur['nom'];
                        $prenomV = $unVisiteur['prenom'];
                        ?>
                        <?php if ($leVisiteur == $idV) { ?>
                        <option selected value = "<?php echo $idV ?>">
                            <?php echo $nomV . " " . $prenomV ?>
                            <?php
                        } else {
                            ?>
                        <option value = "<?php echo $idV ?>">
                            <?php echo $nomV . " " . $prenomV ?>
                            <?php
                        }
                        ?>
                        <?php
                    }
                    ?>
                </option>
            </select>
            <label for="lstMois" accesskey="n">Mois : </label>
            <select id="lstMois" 
                    name="lstMois" 
                    class="form-control">
                <option><?php echo $numMois . "/" . $numAnnee ?></option>
            </select>
            <button class="btn btn-success" type="submit">Sélectionner</button>
        </div>
    </form>
</div>
