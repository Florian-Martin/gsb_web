# Application comptable de gestion de fiches de frais - Contexte GSB - Application web

### Objectifs:

* Cette application web a pour vocation la validation et la mise en paiement des fiches de frais des visiteurs médicaux du groupe GSB.

### Technologies utilisées:

| ![Logo Netbeans](https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Apache_NetBeans_Logo.svg/64px-Apache_NetBeans_Logo.svg.png) | ![Logo PHP](https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/64px-PHP-logo.svg.png) | [![Git-logo](https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Git-logo.svg/128px-Git-logo.svg.png)](https://commons.wikimedia.org/wiki/File:Git-logo.svg "Jason Long [CC BY 3.0 (https://creativecommons.org/licenses/by/3.0)], via Wikimedia Commons") | [![Octicons-mark-github](https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Octicons-mark-github.svg/64px-Octicons-mark-github.svg.png)](https://commons.wikimedia.org/wiki/File:Octicons-mark-github.svg "GitHub [MIT (http://opensource.org/licenses/mit-license.php)], via Wikimedia Commons") | ![Logo MySQL](https://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Cib-mysql_%28CoreUI_Icons_v1.0.0%29.svg/64px-Cib-mysql_%28CoreUI_Icons_v1.0.0%29.svg.png)
| ----- | ----- | ----- | ----- | ----- |

  - **Netbeans** :  Environnement de développement intégré (IDE)
  - **PHP** : Langage de programmation s'exécutant côté serveur pour permettre la communication entre l'application et la base de données
  - **Git** : Logiciel de gestion de version
  - **GitHub** : Forge logicielle en ligne utilisant Git
  - **MySQL** : Système de Gestion de Base de Données Relationnelles exploitant le langage SQL pour effectuer des requêtes afin d'insérer, extraire, modifier ou supprimer des données provenant d'une base de données.
  
### Structure:
 
 * L'application fonctionne selon le design pattern MVC (Modèle-Vue-Contrôleur). Les vues, après interaction des utilisateurs, demandent au contrôleur la mise à jour  des éléments graphiques après avoir préalablement demandé la mise à jour des objets métier.
 
### Fonctionnement:
 
* L'application démarre sur une page d'authentification. Une fois connecté, le comptable peut naviguer sur plusieurs autres pages lui permettant plusieurs actions :
  * Valider les fiches de frais du mois précédent des visiteurs sélectionnés.
  * Mettre en paiement les fiches de frais du mois précédent validées.
  * Revenir à l'accueil
  * Se déconnecter

### Persistance des données:

* La persistance des données est assurée par une base de données distante.




 
