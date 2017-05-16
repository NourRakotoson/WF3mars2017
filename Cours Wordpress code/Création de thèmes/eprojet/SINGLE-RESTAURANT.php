<?php get_header(); // appelle le fichier header.php ?>

    <?php if(have_posts()) : while(have_posts()) : the_post(); ?> 
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> 
    <div class="contenu"><?php the_content(); ?></div>
    <img src="<?php the_field('photo') ?>"><br><br>
    <?php the_field('telephone') ?><br><br>
    <?php the_field('adresse') ?><br><br>
    <?php the_field('horaires') ?><br><br>
    <?php the_field('carte') ?><br><br>
    <?php the_field('promotions') ?><br><br>
    <?php the_field('brunch') ?><br><br>
    <?php the_field('types_de_cuisine') ?><br><br>
    <?php the_field('prix_moyen') ?><br><br>
    <?php the_field('accès') ?><br><br>
    
   <!-- the field() est une fonction interne à Wordpress permettant de récupérer les informations des champs -->
   <!-- bien vérifier le nom des champs entrés dans le plugin ACF(Advanced Custom Field) -->

   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> <!-- API Google -->
   <script src="<?php blogInfo('template_directory');?>/ASSETS/acf-map.js"></script><!-- chemin et intégration du fichier JS -->

   <!-- déclaration d'une variable adresse qui contient notre carte si la variable $adresse n'est pas vide, 
        c'est donc que nous avons posté une carte. Ensuite on affiche cette dernière
        Si l'API de Google ne fonctionne pas, Chrome met la carte overflow:hidden -->

   <?php
   $adresse = get_field('carte');
   if(!empty($adresse)) :
   ?>
   <div class="acf-map">
        <div class="marker" data-lat="<?php echo $adresse['lat']; ?>"data-lng="<?php echo $adresse['lng'] ?>">
        </div>
   </div>
   <?php endif; ?>
    
    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria', 'eprojet'); ?></p>
    <?php endif; ?>

    <?php comments_template(); // Charge le modèle de commentaire ?>
    <?php if(function_exists('the_ratings')) {the_ratings(); } ?><!-- the_ratings fonction interne à WordPress -->

<?php get_footer(); // appelle le fichier footer.php ?>