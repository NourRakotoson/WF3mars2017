<?php get_header(); // appelle le fichier header.php ?>

    <?php echo showCategory(); ?>

    <?php if(have_posts()) : while(have_posts()) : the_post(); ?> 
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> 
    <div class="contenu"><?php the_content(); ?></div>
    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria', 'eprojet'); ?></p>
    <?php endif; ?>

<?php get_footer(); // appelle le fichier footer.php ?>