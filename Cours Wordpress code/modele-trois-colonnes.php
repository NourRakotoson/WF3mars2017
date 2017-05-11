<?php
/**
*Template Name: Modèles Trois colonnes 
**/


    get_header(); ?>

    <div class="modele-trois-colonnes-colonne-gauche">...</div>
    <div id="primary" class="site-content modele-trois-colonnes-colonne-centrale">
        <div id="content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

        </div>
    </div>
    <div class="modele-trois-colonnes-colonne-droite"><?php get_sidebar();?></div>
    <div class="clear"></div>

<?php get_footer() ?>

<!-- Prends comme titre de modèle le commentaire du titre/ Attention aux espaces après et avant les 2 points dans le titre -->
<!-- Apparaît dans les attributs de page/ modèle -->
<!-- Lorsqu'on crée un autre modèle de page (type full-width, ce dernier apparaît dans les pages-templates -->
<!-- Ne pas hésiter à copier le code dans les modèles déjà existant -->

<!-- Pour modifier le style, utiliser les différentes classes dans style.css -->