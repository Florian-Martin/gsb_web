<?php
/**
 * Vue Confirmation de modifications effectuées par un comptable
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    Florian MARTIN <florian.martin7469@gmail.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

?>
<!DOCTYPE html>
<div class="success alert-success" role="alert">
    <p><?php echo $_SESSION['modifComptable'] ?></p>
</div>
<?php
switch ($_SESSION['etape']) {
case 'mp':
    header("Refresh: 1;URL=index.php?uc=etatFrais&action=selectionVisiteur");
    break;

default:
    break;
}
?>
    
