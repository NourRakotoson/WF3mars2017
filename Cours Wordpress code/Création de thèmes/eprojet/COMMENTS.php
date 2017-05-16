<div id="comments">
    <!-- 
        have_comments() est une fonction interne à WordPress qui renvoie un booléan TRUE tant qu'il y a des commentaires dans la BDD
        get_comments_number() est une fonction interne à WordPress qui permet de récupérer les commentaires en BDD
     -->
        <?php if(have_comments()) : echo get_comments_number(); endif; ?>
        commentaire(s). <br>
        <?php if(get_comment_pages_count > 1 && get_option('page_comments')) : //on contrôle s'il y a bien des commmentaires en BDD ?>
        <nav>
            <?php _e('Comment navigation', 'eprojet') ?>
            <?php previous_comments_link( __('&larr; Older Comments', 'eprojet')); // cela créé un lien vers la page de commentaires précédente contenant les plus anciens ?>
            <?php next_comment_link( __('Never Comments &rarr;', 'eprojet')); // cela créé un lien vers la prochaine page de commentaires contenant les nouveaux commentaires  ?>
        </nav>
        <?php endif; ?>

        <?php wp_list_comments(); ?>

        <?php if(comments_open()) :  ?> 
            <?php comment_form(array('comments_notes_after' => '')); ?>
        <?php elseif(have_comments()) : ?>
            <?php _e('comments are closed', 'eprojet');?>
        <?php endif; ?>

    </div>