<?php get_header(); ?>

    <div class="row">
        <div class="small-9 columns">
        <?php
        while (have_posts())
        { 
            the_post();
            get_template_part( 'content', get_post_format() );

          // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

            //close post
            echo '</div>';
        } 

        ?>
        </div>

        <div class="small-3 columns">
            <?php get_sidebar(); ?>
        </div>
    </div>

<?php get_footer(); ?>