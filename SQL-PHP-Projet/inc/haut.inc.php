<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ma Boutique</title>

        <!-- les liens Bootstrap -->
        <link rel="stylesheet" href="<?php echo RACINE_SITE . 'inc/css/bootstrap.min.css'; ?>">

        <link rel="stylesheet" href="<?php echo RACINE_SITE . 'inc/css/shop-homepage.css'; ?>">

        <link rel="stylesheet" href="<?php echo RACINE_SITE . 'inc/css/portfolio-item.css'; ?>">

        <script src="<?php echo RACINE_SITE . 'inc/js/jquery.js'; ?>"></script>

        <script src="<?php echo RACINE_SITE . 'inc/js/bootstrap.min.js'; ?>"></script>
    </head>

    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target = "#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="<?php echo RACINE_SITE . 'accueil.php'; ?>">Accueil</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php 
                        echo '<li><a href="'. RACINE_SITE .'accueil.php">Nos salles</a></li>';

                        if (internauteEstConnecte()) { // si membre est connecté
                            echo '<li><a href="'. RACINE_SITE .'profil.php">Profil</a></li>'; 
                            echo '<li><a href="'. RACINE_SITE .'connexion.php?action=deconnexion">Se déconnecter</a></li>';
                        } else { // sinon il n'est pas connecté
                            echo '<li><a href="'. RACINE_SITE .'inscription.php">Inscription</a></li>';
                            echo '<li><a href="'. RACINE_SITE .'connexion.php">Connexion</a></li>';                            
                        }

                        // Menu admin : 
                        if (internauteEstConnecteEtEstAdmin()) {
                            echo '<li><a href="'. RACINE_SITE .'admin/gestion_salle.php">Gestion des salles</a></li>';
                            echo '<li><a href="'. RACINE_SITE .'admin/gestion_produit.php">Gestion des produits</a></li>';
                            echo '<li><a href="'. RACINE_SITE .'admin/gestion_membre.php">Gestion des membres</a></li>';
                            echo '<li><a href="'. RACINE_SITE .'admin/gestion_avis.php">Gestion des avis</a></li>';                       
                            echo '<li><a href="'. RACINE_SITE .'admin/gestion_statitistiques.php">Statistiques</a></li>';                      
                        }

                        ?>
                    </ul>
                </div>
            </div><!-- .container -->
        </nav>
        
        <div class="container" style="min-height: 80vh;">
            <!-- ici il y a un contenu spécifique de chaque page -->
        