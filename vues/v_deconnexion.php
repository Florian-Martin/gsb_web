<?php
/**
 * Vue Déconnexion
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
<?php
deconnecter();
?>
<div class="alert alert-info" role="alert">
    <p>Vous avez bien été déconnecté ! <a href="index.php">Cliquez ici</a>
        pour revenir à la page de connexion.</p>
</div>

<?php
header("Refresh: 3;URL=index.php");
?>