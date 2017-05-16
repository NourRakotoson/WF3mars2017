<?php get_header(); // appelle le fichier header.php ?>

    <?php if(have_posts()) : while(have_posts()) : the_post(); ?> 
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> 
    <div class="contenu"><?php the_content(); ?></div>
    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria', 'eprojet'); ?></p>
    <?php endif; ?>

<?php get_footer(); // appelle le fichier footer.php ?>

<!-- 
    Dans WordPress, nous mettrons toujours une boucle, même si il n'y a qu'un seul contenu à récupérer.

- have_posts() : envoi un boolean pour savoir s'il reste des objets à afficher sur la page en cours, la fonction renverra TRUE tant que tous les articles dans la BDD n'auront pas été affichés

- the_posts() : à l'intérieur de la boucle, cette fonction effectue la récupération d'un article. 

- the_content() : affiche le contenu 

- the_title() : affiche le titre 

- the_permalink() : le lien du contenu 

- _e() : permet de traduire une portion de texte 
 -->
